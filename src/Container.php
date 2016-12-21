<?php
namespace CNP\TemplateLibrary;

/**
 * Class Container
 * @package CNP\TemplateLibrary
 *
 * A containing div
 */
class Container extends Organism {

	/**
	 * Container constructor.
	 *
	 * @param string $name
	 * @param array $attributes
	 * @param array $structure
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name, array $attributes = [], array $structure = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag = 'div', $attributes, $content = null, $data = null, $structure, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
