<?php

namespace CNP\TemplateLibrary;

/**
 * Class PostTitleLink
 *
 * @package CNP\TemplateLibrary
 *
 * A link with the post title set as the content.
 *          TODO: we're probably putting this one together wrong. It should have a structure argument rather than setting up the content this way.
 *
 * @link    https://developer.wordpress.org/reference/functions/get_permalink/
 * @link    https://developer.wordpress.org/reference/functions/get_the_title/
 */
class PostTitleLink extends PostTitle {

	public $post_link;

	/**
	 * PostTitleLink constructor.
	 *
	 * @param string $name Organism name.
	 */
	public function __construct( $name = 'posttitle-link' ) {

		parent::__construct( $name );

	}

	/**
	 * Gets the post title from the parent class first, then generates and adds the link to the content based off of that.
	 *
	 * @return string
	 */
	public function get_content() {

		$this->content   = parent::get_content();
		$this->post_link = new LinkPost( $this->organism_name( 'anchor' ), $this->content, [], $this->data );
		$this->content   = $this->post_link->get_markup();

		return Organism::get_content();
	}
}
