<?php
/**
 * Plugin Name: گزارش گیری شمسی در Easy Digital Downloads
 * Plugin URI: http://www.siaeb.com
 * Version: 1.0
 * Description: با استفاده از این افزونه شما می توانید گزارش های پرداخت را با انتخاب تاریخ شمسی مشاهده کنید
 * Author: سیاوش ابراهیمی
 * Author URI: http://www.siaeb.com
 */

// Exit if accessed directly.
use siaeb\edd\persian_report\includes\Initializer;
use siaeb\edd\persian_report\includes\Jdf;

if ( ! class_exists( 'SIAEB_EDD_PERSIAN_REPORT' ) ) :

	final class SIAEB_EDD_PERSIAN_REPORT {


		/**
		 * @var SIAEB_EDD_PERSIAN_REPORT
		 *
		 * @since 1.0.0
		 */
		private static $instance;

		/**
		 * @var Initializer
		 */
		public $initializer;

		/**
		 * @var JDF
		 */
		public $jdf;

		public static function instance() {
			if ( is_null( self::$instance instanceof SIAEB_EDD_PERSIAN_REPORT ) || ! self::$instance ) {
				self::$instance = new SIAEB_EDD_PERSIAN_REPORT();
				self::$instance->constants();
				self::$instance->includes();
				self::$instance->init();
			}

			return self::$instance;
		}

		/**
		 * Throw error on object clone.
		 *
		 * The whole idea of the singleton design pattern is that there is a single
		 * object therefore, we don't want the object to be cloned.
		 *
		 * @return void
		 * @since 1.0
		 * @access protected
		 */
		public function _clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'siaeb-edd-persian-report' ), '1.0.0' );
		}

		/**
		 * Disable unserializing of the class.
		 *
		 * @return void
		 * @since 1.0
		 * @access protected
		 */
		public function _wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'siaeb-edd-persian-report' ), '1.0.0' );
		}

		/**
		 * Initialize application
		 *
		 * @since 1.0
		 */
		private function init() {
			$this->jdf         = new Jdf();
			$this->initializer = new Initializer();
		}

		/**
		 * Setup plugin constants.
		 *
		 * @access private
		 * @return void
		 * @since 1.0
		 */
		private function constants() {
			$this->defineConstant( 'SIAEB_EPR_PREFIX', 'siaeb_epr_' );
			$this->defineConstant( 'SIAEB_EPR_VERSION', '1.0.0' );
			$this->defineConstant( 'SIAEB_EPR_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
			$this->defineConstant( 'SIAEB_EPR_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
			$this->defineConstant( 'SIAEB_EPR_PLUGIN_FILE', __FILE__ );
			$this->defineConstant( 'SIAEB_EPR_INC_DIR', SIAEB_EPR_PLUGIN_DIR . 'includes/' );
			$this->defineConstant( 'SIAEB_EPR_ASSETS_URL', SIAEB_EPR_PLUGIN_URL . 'assets/' );
			$this->defineConstant( 'SIAEB_EPR_IMAGES_URL', SIAEB_EPR_ASSETS_URL . 'images/' );
			$this->defineConstant( 'SIAEB_EPR_CSS_URL', SIAEB_EPR_ASSETS_URL . 'css/' );
			$this->defineConstant( 'SIAEB_EPR_JS_URL', SIAEB_EPR_ASSETS_URL . 'js/' );
		}

		/**
		 * Define constant
		 *
		 * @since 1.0
		 */
		private function defineConstant( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Include required files.
		 *
		 * @access private
		 * @return void
		 * @since 1.0
		 */
		private function includes() {
			require_once SIAEB_EPR_INC_DIR . 'Actions.php';
			require_once SIAEB_EPR_INC_DIR . 'AssetsLoader.php';
			require_once SIAEB_EPR_INC_DIR . 'Filters.php';
			require_once SIAEB_EPR_INC_DIR . 'Initializer.php';
			require_once SIAEB_EPR_INC_DIR . 'Jdf.php';
		}

	}

endif;

function siaeb_edd_persian_report() {
	return SIAEB_EDD_PERSIAN_REPORT::instance();
}

siaeb_edd_persian_report();
