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
	 */
	public function __construct( $name = 'link-post', $content = '', array $attributes = [], $data = null ) {

		parent::__construct( $name, $data = get_permalink( $data ), $content, $attributes );
	}
}
