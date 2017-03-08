<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkPost
 *
 * @package CNP\TemplateLibrary
 *
 * A post link with customizable content. To display a post link with the post title, use PostTitleLink instead.
 *
 * @see     Link
 * @link    https://developer.wordpress.org/reference/functions/get_permalink/
 */
class LinkPost extends Link {

	/**
	 * PostLink constructor.
	 *
	 * @param string       $name       Optional. Defaults to 'postlink'.
	 * @param string       $content    Required. The content for the link.
	 * @param array        $attributes Other attributes.
	 * @param int|\WP_Post $data       Optional. Takes either a post ID or a WP_Post object. Defaults to the global $post.
	 * @param string       $before     Before opening tag.
	 * @param string       $prepend    Inside opening tag.
	 * @param string       $append     Before closing tag.
	 * @param string       $after      After closing tag.
	 */
	public function __construct( $name = 'link-post', $content, array $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $href = get_permalink( $data ), $content, $attributes, $before, $prepend, $append, $after );
	}
}
