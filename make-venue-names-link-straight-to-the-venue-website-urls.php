<?php
/**
 * Plugin Name: The Events Calendar — Make Venue Links Go Straight to the Venue Website URLs
 * Description: Make venue links go straight to the venue website URLs.
 * Version: 1.0.0
 * Author: Modern Tribe, Inc.
 * Author URI: http://m.tri.be/1x
 * License: GPLv2 or later
 */
 
defined( 'WPINC' ) or die;

add_filter( 'tribe_get_venue_link', 'tribe_make_venue_name_link_to_venue_website', 10, 4 );

function tribe_make_venue_name_link_to_venue_website( $link, $post_id, $full_link, $url ) {
	$website_url = tribe_get_venue_website_url( $post_id );

	if ( ! is_string( $website_url ) || empty( $website_url ) ) {
		return $link;
	}

	return $website_url;
}
