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
	 * @param string $parent_name
	 * @param string $separator
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name, $structure, $tag = 'div', array $attributes = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content = '', $tag, $attributes, $structure, $parent_name, $separator, $before, $prepend, $append, $after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->structure );

		$markup = parent::get_markup();

		return $markup;
	}
}
