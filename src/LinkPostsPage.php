<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkPostsPage
 * @package CNP\TemplateLibrary
 */
class LinkPostsPage extends Link {

	/**
	 * LinkPostsPage constructor.
	 *
	 * @param string $name
	 * @param array $attributes
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'link-posts-page', array $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $href = get_permalink( get_option( 'page_for_posts' ) ), $name, $attributes, $content, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
