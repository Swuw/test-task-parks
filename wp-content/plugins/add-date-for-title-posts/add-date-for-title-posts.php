<?php
/*
Plugin Name: Add date for title posts
Plugin URI: https://solbeg.com/
Description: Add creation date for title posts in the format that is specified in the WP settings.
Version: 1.0
Author: Dre
Author URI: https://www.linkedin.com/in/andrew-januszkiewicz/
License: GPL2
Requires PHP: 7.4
*/

defined( 'ABSPATH' ) || exit;

$requiredPhpVersion = '7.4';
$currentPhpVersion = phpversion();

/**
 * Class to log errors.
 */
class LogError
{
    /**
     * Message to be displayed in a warning.
     *
     * @var string
     */
    private string $message;

    /**
     * Initialize class.
     *
     * @param string $message Message to be displayed in an error.
     */
    public function __construct(string $message)
    {
        $this->message = $message;

        add_action('admin_notices', array($this, 'render'));
    }

    /**
     * Displays error on the admin screen.
     *
     * @return void
     */
    public function render()
    {
        printf('<div class="notice notice-error is-dismissible"><p>Error: %s</p></div>', esc_html($this->message));
    }
}


/**
 * Class to off plugin.
 */
class PluginOff
{

    /**
     *
     * Constructor.
     */
    public function __construct()
    {
        add_action('admin_init', array($this, 'plugin_off'));
    }

    /**
     * Deactivate plugin
     */
    public function plugin_off()
    {
        deactivate_plugins( plugin_basename( __FILE__ ) );
    }
}

if (version_compare($requiredPhpVersion, $currentPhpVersion, '>')) {
    new PluginOff();
    new LogError(" has been deactivated. Plugin requires PHP version 7.4 or higher. Current PHP version: $currentPhpVersion, plugin PHP version: $requiredPhpVersion ");
}


class AddPostDateToTitle {
    public function __construct() {
        add_filter( 'the_title', array( $this, 'add_date_to_title' ) );
    }

    public function add_date_to_title( $title ) {
            global $post;
            $date = get_the_date( get_option( 'date_format' ), $post->ID );
            $title = $title . ' (' . $date . ')';
        return $title;
    }
}

new AddPostDateToTitle();


