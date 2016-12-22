<?php
namespace CNP\TemplateLibrary\Util;

class Utility {

	public static function set_event_date_type( $event_start, $event_end, $event_all_day ) {

		$event_date_type = 'uncategorized';
		$timezone_string = '';

		$timezone_string = get_option( 'timezone_string' );

		// Temporary fix-- TODO: figure out a bulletproof way of getting the current time
		if ( '' === $timezone_string ) {
			$timezone_string = 'America/New_York';
		}

		$now = new \DateTime( current_time( 'mysql' ), new \DateTimeZone( $timezone_string ) );

		$today    = false;
		$same_day = false;

		if ( $event_start < $now && $event_end > $now ) {
			$today = true;
		}

		if ( date( 'Ymd', $event_start ) === date( 'Ymd', $event_end ) ) {
			$same_day = true;
		}

		if ( true === $today && true === $same_day ) {
			$event_date_type = 'now';
		}
		if ( true === $event_all_day && true === $same_day ) {
			$event_date_type = 'allday-single';
		}
		if ( true === $event_all_day && false === $same_day ) {
			$event_date_type = 'allday-multiple';
		}
		if ( true === $same_day && false === $event_all_day ) {
			$event_date_type = 'single-day';
		}

		return $event_date_type;
	}
}
