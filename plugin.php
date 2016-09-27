<?php
/**
 * Plugin Name: The Events Calendar Extension: Make Venue Links Go Straight to the Venue Website URLs
 * Description: Make venue links go straight to the venue website URLs.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1971
 * License: GPLv2 or later
 */
 
defined( 'WPINC' ) or die;

class Tribe__Extension__Make_Venue_Links_Go_to_Venue_Website_URLs {

    /**
     * The semantic version number of this extension; should always match the plugin header.
     */
    const VERSION = '1.0.0';

    /**
     * Each plugin required by this extension
     *
     * @var array Plugins are listed in 'main class' => 'minimum version #' format
     */
    public $plugins_required = array(
        'Tribe__Events__Main' => '4.2'
    );

    /**
     * The constructor; delays initializing the extension until all other plugins are loaded.
     */
    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ), 100 );
    }

    /**
     * Extension hooks and initialization; exits if the extension is not authorized by Tribe Common to run.
     */
    public function init() {

        // Exit early if our framework is saying this extension should not run.
        if ( ! function_exists( 'tribe_register_plugin' ) || ! tribe_register_plugin( __FILE__, __CLASS__, self::VERSION, $this->plugins_required ) ) {
            return;
        }

        add_filter( 'tribe_get_venue_link', array( $this, 'make_venue_name_link_to_venue_website' ), 10, 4 );
    }

    /**
     * Make venue links go straight to the venue website URLs.
     *
     * @param string $link
     * @param int $post_id
     * @param string $full_link
     * @param string $url
     * @return string
     */
    public function make_venue_name_link_to_venue_website( $link, $post_id, $full_link, $url ) {
        $website_url = tribe_get_venue_website_url( $post_id );

        if ( ! is_string( $website_url ) || empty( $website_url ) ) {
            return $link;
        }

        return $website_url;
    }
}

new Tribe__Extension__Make_Venue_Links_Go_to_Venue_Website_URLs();
