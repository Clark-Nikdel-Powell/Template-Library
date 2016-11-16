<?php
namespace CNP;

class ExcerptForce extends Organism {

	public function __construct( $data, $name = 'excerpt', $tag = 'p', array $attributes, $before, $prepend, $append, $after ) {

		parent::__construct( $name, $tag, $attributes, '', $data, $before, $prepend, $append, $after );

		$this->content = get_the_excerpt( $data );
	}
}
