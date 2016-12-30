<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkPost
 * @package CNP\TemplateLibrary
 *
 * A post link with customizable content. To display a post link with the post title, use PostTitleLink instead.
 *
 * @see Link
 * @link https://developer.wordpress.org/reference/functions/get_permalink/
 */
class LinkPost extends Link {

	/**
	 * PostLink constructor.
	 *
	 * @param string $content Required. The content for the link.
	 * @param string $name Optional. Defaults to 'postlink'.
	 * @param array $attributes
	 * @param int|WP_Post $data Optional. Takes either a post ID or a WP_Post object. Defaults to the global $post.
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'link-post', $content, array $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $href = get_permalink( $data ), $content, $name, $attributes, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
