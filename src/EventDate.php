<?php
namespace CNP\TemplateLibrary;

use CNP\TemplateLibrary\Util\Utility;

/**
 * Class EventDate
 * @package CNP\TemplateLibrary
 *
 * Displays an event date.
 *
 */
class EventDate extends Organism {

	public $event_start;
	public $event_end;
	public $event_all_day;
	public $event_date_type;

	/**
	 * EventDate constructor.
	 *
	 * @param string $event_start
	 * @param string $event_end
	 * @param bool $event_all_day
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 */
	public function __construct( $event_start, $event_end, $event_all_day = false, $name = 'event-date', $tag = 'p', array $attributes = [] ) {

		parent::__construct( $name, $data = null, $content = '', $tag, $attributes, $structure = [], $before = '', $prepend = '', $append = '', $after = '' );

		$this->event_start   = $event_start;
		$this->event_end     = $event_end;
		$this->event_all_day = $event_all_day;

		$this->event_date_type = Utility::set_event_date_type( $this->event_start, $this->event_end, $this->event_all_day );
		$this->get_content();
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}

	/**
	 * set_content
	 */
	public function get_content() {

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

		// This filter is here so that we can adjust the event date format site wide, if necessary.
		if ( defined( 'WP_CONTENT_DIR' ) ) {
			$this->content = apply_filters( 'event_date_format', $this->content, $this );
		}
	}
}
