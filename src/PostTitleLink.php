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

		$this->content = parent::get_content();

		$post_link     = new LinkPost( $this->organism_name( 'anchor' ), $this->content, $this->attributes, $this->data );
		$this->content = $post_link->get_markup();

		return Organism::get_content();
	}
}
