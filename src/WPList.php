<?php
namespace CNP\TemplateLibrary;

/**
 * Class WPList
 *
 * @package CNP\TemplateLibrary
 */
class WPList extends Organism {

	/**
	 * Used by sub-organisms.
	 *
	 * @var array
	 */
	public $list_vars;

	/**
	 * WPList constructor.
	 *
	 * @param string $name      Organism name.
	 * @param array  $list_args Required. List args used for wp_list_pages and wp_list_categories function calls.
	 */
	public function __construct( $name = 'wp-list', $list_args ) {

		parent::__construct( $name, $data = null, $content = '', $tag = 'ul' );
	}
}
