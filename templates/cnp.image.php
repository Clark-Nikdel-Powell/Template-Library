<?php

namespace CNP;

class Image extends Organism {

	public $attachment_id;
	public $image_size;
	public $icon;

	public function __construct( $attachment_id, $image_size, $icon, $name = 'image', $tag = 'div', $attributes = [], $content = '', $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {
		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		$this->attachment_id = $attachment_id;
		$this->image_size    = $image_size;
		$this->icon          = $icon;
	}
}