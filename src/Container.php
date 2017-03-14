<?php
namespace CNP\TemplateLibrary;

/**
 * Class Container
 *
 * @package CNP\TemplateLibrary
 *
 * A containing div. Meant to hold other things, not to have content itself. If you need a generic Organism for content, please see Content
 */
class Container extends Organism {

	/**
	 * Container constructor.
	 *
	 * @param string $name        Organism name.
	 * @param array  $structure   Structure.
	 * @param string $parent_name Optional. Parent name.
	 * @param string $separator   Optional. Separator between parent name and sub-organism names.
	 */
	public function __construct( $name, $structure, $parent_name = '', $separator = '__' ) {

		parent::__construct( $name, $data = null, $content = '', $tag = 'div', $attributes = [], $structure, $parent_name, $separator );
	}

	/**
	 * Get markup
	 *
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->structure );

		return parent::get_markup();
	}
}
