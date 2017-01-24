<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFContent
 * @package CNP\TemplateLibrary
 */
class ACFContent extends Organism {

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-content';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		$content = trim( $data['content'] );

		parent::__construct( $name, $tag, $attributes, $content, $data, $structure = [], $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content );

		return parent::get_markup();
	}
}
