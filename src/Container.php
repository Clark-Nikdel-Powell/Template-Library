<?php
namespace CNP\TemplateLibrary;

class Container extends Organism {

	public function __construct( $name, array $attributes ) {

		parent::__construct( $name, 'div', $attributes );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
