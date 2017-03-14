<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTitleLink
 *
 * @package CNP\TemplateLibrary
 *
 * A link with the post title set as the content.
 *
 * @link    https://developer.wordpress.org/reference/functions/get_permalink/
 * @link    https://developer.wordpress.org/reference/functions/get_the_title/
 */
class PostTitleLink extends PostTitle {

	/**
	 * PostTitleLink constructor.
	 *
	 * @param string $name Organism name.
	 * @param string $tag  Optional. Defaults to h2.
	 */
	public function __construct( $name = 'posttitle-link', $tag = 'h2' ) {

		parent::__construct( $name, $tag );

		$this->structure = [ new LinkPost( $this->name . '-anchor', $this->content, $this->attributes, $this->data ) ];
	}

	/**
	 * Get the markup.
	 *
	 * @return string
	 */
	public function get_markup() {

		$this->content = $this->link->get_markup();

		return parent::get_markup();
	}
}
