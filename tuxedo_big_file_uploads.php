<?php
/**
 * Plugin Name: Tuxedo Big File Uploads
 * Plugin URI:  https://github.com/andtrev/Tuxedo-Big-File-Uploads
 * Description: Enables large file uploads in the built-in WordPress media uploader.
 * Version:     1.1
 * Author:      Trevor Anderson
 * Author URI:  https://github.com/andtrev
 * License:     GPLv2 or later
 * Domain Path: /languages
 * Text Domain: tuxedo-big-file-uploads
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 * @package TuxedoBigFileUploads
 * @version 1.0.1
 */

/**
 * Tuxedo Big File Uploads manager class.
 *
 * Bootstraps the plugin by hooking into plupload defaults and
 * media settings.
 *
 * @since 1.0.0
 */
class TuxedoBigFileUploads {

	/**
	 * TuxedoBigFileUploads instance.
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var TuxedoBigFileUploads
	 */
	private static $instance = false;

	/**
	 * Get the instance.
	 * 
	 * Returns the current instance, creates one if it
	 * doesn't exist. Ensures only one instance of
	 * TuxedoBigFileUploads is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 *
	 * @return TuxedoBigFileUploads
	 */
	public static function get_instance() {

		if ( ! self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;

	}

	/**
	 * Constructor.
	 * 
	 * Initializes and adds functions to filter and action hooks.
	 * 
	 * @since 1.0.0
	 */
	public function __construct() {

		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_filter( 'plupload_init', array( $this, 'filter_plupload_settings' ) );
		add_filter( 'plupload_default_settings', array( $this, 'filter_plupload_settings' ) );
		add_filter( 'upload_size_limit', array( $this, 'filter_upload_size_limit' ) );
		add_action( 'admin_init', array( $this, 'settings_api_init' ) );

	}

	/**
	 * Filter plupload settings.
	 * 
	 * @since 1.0.0
	 */
	public function filter_plupload_settings( $plupload_settings ) {

		$tuxbfu_chunk_size = intval( get_option( 'tuxbfu_chunk_size', 512 ) );
		if ( $tuxbfu_chunk_size < 1 ) {
			$tuxbfu_chunk_size = 512;
		}
		$tuxbfu_max_retries = intval( get_option( 'tuxbfu_max_retries', 5 ) );
		if ( $tuxbfu_max_retries < 1 ) {
			$tuxbfu_max_retries = 5;
		}
		$plupload_settings['url'] = plugins_url( 'tux_handle_upload.php', __FILE__ );
		$plupload_settings['filters']['max_file_size'] = $this->filter_upload_size_limit('') . 'b';
		$plupload_settings['chunk_size'] = $tuxbfu_chunk_size . 'kb';
		$plupload_settings['max_retries'] = $tuxbfu_max_retries;
		return $plupload_settings;

	}

	/**
	 * Load Localisation files.
	 * 
	 * @since 1.0.0
	 */
	public function load_textdomain() {

		$domain = 'tuxedo-big-file-uploads';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

	}

	/**
	 * Return max upload size.
	 * 
	 * Free space of temp directory.
	 * 
	 * @since 1.0.0
	 * 
	 * @return float $bytes Free disk space in bytes.
	 */
	public function filter_upload_size_limit( $unused ) {

		$bytes = disk_free_space( sys_get_temp_dir() );
		if ( $bytes === false ) {
			$bytes = 0;
		}
		return $bytes;

	}

	/**
	 * Initialize settings api.
	 * 
	 * Registers settings and setting fields.
	 * 
	 * @since 1.0.0
	 */
	public function settings_api_init() {

		add_settings_field(
			'tuxbfu_chunk_size',
			__( 'Chunk Size (kb)', 'tuxedo-big-file-uploads' ),
			array( $this, 'settings_chunk_size_callback' ),
			'media',
			'uploads'
		);
		add_settings_field(
			'tuxbfu_max_retries',
			__( 'Max Retries', 'tuxedo-big-file-uploads' ),
			array( $this, 'settings_max_retries_callback' ),
			'media',
			'uploads'
		);
		register_setting( 'media', 'tuxbfu_chunk_size', 'intval' );
		register_setting( 'media', 'tuxbfu_max_retries', 'intval' );

	}

	/**
	 * Output chunk size input control.
	 * 
	 * @since 1.0.0
	 */
	public function settings_chunk_size_callback() {

		$tuxbfu_chunk_size = intval( get_option( 'tuxbfu_chunk_size', 512 ) );
		if ( $tuxbfu_chunk_size < 1 ) {
			$tuxbfu_chunk_size = 512;
		}
		$tuxbfu_chunk_size = esc_attr( $tuxbfu_chunk_size );
		echo "<input type='text' name='tuxbfu_chunk_size' value='{$tuxbfu_chunk_size}' />";

	}

	/**
	 * Output max retries input control.
	 * 
	 * @since 1.0.0
	 */
	public function settings_max_retries_callback() {

		$tuxbfu_max_retries = intval( get_option( 'tuxbfu_max_retries', 5 ) );
		if ( $tuxbfu_max_retries < 1 ) {
			$tuxbfu_max_retries = 5;
		}
		$tuxbfu_max_retries = esc_attr( $tuxbfu_max_retries );
		echo "<input type='text' name='tuxbfu_max_retries' value='{$tuxbfu_max_retries}' />";

	}

}

/** Instantiate the plugin class. */
$tux_big_file_uploads = TuxedoBigFileUploads::get_instance();