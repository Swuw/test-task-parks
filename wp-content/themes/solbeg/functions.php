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

function solbeg_style() {
    wp_enqueue_style(
        'main_style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        wp_get_theme()->get( 'Version' ),
        'print'
    );
}

function solbeg_script() {
    wp_enqueue_script(
        'main_script',
        get_template_directory_uri() . '/assets/script/main.js',
        array( 'wp-blocks', 'wp-dom' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}

add_action( 'wp_enqueue_scripts', 'solbeg_style' );
add_action( 'wp_enqueue_scripts', 'solbeg_script' );

// Create custom parks post type

function my_custom_post() {
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
        'rewrite'     => array( 'slug' => 'polish-national-parks', 'with_front' => true ),
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
add_action( 'init', 'my_custom_post' );