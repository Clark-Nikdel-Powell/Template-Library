<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkFrontPage
 * @package CNP\TemplateLibrary
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
	public function __construct( $name = 'link-front-page', array $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $href = site_url(), $name, $attributes, $content, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
