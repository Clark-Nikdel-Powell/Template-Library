<?php
namespace CNP\TemplateLibrary;

/**
 * Class WPListPages
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/wp_parse_args/
 * @link    https://developer.wordpress.org/reference/functions/wp_list_pages/
 */
class WPListPages extends WPList {

	/**
	 * WPListPages constructor.
	 *
	 * @param string $name      Organism name.
	 * @param array  $list_args List args.
	 */
	public function __construct( $name = 'wp-list-pages', $list_args ) {

		parent::__construct( $name, $list_args );

		$list_defaults   = [
			'post_type' => 'page',
			'title_li'  => '',
			'echo'      => false,
		];
		$this->list_vars = wp_parse_args( $list_defaults, $list_args );
	}

	/**
	 * Get the content.
	 */
	public function get_content() {

		$this->content = wp_list_pages( $this->list_vars );
	}
}
