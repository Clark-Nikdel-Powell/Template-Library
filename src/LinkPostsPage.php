<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkPostsPage
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_permalink/
 * @link    https://developer.wordpress.org/reference/functions/get_option/
 */
class LinkPostsPage extends Link {

	/**
	 * LinkPostsPage constructor.
	 *
	 * @param string $name    Organism name.
	 * @param string $content Content for the link.
	 */
	public function __construct( $name = 'link-posts-page', $content ) {

		parent::__construct( $name, $data = get_permalink( get_option( 'page_for_posts' ) ), $content );
	}
}
