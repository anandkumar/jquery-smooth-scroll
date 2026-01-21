<?php
/*
Plugin Name: jQuery Smooth Scroll
Version: 1.5.0
Plugin URI: https://www.digitalliberation.org/plugins/jquery-smooth-scroll/?utm_source=plugin&utm_medium=link&utm_campaign=jss_plugin_link
Description: The plugin not only add smooth scroll to top feature/link in the lower-right corner of long pages while scrolling but also makes all jump links to scroll smoothly.
Author: Digital Liberation
Author URI: http://digitalliberation.org/?utm_source=plugin&utm_medium=link&utm_campaign=jss_plugin_link
License: GPL v2 or later

jQuery Smooth Scroll
Copyright (C) 2013-26, Anand Kumar <anand@anandkumar.net>

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
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !class_exists( 'jQuerySmoothScroll' ) ) {

	class jQuerySmoothScroll {

		public function __construct() {

			$blogsynthesis_jss_plugin_url = trailingslashit ( WP_PLUGIN_URL . '/' . dirname ( plugin_basename ( __FILE__ ) ) );
			$pluginname = 'jQuery Smooth Scroll';
			$plugin_version = '1.5.0';

			// load plugin Scripts
			// changed to action 'wp_enqueue_scripts' as its the recommended way to enqueue scripts and styles
			// see http://codex.wordpress.org/Plugin_API/Action_Reference/wp_enqueue_scripts
			add_action( 'wp_enqueue_scripts',  array( &$this, 'wp_head' ) );

			// add move to top button at wp_footer
			add_action( 'wp_footer',  array( &$this, 'wp_footer' ) );

			// Admin menu and settings
			add_action( 'admin_menu', array( &$this, 'add_plugin_page' ) );
			add_action( 'admin_init', array( &$this, 'page_init' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );

		}

		public function add_plugin_page() {
			add_options_page(
				'jQuery Smooth Scroll Settings', 
				'jQuery Smooth Scroll', 
				'manage_options', 
				'jquery-smooth-scroll', 
				array( &$this, 'create_admin_page' )
			);
		}

		public function page_init() {
			register_setting( 'jquery_smooth_scroll_option_group', 'jss_scroll_to_top_image', 'esc_url_raw' );
		}

		public function admin_scripts( $hook ) {
			if ( 'settings_page_jquery-smooth-scroll' != $hook ) {
				return;
			}
			wp_enqueue_media();
			wp_enqueue_script( 'jss-admin-script', plugin_dir_url( __FILE__ ) . 'js/admin-script.js', array( 'jquery' ), '1.0', true );
		}

		public function create_admin_page() {
			?>
			<div class="wrap">
				<h1>jQuery Smooth Scroll Settings</h1>
				<form method="post" action="options.php">
					<?php settings_fields( 'jquery_smooth_scroll_option_group' ); ?>
					<?php do_settings_sections( 'jquery_smooth_scroll_option_group' ); ?>
					<table class="form-table">
						<tr valign="top">
							<th scope="row">Scroll to Top Image</th>
							<td>
								<?php $image_url = get_option( 'jss_scroll_to_top_image' ); ?>
								<input type="hidden" id="jss_scroll_to_top_image" name="jss_scroll_to_top_image" value="<?php echo esc_attr( $image_url ); ?>" />
								<div style="margin-bottom: 10px;">
									<img id="jss_image_preview" src="<?php echo esc_attr( $image_url ); ?>" style="max-width: 100px; max-height: 100px; display: <?php echo $image_url ? 'block' : 'none'; ?>;" />
								</div>
								<input type="button" class="button" value="<?php esc_attr_e( 'Upload Image', 'jquery-smooth-scroll' ); ?>" id="upload_image_button" />
								<input type="button" class="button button-secondary" value="<?php esc_attr_e( 'Remove Image', 'jquery-smooth-scroll' ); ?>" id="remove_image_button" style="display: <?php echo $image_url ? 'inline-block' : 'none'; ?>;" />
								<p class="description">Upload a custom PNG, JPG, JPEG, or SVG image for the scroll to top button.</p>
							</td>
						</tr>
					</table>
					<?php submit_button(); ?>
				</form>
			</div>
			<?php
		}

		// load our css to the head
		public function wp_head() {

			if ( !is_admin() ) {
				global $blogsynthesis_jss_plugin_url;

				// register and enqueue CSS
				wp_register_style( 'jquery-smooth-scroll', plugin_dir_url( __FILE__ ) . 'css/style.css', array(), '1.4.5' );
				wp_enqueue_style( 'jquery-smooth-scroll' );

				// enqueue script
				wp_enqueue_script( 'jquery' );
				$extension = '.min.js';
				if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
					$extension = '.js';
				}
				wp_enqueue_script( 'jquery-smooth-scroll',  plugin_dir_url( __FILE__ ) . 'js/script'.$extension, array('jquery'), '1.4.5', true );

				// You may now choose easing effect. For more information visit http://www.blogsynthesis.com/?p=860
				// wp_enqueue_script("jquery-effects-core");
			}
		}

		public function wp_footer() {
			// the html button which will be added to wp_footer
			$image_url = get_option( 'jss_scroll_to_top_image' );
			if ( $image_url ) {
				?>
				<a id="scroll-to-top" class="custom-image" href="#" title="<?php esc_attr_e( 'Scroll to Top', 'jquery-smooth-scroll' ); ?>">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Scroll to Top', 'jquery-smooth-scroll' ); ?>" />
				</a>
				<?php
			} else {
				?>
				<a id="scroll-to-top" href="#" title="<?php esc_attr_e( 'Scroll to Top', 'jquery-smooth-scroll' ); ?>"><?php esc_html_e( 'Top', 'jquery-smooth-scroll' ); ?></a>
				<?php
			}
		}

	}

	$jQuerySmoothScroll = new jQuerySmoothScroll();

}
