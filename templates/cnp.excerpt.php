<?php
namespace CNP;

class Excerpt extends Organism {

	public function __construct( $data, $name = 'excerpt', $tag = 'p', array $attributes, $before, $prepend, $append, $after ) {

		parent::__construct( $name, $tag, $attributes, '', $data, $before, $prepend, $append, $after );

		$this->content = $data->post_excerpt;
	}
}
