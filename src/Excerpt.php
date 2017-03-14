<?php
namespace CNP\TemplateLibrary;

/**
 * Class Excerpt
 *
 * @package CNP\TemplateLibrary
 *
 * A WordPress post excerpt. Only displays if a Post Excerpt has been set. To always display something, use ExcerptForce, which grabs post content if an excerpt is not set using get_the_excerpt().
 * @link    https://developer.wordpress.org/reference/functions/get_post/
 */
class Excerpt extends Organism {

	/**
	 * Excerpt constructor.
	 *
	 * @param string   $name Organism name.
	 * @param \WP_Post $data Optional. WP_Post object. Default is global $post.
	 */
	public function __construct( $name = 'excerpt', \WP_Post $data = null ) {

		parent::__construct( $name, $data );

		// This catches if we didn't pass anything in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		if ( ! empty( $this->data->post_excerpt ) ) {
			$this->content = $this->data->post_excerpt;
		}
	}
}
