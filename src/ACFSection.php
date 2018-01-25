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

		Utilities::acf_set_class_id_and_hide( $this, $this->data );
	}

	public function set_content() {

		if ( isset( $this->data['section_layouts'] ) && ! empty( $this->data['section_layouts'] ) ) {
			$this->content = get_afl_acf_organisms( $this->data['section_layouts'] );
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
