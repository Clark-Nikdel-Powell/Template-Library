<?php
namespace CNP\TemplateLibrary;

/**
 * Class WPListPages
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 * @link https://developer.wordpress.org/reference/functions/wp_list_pages/
 */
class WPListPages extends WPList {

	public function __construct( $list_args, $name = 'wp-list-pages', $tag = 'ul', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $list_args, $name, $tag, $attributes, $before, $prepend, $append, $after );

		$list_defaults   = [
			'post_type' => 'page',
			'title_li'  => '',
			'echo'      => false,
		];
		$this->list_vars = wp_parse_args( $list_defaults, $list_args );
	}

	/**
	 * get_content
	 *
	 * @return string
	 */
	public function get_content() {

		return $this->prepend . wp_list_pages( $this->list_vars ) . $this->append;
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}