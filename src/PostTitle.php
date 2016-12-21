<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTitle
 * @package CNP\TemplateLibrary
 */
class PostTitle extends Organism {

	/**
	 * PostTitle constructor.
	 *
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $data
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'posttitle', $tag = 'h2', array $attributes = [], $data = null, $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content = get_the_title( $data ), $data, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
