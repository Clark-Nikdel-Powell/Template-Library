<?php
namespace CNP\TemplateLibrary;

/**
 * Class EventBadge
 *
 * @package CNP\TemplateLibrary
 *
 * @link    http://php.net/manual/en/function.date.php
 */
class EventBadge extends Organism {

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
	 * EventBadge constructor.
	 *
	 * @param string $name          Organism name.
	 * @param int    $event_start   Event start time.
	 * @param int    $event_end     Event end time.
	 * @param bool   $event_all_day Whether or not it's an all-day event.
	 */
	public function __construct( $name = 'event-badge', $event_start, $event_end, $event_all_day = false ) {

		parent::__construct( $name );
		$this->event_start   = $event_start;
		$this->event_end     = $event_end;
		$this->event_all_day = $event_all_day;

		$this->event_date_type = Utilities::set_event_date_type( $this->event_start, $this->event_end, $this->event_all_day );
	}

	/**
	 * Get the badge markup.
	 *
	 * @return string
	 */
	public function get_markup() {

		// Set up default structure, if it hasn't been passed in.
		if ( empty( $this->structure ) ) {

			$this->structure = [
				'month' => date( 'M', $this->event_start ),
				'day'   => date( 'd', $this->event_start ),
			];
		}

		return parent::get_markup();
	}
}
