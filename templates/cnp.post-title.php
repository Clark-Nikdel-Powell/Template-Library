<?php
namespace CNP;

class PostTitle extends Organism {

	public function __construct( $name = 'posttitle', $tag = 'h2', $attributes = [], $content = '', $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, get_the_title( $data ), $data, $before, $prepend, $append, $after );
	}
}
