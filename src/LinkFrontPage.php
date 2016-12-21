<?php
namespace CNP\TemplateLibrary;

class LinkFrontPage extends Link {

	public function __construct( $name = 'link-front-page', array $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $href = site_url(), $name, $attributes, $content, $before, $prepend, $append, $after );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
