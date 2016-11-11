<?php
namespace CNP;

class PostLink extends Link {

	public function __construct( $name = '', $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( get_permalink( $data ), $name, $attributes, get_the_title( $data ), $before, $prepend, $append, $after );
	}
}
