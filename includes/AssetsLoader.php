<?php


namespace siaeb\edd\persian_report\includes;


class AssetsLoader {

	public function __construct() {
		// Load backend assets
		add_action( 'admin_enqueue_scripts', [ $this, 'loadBackendAssets' ], 11 );
	}

	/**
	 * Load backend assets
	 *
	 * @since 1.0
	 */
	function loadBackendAssets() {
		wp_enqueue_style( SIAEB_EPR_PREFIX . 'jalali-date-picker', SIAEB_EPR_CSS_URL . 'jalalidatepicker.min.css', [], '1.0' );
		wp_enqueue_script( SIAEB_EPR_PREFIX . 'jalali-date-picker', SIAEB_EPR_JS_URL . 'jalalidatepicker.min.js', [ 'jquery' ], '1.0', true );
		wp_enqueue_script( SIAEB_EPR_PREFIX . 'edd-persian-report', SIAEB_EPR_JS_URL . 'edd-persian-report.js', [ 'jquery' ], time(), true );
		wp_localize_script( SIAEB_EPR_PREFIX . 'edd-persian-report', SIAEB_EPR_PREFIX . 'params', [
			'persianStartDate' => isset($_GET['temp-start-date']) ? $_GET['temp-start-date'] : '',
			'persianEndDate'   => isset($_GET['temp-end-date']) ? $_GET['temp-end-date'] : '',
		] );
	}

}
