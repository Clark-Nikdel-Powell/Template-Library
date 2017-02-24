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
	 * @param string $data Data from ACF.
	 */
	public function __construct( $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-section';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Content
		// ——————————————————————————————————————————————————————————
		if ( isset( $data['section_layouts'] ) && ! empty( $data['section_layouts'] ) ) {
			$this->content = get_acf_organisms( $this->data['section_layouts'] ); // TODO: namespace this function name in da plugin.
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
