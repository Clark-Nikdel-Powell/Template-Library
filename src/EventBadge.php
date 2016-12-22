<?php
namespace CNP\TemplateLibrary;

use CNP\TemplateLibrary\Util\Utility;

/**
 * Class EventBadge
 * @package CNP\TemplateLibrary
 *
 * @link http://php.net/manual/en/function.date.php
 */
class EventBadge extends Organism {

	public $event_start;
	public $event_end;
	public $event_all_day;
	public $event_date_type;

	/**
	 * EventBadge constructor.
	 *
	 * @param string $event_start Required. The start date of the event.
	 * @param array $event_end Required. The end date of the event.
	 * @param bool $event_all_day Required. Whether an event is all day or not.
	 * @param array $structure Optional. The structure for the badge. Defaults to a month/day block in Jan/05 format.
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 */
	public function __construct( $event_start, $event_end, $event_all_day = false, $name = 'event-badge', array $structure = [], $tag = 'div', array $attributes = [] ) {

		parent::__construct( $name, $tag, $attributes, $content = '', $data = null, $structure, $before = '', $prepend = '', $append = '', $after = '' );

		$this->event_start   = $event_start;
		$this->event_end     = $event_end;
		$this->event_all_day = $event_all_day;

		$this->event_date_type = Utility::set_event_date_type( $this->event_start, $this->event_end, $this->event_all_day );

		// Set up default structure, if it hasn't been passed in.
		if ( empty( $this->structure ) ) {

			$this->structure = [
				'month' => date( 'M', $this->event_start ),
				'day'   => date( 'd', $this->event_start ),
			];
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
