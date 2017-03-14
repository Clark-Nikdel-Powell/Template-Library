<?php
namespace CNP\TemplateLibrary;

/**
 * Class ExcerptForce
 *
 * @package CNP\TemplateLibrary
 *
 * Forces an excerpt by using get_the_excerpt
 *
 * @link    https://developer.wordpress.org/reference/functions/get_the_excerpt/
 */
class ExcerptForce extends Excerpt {

	/**
	 * ExcerptForce constructor.
	 *
	 * @param string   $name Organism name.
	 * @param \WP_Post $data Optional. WP_Post Object. Set by Excerpt if not defined.
	 */
	public function __construct( $name = 'excerpt', \WP_Post $data = null ) {

		parent::__construct( $name, $data );

		$this->content = get_the_excerpt( $data );
	}
}
