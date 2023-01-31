<?php

if ( ! function_exists( 'solbeg' ) ) {

    function solbeg() {

    // Disable admin panel
    add_filter('show_admin_bar', '__return_false');

    // Disable gutenberg editor
    add_filter('use_block_editor_for_post', '__return_false', 10);

    // ADD IMAGE SUPPORT
    add_theme_support('post-thumbnails' );

    // add svg+xml
    add_filter('upload_mimes', function ($mimes) {
        $mimes['svg'] = 'image/svg+xml';
        return $mimes;
    });

    // Register navigation menus
    add_action('after_setup_theme', function () {
        register_nav_menus([
            'header_menu' => 'Menu in header',
            'footer_menu' => 'Menu in footer'
        ]);
    });

    }
}

add_action( 'after_setup_theme', 'solbeg' );

function wpbootstrap_enqueue_styles() {
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css'
    );
}

function solbeg_style() {
    wp_enqueue_style(
        'main-custom-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        1.2,
        'all'
    );
}

function jquery_enqueue_script() {
    wp_enqueue_script(
        'jquery-3.6.3',
        'https://code.jquery.com/jquery-3.6.0.min.js',
        '',
        wp_get_theme()->get( 'Version' ),
        true
    );
}

function ajax_script() {
    wp_enqueue_script(
        'ajax',
        get_template_directory_uri() . '/assets/script/ajax.js',
        '',
        wp_get_theme()->get( 'Version' ),
        true
    );
    wp_localize_script( 'ajax-script', '',
        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}

function solbeg_script() {
    wp_enqueue_script(
        'main-custom-script',
        get_template_directory_uri() . '/assets/script/main.js',
        '',
        wp_get_theme()->get( 'Version' ),
        true
    );
}

add_action('wp_enqueue_scripts', 'wpbootstrap_enqueue_styles');
add_action('wp_enqueue_scripts', 'solbeg_style' );

add_action('wp_enqueue_scripts', 'jquery_enqueue_script');
add_action('wp_enqueue_scripts', 'ajax_script');
add_action('wp_enqueue_scripts', 'solbeg_script' );

// Create custom parks post type

function parks_post() {
    $labels = array(
        'name'               => _x( 'Parks', 'post type general name' ),
        'singular_name'      => _x( 'Parks', 'post type singular name' ),
        'add_new'            => _x( 'Add park', 'park' ),
        'add_new_item'       => __( 'Add park' ),
        'edit_item'          => __( 'Edit' ),
        'new_item'           => __( 'New park' ),
        'all_items'          => __( 'All parks' ),
        'view_item'          => __( 'Review' ),
        'search_items'       => __( 'Search park' ),
        'not_found'          => __( 'Not found' ),
        'not_found_in_trash' => __( 'Not found' ),
        'parent_item_colon'  => '',
        'menu_name'          => 'National Polish Parks'
    );
    $args = array(
        'labels'        => $labels,
        'description'   => 'parks',
        'public'        => true,
        'menu_position' => 4,
        'rewrite'     => array( 'slug' => 'national-polish-parks', 'with_front' => true ),
        'supports'      => array( 'title', 'editor', 'thumbnail', 'custom-fields'),
        'has_archive'   => true,
        'menu_icon'   => 'dashicons-location-alt',
        'taxonomies' => array('post_tag')
    );
    register_taxonomy('park_category', array('parks'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'singular_label' => 'park_category',
            'all_items' => 'Category',
            'query_var' => true,
            'rewrite' => array('slug' => 'park-category'))
    );
    register_post_type( 'parks', $args );
    flush_rewrite_rules(false);
}
add_action( 'init', 'parks_post' );


// add metabox
add_action('add_meta_boxes', 'park_custom_box');

function park_custom_box(){
    $screens = [ 'parks' ];
    add_meta_box( 'park_sectionid', 'Park location', 'location_meta_box_callback', $screens );
}

function location_meta_box_callback( $post, $meta ){
    $screens = $meta['args'];
    $value = get_post_meta( $post->ID, '_location', 1 );
    echo '<label for="location_park">' . "Please add link to map" . '</label> ';
    echo '<input type="text" id="location_park" name="location_park" value="'. $value .'" size="100%" />';
}

add_action( 'save_post', 'save_location_meta_box_field' );

function save_location_meta_box_field( $post_id ) {
    if ( ! isset( $_POST['location_park'] ) )
        return;
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return;
    if( ! current_user_can( 'edit_post', $post_id ) )
        return;
    $my_data = sanitize_text_field( $_POST['location_park'] );
    update_post_meta( $post_id, '_location', $my_data );
}

//AJAX

function post_park_load() {
    if(!empty($_POST['category_id'])) {
        $args = array(
            'post_type' => 'parks',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => $_POST['paged'] ?: 1,
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => 'park_category',
                    'terms' => $_POST['category_id'],
                    'include_children' => false
                ],
            ],
        );
    } else {
        $args = array(
            'post_type' => 'parks',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'paged' => $_POST['paged'] ?: 1,
            'order' => 'ASC'
        );
    }

    $blog_post = new WP_Query($args);
    $arr = [];
    $arr['blogPost'] = $blog_post;

    get_template_part("template-parts/home/template", "post", $arr);

    wp_reset_query();
    exit();

}

add_action( 'wp_ajax_post_park_load', 'post_park_load' );
add_action( 'wp_ajax_nopriv_post_park_load', 'post_park_load' );

//translation

//function translation_of_theme(){
//    load_theme_textdomain( 'pl', false, get_template_directory_uri() . '/languages' );
//}
//
//add_action( 'init', 'translation_of_theme' );
