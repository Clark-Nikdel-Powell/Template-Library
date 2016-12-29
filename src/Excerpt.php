<?php
namespace CNP\TemplateLibrary;

/**
 * Class Excerpt
 * @package CNP\TemplateLibrary
 *
 * A WordPress post excerpt. Only disaplys if a Post Excerpt has been set. To always display something, use ExcerptForce, which grabs post content if an excerpt is not set using get_the_excerpt().
 * @link https://developer.wordpress.org/reference/functions/get_post/
 */
class Excerpt extends Organism {

	/**
	 * Excerpt constructor.
	 *
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $data Optional. WP_Post object. Default is global $post.
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'excerpt', $tag = 'p', array $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content = '', $tag, $attributes, $structure = [], $before, $prepend, $append, $after );

		// This catches if we didn't pass anything in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		if ( ! empty( $this->data->post_excerpt ) ) {
			$this->content = $this->data->post_excerpt;
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
