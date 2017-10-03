<?php

namespace CNP\TemplateLibrary;

/**
 * Class EventDate
 *
 * @package CNP\TemplateLibrary
 *
 * Displays an event date.
 */
class EventDate extends Organism {

	/**
	 * Event start time.
	 *
	 * @var int
	 */
	public $event_start;

	/**
	 * Event start time
	 *
	 * @var int
	 */
	public $event_end;

	/**
	 * Whether it's an all-day event.
	 *
	 * @var bool
	 */
	public $event_all_day;

	/**
	 * The type of event.
	 *
	 * @var string
	 */
	public $event_date_type;

	/**
	 * EventDate constructor.
	 *
	 * @param string $name          Organism name.
	 * @param int    $event_start   Event start time.
	 * @param int    $event_end     Event end time.
	 * @param bool   $event_all_day Whether or not it's an all-day event.
	 */
	public function __construct( $name = 'event-date', $event_start, $event_end, $event_all_day = false ) {

		parent::__construct( $name );

		$this->event_start   = $event_start;
		$this->event_end     = $event_end;
		$this->event_all_day = $event_all_day;

		$this->event_date_type = Utilities::set_event_date_type( $this->event_start, $this->event_end, $this->event_all_day );
		$this->set_content();
	}

	/**
	 * Get the correct format based on the type of event.
	 */
	public function set_content() {

		switch ( $this->event_date_type ) {

			case 'now':

				// Now - 1:45 PM.
				$this->content = sprintf(
					'Now - %s',
					date( 'g:i A', $this->event_end )
				);

				break;

			case 'allday-single':

				// Jan 1, 2016 - All Day.
				$this->content = date( 'M j, Y', $this->event_start ) . ' - All Day';

				break;

			case 'allday-multiple':

				// Mon, Jan 13 - Fri, Jan 18.
				$this->content = sprintf(
					'%s - %s',
					date( 'D, M j, Y', $this->event_start ),
					date( 'D, M j, Y', $this->event_end )
				);

				break;

			case 'single-day':

				// 11:05 AM - 1:45 PM.
				$this->content = sprintf(
					'%s - %s',
					date( 'g:i A', $this->event_start ),
					date( 'g:i A', $this->event_end )
				);

				break;

			default:

				// Mon, Jan 13 @ 11:05 AM - Fri, Jan 18 @ 1:45 PM.
				$this->content = sprintf(
					'%s - %s',
					date( 'D, M j, Y @ g:i A', $this->event_start ),
					date( 'D, M j, Y @ g:i A', $this->event_end )
				);

				break;
		}

		// This filter is here so that we can adjust the event date format site-wide, if necessary.
		if ( defined( 'WP_CONTENT_DIR' ) ) {
			$this->content = apply_filters( 'event_date_format', $this->content, $this );
		}
	}
}
