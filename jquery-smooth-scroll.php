<?php
/*
Plugin Name: jQuery Smooth Scroll
Version: 1.4.5
Plugin URI: https://www.digitalliberation.org/plugins/jquery-smooth-scroll/?utm_source=plugin&utm_medium=link&utm_campaign=jss_plugin_link
Description: The plugin not only add smooth scroll to top feature/link in the lower-right corner of long pages while scrolling but also makes all jump links to scroll smoothly.
Author: Digital Liberation
Author URI: http://digitalliberation.org/?utm_source=plugin&utm_medium=link&utm_campaign=jss_plugin_link
License: GPL v2 or later

jQuery Smooth Scroll
Copyright (C) 2013-19, Anand Kumar <anand@anandkumar.net>

This program is free software; you can redistribute it and/or modify it under the terms of the GNU
General Public License as published by the Free Software Foundation; either version 2 of the License,
or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

You should have received a copy of the GNU General Public License along with this program; if not, write
to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

/****************************************************************
 *
 *     THERE ARE A FEW THINGS YOU SHOULD MUST KNOW
 *               BEFORE EDITING THE PLUGIN
 *
 *                  FOR DETAILS VISIT:
 *          http://www.blogsynthesis.com/?p=860
 *								*
 ****************************************************************/

// Prevent loading this file directly - Busted!
if ( ! class_exists( 'WP' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit;
}

if ( !class_exists( 'jQuerySmoothScroll' ) ) {

	class jQuerySmoothScroll {

		public function __construct() {

			$blogsynthesis_jss_plugin_url = trailingslashit ( WP_PLUGIN_URL . '/' . dirname ( plugin_basename ( __FILE__ ) ) );
			$pluginname = 'jQuery Smooth Scroll';
			$plugin_version = '1.4.2';

			// load plugin Scripts
			// changed to action 'wp_enqueue_scripts' as its the recommended way to enqueue scripts and styles
			// see http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
			add_action( 'wp_enqueue_scripts',  array( &$this, 'wp_head' ) );

			// add move to top button at wp_footer
			add_action( 'wp_footer',  array( &$this, 'wp_footer' ) );

		}

		// load our css to the head
		public function wp_head() {

			if ( !is_admin() ) {
				global $blogsynthesis_jss_plugin_url;

				// register and enqueue CSS
				wp_register_style( 'jquery-smooth-scroll', plugin_dir_url( __FILE__ ) . 'css/style.css', false );
				wp_enqueue_style( 'jquery-smooth-scroll' );

				// enqueue script
				wp_enqueue_script( 'jquery' );
				$extension = '.min.js';
				if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
					$extension = '.js';
				}
				wp_enqueue_script( 'jquery-smooth-scroll',  plugin_dir_url( __FILE__ ) . 'js/script'.$extension, array('jquery'),false, true );

				// You may now choose easing effect. For more information visit http://www.blogsynthesis.com/?p=860
				// wp_enqueue_script("jquery-effects-core");
			}
		}

		public function wp_footer() {
			// the html button which will be added to wp_footer ?>
			<a id="scroll-to-top" href="#" title="<?php esc_attr_e( 'Scroll to Top', 'blogsynthesis' ); ?>"><?php esc_html_e( 'Top', 'blogsynthesis' ); ?></a>
			<?php
		}

	}

	$jQuerySmoothScroll = new jQuerySmoothScroll();

}
