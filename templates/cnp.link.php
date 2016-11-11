<?php
namespace CNP;

class Link extends Organism {

	public $href;

	public function __construct( $href, $name = 'link', $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, 'a', $attributes, $content, null, $before, $prepend, $append, $after );

		$this->attributes['href'] = $href;
	}
}
