<?php
namespace CNP\TemplateLibrary;

class ExcerptForce extends Excerpt {

	public function __construct( $data, $name = 'excerpt', $tag = 'p', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $data, $name, $tag, $attributes, $before, $prepend, $append, $after );

		$this->content = get_the_excerpt( $data );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
