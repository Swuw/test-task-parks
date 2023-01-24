<?php

if ( ! function_exists( 'solbeg' ) ) {

    function solbeg() {

    // Disable admin panel
    add_filter('show_admin_bar', '__return_false');

    // Disable gutenberg editor
    add_filter('use_block_editor_for_post', '__return_false', 10);

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
        get_template_directory_uri() . '/assets/css/print.css',
        array(),
        wp_get_theme()->get( 'Version' ),
        'print'
    );
}

function solbeg_script() {
    wp_enqueue_script(
        'main_script',
        get_template_directory_uri() . '/assets/css/print.css',
        array( 'wp-blocks', 'wp-dom' ),
        wp_get_theme()->get( 'Version' ),
        true
    );
}

add_action( 'wp_enqueue_scripts', 'solbeg_style' );
add_action( 'wp_enqueue_scripts', 'solbeg_script' );

