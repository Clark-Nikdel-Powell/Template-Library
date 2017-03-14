<?php
namespace CNP\TemplateLibrary;

/**
 * Class LinkFrontPage
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_site_url/
 * @link    https://developer.wordpress.org/reference/functions/get_bloginfo/
 */
class LinkFrontPage extends Link {

	/**
	 * LinkFrontPage constructor.
	 *
	 * @param string $name    Organism name.
	 * @param string $content Link content.
	 */
	public function __construct( $name = 'link-front-page', $content = '' ) {

		parent::__construct( $name, $data = get_site_url(), $content );

		if ( '' === $this->content ) {
			$this->content = get_bloginfo( 'name' );
		}
	}
}
