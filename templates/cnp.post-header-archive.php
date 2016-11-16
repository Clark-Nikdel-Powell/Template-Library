<?php
namespace CNP;

class PostHeaderArchive extends Organism {

	public $post_title;
	public $post_date;
	public $post_author;
	public $category_list;
	public $excerpt;

	public function __construct( $data, $name = 'postheaderarchive', $tag = 'div', array $attributes, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, '', $data, $before, $prepend, $append, $after );

		$this->post_title    = new PostTitleLink( $data, $name . '__title' );
		$this->post_date     = new PostDate( $data, $name . '__date' );
		$this->post_author   = new PostAuthor( $data, '', $name . '__author' );
		$this->category_list = new CategoryList( $data, '', $name . '__categories' );
		$this->excerpt       = new ExcerptForce( $data, $name . '__excerpt' );
	}

	public function get_markup() {

		$this->content .= $this->post_title->get_markup();
		$this->content .= $this->post_date->get_markup();
		$this->content .= $this->post_author->get_markup();
		$this->content .= $this->category_list->get_markup();
		$this->content .= $this->excerpt->get_markup();

		return parent::get_markup();
	}
}
