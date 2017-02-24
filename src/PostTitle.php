<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTitle
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_the_title/
 */
class PostTitle extends Organism {

	/**
	 * PostTitle constructor.
	 *
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param array $data
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'posttitle', $tag = 'h2', array $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content = get_the_title( $data ), $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
