<?php
namespace CNP\TemplateLibrary;

class Link extends Organism {

	public function __construct( $href, $name = 'link', $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, 'a', $attributes, $content, null, $before, $prepend, $append, $after );

		$this->attributes['href'] = $href;
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
