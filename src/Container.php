<?php
namespace CNP\TemplateLibrary;

/**
 * Class Container
 * @package CNP\TemplateLibrary
 *
 * A containing div. Meant to hold other things, not to have content itself. If you need a generic Organism for content, please see Content.php
 */
class Container extends Organism {

	/**
	 * Container constructor.
	 *
	 * @param string $name
	 * @param array $structure
	 * @param string $tag
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name, $structure, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content = null, $data = null, $structure, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
