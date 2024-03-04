<?php
/**
 * Sapphire MCQ Manager
 *
 * @package           mcqtext
 * @author            Md. Readush Shalihin
 * @copyright         2023 Sapphire IT
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Sapphire MCQ Manager
 * Description:       Multiple choice Question Test plugin for educational perpous. Use to Shortcode to show mcq list [sapphire-mcq category="English"].
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Md. Readush Shalihin
 * Text Domain:       sapphire-mcq-manager
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require_once __DIR__ . '/vendor/autoload.php';


/**
 * Main Class Sapphire_Mcq_Text
 */
final class Sapphire_Mcq {

	const VERSION = '1.0.0';

	/**
	 *  __construct Method of Sapphire_Mcq Class
	 *
	 * @return void
	 */
	private function __construct() {
		$this->defined_constance();
		register_activation_hook( __FILE__, array( $this, 'active' ) );
		add_action( 'plugins_loaded', array( $this, 'init_plugins' ) );

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'sphr_mcq_enqueue_css_callback' ) );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'sphr_enqueue_bootstrap_callback' ) );
		}
	}

	/**
	 * Method sphr_mcq_enqueue_css_callback
	 *
	 * @return void
	 */
	public function sphr_mcq_enqueue_css_callback() {
		wp_register_style( 'sphr-mcq-css', SAPPHIRE_ASSETE . '/css/sapphire-admin-mcq.css' );
		wp_enqueue_style( 'sphr-mcq-css' );
	}

	/**
	 * Enqueue bootstrap css and js file also custom css file.
	 *
	 * @return void
	 */
	public function sphr_enqueue_bootstrap_callback() {
		// bootstrap css file register.
		wp_register_style( 'sphr-mcq-bootstrap-css', plugin_dir_url( __FILE__ ) . 'assets/css/bootstrap.min.css' );
		wp_register_style( 'sphr-mcq-custom-css', plugin_dir_url( __FILE__ ) . 'assets/css/sapphire-style.css' );
		// bootstrap js file register.
		wp_register_script( 'sphr-mcq-bootstrap-js', plugin_dir_url( __FILE__ ) . 'assets/js/bootstrap.min.js' );

		// bootstrap css file added.
		wp_enqueue_style( 'sphr-mcq-bootstrap-css' );
		// custom frontend css file added.
		wp_enqueue_style( 'sphr-mcq-custom-css' );
		// bootstrap js file added.
		wp_enqueue_script( 'sphr-mcq-bootstrap-js' );
	}


	/**
	 * Inisialize the Singleton instance.
	 *
	 * @return \Sapphire_Mcq
	 */
	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;
	}

	/**
	 * Defined the required plugin constance
	 *
	 * @return void
	 */
	public function defined_constance() {
		define( 'SAPPHIRE_VIRSION', self::VERSION );
		define( 'SAPPHIRE_FILE', __FILE__ );
		define( 'SAPPHIRE_DIR', __DIR__ );
		define( 'SAPPHIRE_URL', plugin_dir_url( SAPPHIRE_FILE ) );
		define( 'SAPPHIRE_ASSETE', SAPPHIRE_URL . '/assets' );
	}

	/**
	 * Initialize the plugin.
	 *
	 * @return void
	 */
	public function init_plugins() {

		if ( is_admin() ) {
			new Sapphire\Mcq\Admin();
		} else {
			new Sapphire\Mcq\Frontend();
		}
	}

	/**
	 * Do staff after plugin activation.
	 *
	 * @return void
	 */
	public function active() {
		$installetion = get_option( 'sapphire_installed' );
		if ( ! $installetion ) {
			update_option( 'sapphire_installed', time() );
		}
		update_option( 'sapphire_mcq_manager_version', SAPPHIRE_VIRSION );

		flush_rewrite_rules();
	}
}

/**
 * Call main class through sapphire_mcq function.
 *
 * @return \Sapphire_Mcq
 */
function sapphire_mcq() {
	return Sapphire_Mcq::init();
}

sapphire_mcq();
