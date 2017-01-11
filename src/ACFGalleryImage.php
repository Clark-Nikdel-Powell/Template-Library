<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFGalleryImage
 * @package CNP\TemplateLibrary
 */
class ACFGalleryImage extends Organism {

	public function __construct( $data ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $before = '', $prepend = '', $append = '', $after = '' );

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
