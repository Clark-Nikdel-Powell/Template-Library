<?php
namespace CNP\TemplateLibrary;

/**
 * Class ExcerptForce
 * @package CNP\TemplateLibrary
 *
 * Forces an excerpt by using get_the_excerpt
 *
 * @link https://developer.wordpress.org/reference/functions/get_the_excerpt/
 */
class ExcerptForce extends Excerpt {

	/**
	 * ExcerptForce constructor.
	 *
	 * @param string $name
	 * @param string $data Optional. WP_Post Object. Set by Excerpt if not defined.
	 * @param string $tag
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'excerpt', $data, $tag = 'p', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $data, $before, $prepend, $append, $after );

		$this->content = get_the_excerpt( $data );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
