<?php
namespace CNP\TemplateLibrary;

/**
 * Class Excerpt
 * @package CNP\TemplateLibrary
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

		parent::__construct( $name, $tag, $attributes, '', $data, null, $before, $prepend, $append, $after );

		if ( null === $this->data ) {
			$this->data = get_post();
		}

		if ( isset( $this->data->post_excerpt ) ) {
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
