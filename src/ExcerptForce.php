<?php
namespace CNP\TemplateLibrary;

/**
 * Class ExcerptForce
 * @package CNP\TemplateLibrary
 */
class ExcerptForce extends Excerpt {

	/**
	 * ExcerptForce constructor.
	 *
	 * @param string $data Optional. WP_Post Object. Set by Excerpt if not defined.
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $data, $name = 'excerpt', $tag = 'p', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $data, $name, $tag, $attributes, $before, $prepend, $append, $after );

		$this->content = get_the_excerpt( $data );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
