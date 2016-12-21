<?php
namespace CNP\TemplateLibrary;

/**
 * Class TaxonomyListWithLinks
 * @package CNP\TemplateLibrary
 *
 * @link
 */
class TaxonomyListWithLinks extends TaxonomyList {

	public $taxonomy;
	public $separator;

	/**
	 * TaxonomyListWithLinks constructor.
	 *
	 * @param null $taxonomy
	 * @param string $separator
	 * @param string|array|WP_post $data Optional. Name of the type of taxonomy object, or an object (row from posts). Defaults to global $post. Resolved in parent class TaxonomyList
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $taxonomy = null, $separator = ', ', $data = null, $name = 'taxonomy-list-with-links', $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $taxonomy, $separator, $data, $name, $tag, $attributes, $before, $prepend, $append, $after );

		// Post and taxonomy are resolved in TaxonomyList
	}

	/**
	 * get_content
	 *
	 * @return string
	 */
	public function get_content() {

		$this->content = get_the_term_list( $this->data, $this->taxonomy, $this->prepend, $this->separator, $this->append );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
