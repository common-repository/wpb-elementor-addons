<?php
/**
 * Plugin Name:       WPB Elementor Addons
 * Plugin URI:        https://wpbean.com/
 * Description:       Highly customizable addons for Elementor page builder.
 * Version:           1.4
 * Author:            wpbean
 * Author URI:        https://wpbean.com
 * Text Domain:       wpb-elementor-addons
 * Domain Path:       /languages
 *
 * @package WPB Elementor Addons
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin main class
 */
class WPB_Elementor_Addons {

	/**
	 * The plugin path
	 *
	 * @var string
	 */
	public $plugin_path;


	/**
	 * The theme directory path
	 *
	 * @var string
	 */
	public $theme_dir_path;

	/**
	 * Instance
	 *
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Class Constructor.
	 */
	private function __construct() {
		$this->define_constants();

		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			add_action( 'plugins_loaded', array( $this, 'plugin_init' ) );
		} else {
			add_action( 'admin_notices', array( $this, 'elementor_required_error' ) );
		}

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_actions_links' ) );
		register_deactivation_hook( plugin_basename( __FILE__ ), array( $this, 'register_deactivation' ) );
	}

	/**
	 * Define plugin Constants.
	 */
	public function define_constants() {
		define( 'WPB_EA_VERSION', '1.0.9' );
		define( 'WPB_EA_URL', plugins_url( '/', __FILE__ ) );
		define( 'WPB_EA_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		define( 'WPB_EA_PREFIX', 'wpb_ea_' );
		define( 'WPB_EA_THEME_DIR_PATH', 'wpb-elementor-addons/' );
		define( 'WPB_EA_TEMPLATE_PATH', WPB_EA_PATH . 'templates/' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function plugin_init() {
		$this->file_includes();
		add_action( 'init', array( $this, 'localization_setup' ) );
		add_action( 'admin_notices', array( $this, 'admin_notices' ) );
		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'activated_plugin', array( $this, 'activation_redirect' ) );
	}

	/**
	 * Load the required files
	 *
	 * @return void
	 */
	public function file_includes() {
		require_once __DIR__ . '/inc/helper.php';
		require_once __DIR__ . '/inc/wpb_functions.php';
		require_once __DIR__ . '/inc/wpb_scripts.php';
		require_once __DIR__ . '/admin/admin-page.php';
		require_once __DIR__ . '/admin/class.settings-api.php';
		require_once __DIR__ . '/admin/plugin-settings.php';

		if( is_admin() ){
			require_once __DIR__ . '/inc/DiscountPage/DiscountPage.php';
			new WPBean_Elementor_Addons_DiscountPage();
		}
	}

	/**
	 * Plugin action links
	 */
	public function plugin_actions_links( $links ) {
		if ( is_admin() ) {
			$links[] = '<a href="' . esc_url( admin_url( 'admin.php?page=wpb_ea_settings' ) ) . '">' . esc_html__( 'Settings', 'wpb-elementor-addons' ) . '</a>';
			$links[] = '<a href="https://wpbean.com/support/" target="_blank">' . esc_html__( 'Support', 'wpb-elementor-addons' ) . '</a>';
			$links[] = '<a href="http://docs.wpbean.com/docs/wpb-ea-elementor-addons/" target="_blank">' . esc_html__( 'Documentation', 'wpb-elementor-addons' ) . '</a>';
			$links[] = '<a href="https://wpbean.com/elementor-addons/" target="_blank" class="elementor-plugins-gopro">' . esc_html__( 'Pro Addons', 'wpb-elementor-addons' ) . '</a>';
		}
		return $links;
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @uses load_plugin_textdomain()
	 */
	public function localization_setup() {
		load_plugin_textdomain( 'wpb-elementor-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Activation redirect
	 */
	public function activation_redirect( $plugin ) {
		if ( $plugin == plugin_basename( __FILE__ ) ) {
			wp_safe_redirect( esc_url( admin_url( 'admin.php?page=wpb-ea-about' ) ) );
			exit;
		}
	}

	/**
	 * Admin notices
	 */
	public function admin_notices() {
		if ( ! is_plugin_active( 'elementor/elementor.php' ) ) {
			printf( '<div class="notice notice-warning is-dismissible"><p>%s</p></div>', esc_html__( 'This plugin required Elementor Page Builder installed to function.', 'wpb-elementor-addons' ) );
		}

		$user_id        = get_current_user_id();
		//$premium_addons = wpb_ea_premium_addons();

		$premium_addons = '';

		if ( ! empty( $premium_addons ) ) {
			foreach ( $premium_addons as $key => $premium_addon ) {
				if ( ! get_user_meta( $user_id, $key . '-discount-dismissed' ) ) {
					printf(
						'<div class="wpb-ea-discount-notice updated" style="padding: 30px 20px;border-left-color: #27ae60;border-left-width: 5px;margin-top: 20px;"><p style="font-size: 18px;line-height: 32px">%s <a target="_blank" href="%s">%s</a>! %s <b>%s</b></p><a href="%s">%s</a></div>',
						esc_html__( 'Get a 10% exclusive discount on the', 'wpb-elementor-addons' ),
						esc_url( 'https://wpbean.com/downloads/' . $key ),
						esc_html( $premium_addon ),
						esc_html__( 'Use discount code - ', 'wpb-elementor-addons' ),
						'10PERCENTOFF',
						esc_url(
							add_query_arg(
								array(
									$key . '-discount-dismissed' => 'true',
									'_wpnonce' => wp_create_nonce( 'wpb-ea-discount-dismissed-' . $key ),
								)
							)
						),
						esc_html__( 'Dismiss', 'wpb-elementor-addons' )
					);
				}
			}
		}
	}

	/**
	 * elementor_required_error
	 */
	public function elementor_required_error() {
		$class   = 'notice notice-warning';
		$message = esc_html__( 'WPB Elementor Addons requires the Elementor plugin.', 'wpb-elementor-addons' );

		printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
	}

	/**
	 * Admin Init
	 */
	public function admin_init() {
		$user_id = get_current_user_id();

		$premium_addons = wpb_ea_premium_addons();

		if ( ! empty( $premium_addons ) ) {
			foreach ( $premium_addons as $key => $premium_addon ) {
				if ( isset( $_GET[ $key . '-discount-dismissed' ] ) ) {
					// run a quick security check.
					if ( ! wp_verify_nonce( wp_unslash( $_GET['_wpnonce'] ), 'wpb-ea-discount-dismissed-' . $key ) ) { // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
						return;
					}
					add_user_meta( $user_id, $key . '-discount-dismissed', 'true', true );
				}
			}
		}
	}

	/**
	 * Plugin Deactivation
	 */
	public function register_deactivation() {
		$user_id = get_current_user_id();

		$premium_addons = wpb_ea_premium_addons();

		if ( ! empty( $premium_addons ) ) {
			foreach ( $premium_addons as $key => $premium_addon ) {
				if ( get_user_meta( $user_id, $key . '-discount-dismissed' ) ) {
					delete_user_meta( $user_id, $key . '-discount-dismissed' );
				}
			}
		}
	}
}

/**
 * Initialize the main plugin.
 *
 * @return \WPB_Elementor_Addons
 */

WPB_Elementor_Addons::instance();
