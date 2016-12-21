<?php
namespace CNP\TemplateLibrary;

/**
 * Class Container
 * @package CNP\TemplateLibrary
 */
class Container extends Organism {

	/**
	 * Container constructor.
	 *
	 * @param string $name
	 * @param array $attributes
	 * @param array $structure
	 * @param string $before
	 * @param null $prepend
	 * @param array $append
	 * @param string $after
	 */
	public function __construct( $name, array $attributes, $structure, $before, $prepend, $append, $after ) {

		parent::__construct( $name, 'div', $attributes, null, null, $structure, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
