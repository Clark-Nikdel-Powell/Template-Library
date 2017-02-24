<?php
namespace CNP\TemplateLibrary;

class PostContent extends Content {

	public $class;

	public function __construct( $name = 'postcontent', $class = 'postcontent' ) {

		parent::__construct( $name, get_the_content() );
		array_push( $this->attributes['class'], $this->class );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
