<?php
namespace CNP;

class PostHeaderArchive extends Organism {

	public $posttitle;

	public function __construct( $data, $name = 'postheaderarchive', $tag = 'div', array $attributes, $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		$this->posttitle = new PostTitleLink( $data, $name . '__title', $tag, $attributes, $before, $prepend, $append, $after );
	}

	public function get_markup() {

		$this->content = $this->posttitle->get_markup();

		return parent::get_markup();
	}
}
