<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkFrontPage
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_site_url/
 * @link https://developer.wordpress.org/reference/functions/get_bloginfo/
 */
class LinkFrontPage extends Link {

	/**
	 * LinkFrontPage constructor.
	 *
	 * @param string $name
	 * @param array $attributes
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'link-front-page', $content = '', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $href = get_site_url(), $name, $attributes, $content, $before, $prepend, $append, $after );

		if ( '' === $this->content ) {
			$this->content = get_bloginfo( 'site_title' );
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
