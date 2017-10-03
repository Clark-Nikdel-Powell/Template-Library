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

	public $post_link;

	/**
	 * PostTitleLink constructor.
	 *
	 * @param string $name Organism name.
	 */
	public function __construct( $name = 'posttitle-link' ) {

		parent::__construct( $name );

		$this->post_link = new LinkPost( $this->organism_name( 'anchor' ), $this->content, [], $this->data );
		$this->structure = [ $this->post_link ];

	}

	/**
	 * Gets the post title from the parent class first, then generates and adds the link to the content based off of that.
	 */
	public function set_content() {

		// Get the post title from the parent
		parent::set_content();

		// Pass the post title in to the post link
		$this->post_link->content = $this->content;

		// Clear out the content so we don't duplicate it
		$this->content = '';
	}
}
