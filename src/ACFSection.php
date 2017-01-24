<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFSection
 * @package CNP\TemplateLibrary
 */
class ACFSection extends Organism {

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-section';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = [], $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $data, $attributes );

		$this->hide = $this->data['hide'];

		//——————————————————————————————————————————————————————————
		//  1. Set Up Content
		//——————————————————————————————————————————————————————————
		if ( isset( $data['section_layouts'] ) && ! empty( $data['section_layouts'] ) ) {
			$this->content = get_acf_organisms( $this->data['section_layouts'] ); // TODO: namespace this function name in da plugin.
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
