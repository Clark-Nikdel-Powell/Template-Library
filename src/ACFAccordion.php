<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFAccordion
 * @package CNP\TemplateLibrary
 */
class ACFAccordion extends Organism {

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-accordion';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = [], $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];


	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
