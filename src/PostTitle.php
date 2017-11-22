<?php

namespace CNP\TemplateLibrary;

/**
 * Class PostTitle
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_the_title/
 */
class PostTitle extends Organism {

	/**
	 * PostTitle constructor.
	 *
	 * @param string $name Organism name.
	 */
	public function __construct( $name = 'posttitle', $data = null ) {

		parent::__construct( $name, $data );
		$this->tag = 'h2';

		if ( null === $this->data ) {
			$this->data = get_post();
		}
	}

	/**
	 * Sets the content.
	 */
	public function set_content() {
		$this->content = get_the_title( $this->data );
	}
}
