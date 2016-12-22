<?php
namespace CNP\TemplateLibrary;

/**
 * Class CategoryList
 * @package CNP\TemplateLibrary
 *
 * Uses get_the_category_list() to return a comma-delimited list of category links wrapped in a paragraph.
 *
 * @link https://developer.wordpress.org/reference/functions/get_the_category_list/
 */
class CategoryList extends Organism {

	public $separator;
	public $parents;

	/**
	 * CategoryList constructor.
	 *
	 * @param string $name
	 * @param string|bool $data Optional. A WordPress post ID. Assumes global $post if not supplied.
	 * @param string $separator The separator for the category links.
	 * @param string $parents
	 * @param string $tag
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'category-list', $data = false, $separator = ', ', $parents = '', $tag = 'p', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = null, $before, $prepend, $append, $after );

		$this->separator = $separator;
		$this->parents   = $parents;

		$this->content = get_the_category_list( $this->separator, $this->parents, $this->data );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
