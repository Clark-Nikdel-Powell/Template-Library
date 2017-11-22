<?php
namespace CNP\TemplateLibrary;

/**
 * Class Content
 *
 * @package CNP\TemplateLibrary
 */
class Content extends Organism {

	/**
	 * Content constructor.
	 *
	 * @param string $name    Organism name.
	 * @param null   $content Content.
	 */
	public function __construct( $name, $content ) {

		parent::__construct( $name, null, $content );
	}

	/**
	 * Hide if no content.
	 *
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content );

		return parent::get_markup();
	}
}
