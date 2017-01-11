<?php
namespace CNP\TemplateLibrary;

/**
 * Class Loop
 * @package CNP\TemplateLibrary
 *
 * A basic foreach loop, used for handling an array of data
 *
 * @link http://php.net/manual/en/functions.arguments.php#functions.variable-arg-list
 */
class ACFLoop extends Organism {

	public $sub_item_organism_class;
	public $sub_items_data;

	public function __construct( $name = 'loop', array $sub_items_data, $sub_item_organism_class = '', $data = [], $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content = '', $tag, $attributes, $structure = [], $before, $prepend, $append, $after );

		$this->sub_items_data = $sub_items_data;

		$this->sub_item_organism_class = $sub_item_organism_class;
		if ( ! class_exists( $this->sub_item_organism_class ) ) {
			$this->sub_item_organism_class = 'CNP\\TemplateLibrary\\Content';
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		// Filter for the main Organism
		Organism::do_filter();

		foreach ( $this->sub_items_data as $sub_item_index => $sub_item_data ) {

			// Pass in supporting data for use in the sub-item.
			if ( ! empty( $this->data ) ) {
				$sub_item_data = array_merge( $sub_item_data, $this->data );
			}

			// Add the loop index
			$sub_item_data['loop-index'] = $sub_item_index;

			// Filter with suffix for individual pieces.
			Organism::do_filter( "item-$sub_item_index" );

			$sub_item_organism_object = new $this->sub_item_organism_class( $sub_item_data );

			$this->content .= $sub_item_organism_object->get_markup();
		}

		return sprintf( '%s<%s %s>%s</%s>%s', $this->before, $this->tag, $this->get_attributes(), $this->content, $this->tag, $this->after );
	}
}
