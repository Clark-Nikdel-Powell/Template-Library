<?php
namespace CNP\TemplateLibrary;

/**
 * Class Content
 * @package CNP\TemplateLibrary
 */
class Content extends Organism {

	public function __construct( $name, $content, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content, $tag = 'div', $attributes, $structure = [], $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content );

		return parent::get_markup();
	}
}
