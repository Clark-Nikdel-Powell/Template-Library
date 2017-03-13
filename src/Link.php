<?php
namespace CNP\TemplateLibrary;

/**
 * Class Link
 *
 * @package CNP\TemplateLibrary
 */
class Link extends Organism {

	/**
	 * Link constructor.
	 *
	 * @param string $name       Organism name.
	 * @param string $data       Link href attribute.
	 * @param string $content    The link text.
	 * @param array  $attributes Any additional attributes.
	 */
	public function __construct( $name = 'link', $data, $content = '', array $attributes = [] ) {

		parent::__construct( $name, $data, $content, $tag = 'a', $attributes, $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' );

		$this->attributes['href'] = $data;
	}

	/**
	 * Check for content and structure.
	 *
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content ) && empty( $this->structure );

		return parent::get_markup();
	}
}
