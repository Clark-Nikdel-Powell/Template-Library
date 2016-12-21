<?php
namespace CNP\TemplateLibrary;

/**
 * Class Link
 * @package CNP\TemplateLibrary
 */
class Link extends Organism {

	/**
	 * Link constructor.
	 *
	 * @param string $href
	 * @param string $name
	 * @param array $attributes
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $href, $name = 'link', $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, 'a', $attributes, $content, null, null, $before, $prepend, $append, $after );

		$this->attributes['href'] = $href;
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
