<?php
namespace CNP\TemplateLibrary;

class PostTitleLink extends Organism {

	public $link;

	public function __construct( $data, $name = 'posttitlelink', $tag = 'h2', $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		$this->link = new Link( get_permalink( $data ), $name, $attributes, get_the_title( $data ), $before, $prepend, $append, $after );
	}

	public function get_markup() {

		$this->content = $this->link->get_markup();

		return parent::get_markup();
	}
}
