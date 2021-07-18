<?php


namespace siaeb\edd\persian_report\includes;

class Actions {

	public function __construct() {
		add_action( 'edd_pre_get_payments', [ $this, 'convertDatesToGregorian' ], 11 );
		add_action( 'init', function () {
			if ( isset( $_GET['start-date'] ) && ! empty( $_GET['start-date'] ) ) {
				$_GET['temp-start-date'] = $_GET['start-date'];
				$_GET['start-date']      = $this->convertToGregorian( $_GET['start-date'] );
			}
			if ( isset( $_GET['end-date'] ) && ! empty( $_GET['end-date'] ) ) {
				$_GET['temp-end-date'] = $_GET['end-date'];
				$_GET['end-date']      = $this->convertToGregorian( $_GET['end-date'] );
			}

		}, 1 );
	}

	/**
	 * Change dates to gregorian
	 *
	 * @since 1.0
	 */
	function convertDatesToGregorian( $obj ) {
		$start_date = isset( $_GET['temp-start-date'] ) ? $_GET['temp-start-date'] : false;
		$end_date   = isset( $_GET['temp-end-date'] ) ? $_GET['temp-end-date'] : false;

		if ( $start_date ) {
			$obj->start_date         = strtotime( $this->convertToGregorian( $start_date, false) . ' 00:00:00' );
			$obj->args['start_date'] = $this->convertToGregorian( $start_date, false );
		}

		if ( $end_date ) {
			$obj->end_date         = strtotime( $this->convertToGregorian( $end_date, false ) . ' 23:59:59' );
			$obj->args['end_date'] = $this->convertToGregorian( $end_date, false );
		}

	}

	private function convertToGregorian( $date, $reverse = true ) {
		$date = str_replace( ' 00:00:00', '', $date );
		list( $year, $month, $day ) = explode( '/', $date );
		$result_array    = siaeb_edd_persian_report()->jdf->jalali_to_gregorian( $year, ltrim( $month, '0' ), ltrim( $day, '0' ) );
		$result_array[1] = ltrim( $result_array[1], '0' );

		return $reverse ? implode( '/', [
			$result_array[1],
			$result_array[2],
			$result_array[0]
		] ) : implode( '/', $result_array );
	}


}
