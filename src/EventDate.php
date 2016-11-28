<?php
namespace CNP\TemplateLibrary;

class EventDate extends Organism {

	public $event_start;
	public $event_end;
	public $event_all_day;

	private $event_date_type = 'uncategorized';

	public function __construct( $event_start, $event_end, $event_all_day = false, $name = 'eventdate' ) {

		parent::__construct( $name, 'p' );

		$this->event_start   = $event_start;
		$this->event_end     = $event_end;
		$this->event_all_day = $event_all_day;

		$this->set_event_date_type();
		$this->set_content();
	}

	private function set_event_date_type() {

		$timezone_string = get_option( 'timezone_string' );

		// Temporary fix-- TODO: figure out a bulletproof way of getting the current time
		if ( '' === $timezone_string ) {
			$timezone_string = 'America/New_York';
		}

		$now = new \DateTime( current_time( 'mysql' ), new \DateTimeZone( $timezone_string ) );

		$today    = false;
		$same_day = false;

		if ( $this->event_start < $now && $this->event_end > $now ) {
			$today = true;
		}

		if ( date( 'Ymd', $this->event_start ) === date( 'Ymd', $this->event_end ) ) {
			$same_day = true;
		}

		if ( true === $today && true === $same_day ) {
			$this->event_date_type = 'now';
		}
		if ( true === $this->event_all_day && true === $same_day ) {
			$this->event_date_type = 'allday-single';
		}
		if ( true === $this->event_all_day && false === $same_day ) {
			$this->event_date_type = 'allday-multiple';
		}
		if ( true === $same_day && false === $this->event_all_day ) {
			$this->event_date_type = 'single-day';
		}
	}

	private function set_content() {

		switch ( $this->event_date_type ) {

			case 'now':

				// Now - 1:45 PM
				$this->content = sprintf(
					'Now - %s',
					date( 'g:i A', $this->event_end )
				);

				break;

			case 'allday-single':

				// Jan 1, 2016 - All Day
				$this->content = date( 'M j, Y', $this->event_start ) . ' - All Day';

				break;


			case 'allday-multiple':

				// Mon, Jan 13 - Fri, Jan 18
				$this->content = sprintf(
					'%s - %s',
					date( 'D, M j, Y', $this->event_start ),
					date( 'D, M j, Y', $this->event_end )
				);

				break;

			case 'single-day':

				// 11:05 AM - 1:45 PM
				$this->content = sprintf(
					'%s - %s',
					date( 'g:i A', $this->event_start ),
					date( 'g:i A', $this->event_end )
				);

				break;

			default:

				// Mon, Jan 13 @ 11:05 AM - Fri, Jan 18 @ 1:45 PM
				$this->content = sprintf(
					'%s - %s',
					date( 'D, M j, Y @ g:i A', $this->event_start ),
					date( 'D, M j, Y @ g:i A', $this->event_end )
				);

				break;
		}

	}
}
