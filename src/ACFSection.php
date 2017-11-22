<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFSection
 *
 * @package CNP\TemplateLibrary
 */
class ACFSection extends Organism {

	/**
	 * ACFSection constructor.
	 *
	 * @param array $data Data from ACF.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-section';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		// TODO: maybe refactor this into the acf_set_class_and_id method, so we don't have to set it manually.
		$this->hide = $this->data['hide'];
	}

	public function set_content() {

		if ( isset( $this->data['section_layouts'] ) && ! empty( $this->data['section_layouts'] ) ) {
			$this->content = get_acf_organisms( $this->data['section_layouts'] ); // TODO: namespace this function name in the ACF Flex Layouts plugin.
		}
	}

	/**
	 * Get_markup
	 *
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content );

		return parent::get_markup();
	}
}
