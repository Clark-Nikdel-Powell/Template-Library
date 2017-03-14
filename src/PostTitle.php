<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTitle
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_the_title/
 */
class PostTitle extends Organism {

	/**
	 * PostTitle constructor.
	 *
	 * @param string $name Organism name.
	 * @param string $tag  The HTML tag.
	 */
	public function __construct( $name = 'posttitle', $tag = 'h2' ) {

		parent::__construct( $name, $data = null, $content = get_the_title( $data ), $tag );
	}
}
