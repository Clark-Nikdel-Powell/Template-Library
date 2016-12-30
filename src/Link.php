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
	 * @param string $content
	 * @param string $name
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'link', $href, $content = '', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content, $tag = 'a', $attributes, $structure = [], $before, $prepend, $append, $after );

		$this->attributes['href'] = $href;
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content );

		return parent::get_markup();
	}
}
