<?php
/*
Plugin Name: jQuery Smooth Scroll
Version: 2.0.0
Plugin URI: http://digitalliberation.org/plugins/jquery-smooth-scroll/#utm_source=jss_plugin
Description: The plugin adds smooth scroll to anchor links and a scroll to top button.
Author: Digital Liberation
Author URI: http://digitalliberation.org/#utm_source=jss_plugin
License: GPL v2 or later

jQuery Smooth Scroll
Copyright (C) 2013 - 2018, Anand Kumar <anand@anandkumar.net>

This program is free software; you can redistribute it and/or modify it under the terms of the GNU
General Public License as published by the Free Software Foundation; either version 2 of the License,
or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

You should have received a copy of the GNU General Public License along with this program; if not, write
to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

/**
 *
 *
 *
 */

// Prevent loading this file directly - Busted!
if ( ! class_exists( 'WP' ) )
{
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

// Add action to enqueue scripts and add footor button.
add_action( 'wp_enqueue_scripts', 'jquery_smooth_scroll' );
add_action( 'wp_footer', 'jquery_smooth_scroll_button' );

// function to enqueue style.css and script.js
function jquery_smooth_scroll() {

	$jquery_smooth_scroll_dir = plugin_dir_url( __file__ );
	$jquery_smooth_scroll_ver = '1.4.2';

	// Enqueue script
	$extension='.min';
	if( defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ) {
		$extension='';
	}

	wp_enqueue_style( 'jquery-smooth-scroll', $jquery_smooth_scroll_dir . 'css/style'.$extension.'.css', false, $jquery_smooth_scroll_ver );
	wp_enqueue_script( 'jquery-smooth-scroll', $jquery_smooth_scroll_dir . 'js/script'.$extension.'.js', 'jquery', $jquery_smooth_scroll_ver, true );

}

function jquery_smooth_scroll_button() {
	// the html button which will be added to wp_footer ?>
	<a id="scroll-to-top" href="#" title="<?php _e( 'Scroll to Top' , 'digitalliberation' ); ?>"><?php _e( 'Top' , 'digitalliberation' ); ?></a>
	<?php
}
