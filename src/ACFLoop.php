<?php

namespace CNP\TemplateLibrary;

/**
 * Class Loop
 *
 * @package CNP\TemplateLibrary
 *
 * A basic foreach loop, used for handling an array of data
 */
class ACFLoop extends Organism {

	/**
	 * Sub-item Template Library class
	 *
	 * @var string
	 */
	public $sub_item_organism_class;

	/**
	 * Sub-item data
	 *
	 * @var array
	 */
	public $sub_items_data;

	/**
	 * ACFLoop constructor.
	 *
	 * @param string $name                    The Organism Name.
	 * @param array  $sub_items_data          The data for each sub-item.
	 * @param string $sub_item_organism_class The TemplateLibrary Class.
	 * @param string $container_tag           Tag of the container
	 * @param array  $container_attributes    Array of attributes to apply to the container
	 */
	public function __construct( $name = 'loop', array $sub_items_data, $sub_item_organism_class = '', $container_tag = 'div', $container_attributes = [] ) {

		parent::__construct( $name, null, '', $container_tag, $container_attributes );

		$this->sub_items_data = $sub_items_data;

		$this->sub_item_organism_class = $sub_item_organism_class;
		if ( ! class_exists( $this->sub_item_organism_class ) ) {
			$this->sub_item_organism_class = 'CNP\\TemplateLibrary\\Content';
		}
	}

	/**
	 * Runs a foreach loop and gets the content.
	 *
	 * @return string
	 */
	public function get_markup() {

		// Filter for the main Organism.
		$this->do_filter();

		foreach ( $this->sub_items_data as $sub_item_index => $sub_item_data ) {

			// Pass in supporting data for use in the sub-item.
			if ( ! empty( $this->data ) ) {
				$sub_item_data = array_merge( $sub_item_data, $this->data );
			}

			// Add the loop index.
			$sub_item_data['loop-index'] = $sub_item_index;

			// Filter with suffix for individual pieces.
			$this->do_filter( "item-$sub_item_index" );

			$sub_item_organism_object = new $this->sub_item_organism_class( $sub_item_data );

			$this->content .= $sub_item_organism_object->get_markup();
		}

		// TODO: test with prepend and append.
		return sprintf( '%s<%s %s>%s</%s>%s', $this->before, $this->tag, $this->get_attributes(), $this->content, $this->tag, $this->after );
	}
}
