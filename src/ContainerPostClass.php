<?php
namespace CNP\TemplateLibrary;

/**
 * Class ContainerPostClass
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_post_class/
 */
class ContainerPostClass extends Container {

	/**
	 * ContainerPostClass constructor.
	 *
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param int|WP_Post $data Optional. A post ID or WP_Post object. Defaults to global $post.
	 * @param array $structure
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'container-post-class', $tag = 'div', array $attributes = [], $data = null, $structure = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $structure, $before, $prepend, $append, $after );

		array_merge( $this->attributes['class'], get_post_class( '', $this->data ) );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
