<?php
namespace CNP\TemplateLibrary;

/**
 * Class TaxonomyList
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_post/
 * @link https://developer.wordpress.org/reference/functions/get_object_taxonomies/
 * @link https://developer.wordpress.org/reference/functions/get_the_terms/
 */
class TaxonomyList extends Organism {

	public $taxonomy;
	public $delimiter;

	/**
	 * TaxonomyList constructor.
	 *
	 * @param null $taxonomy
	 * @param string $delimiter
	 * @param string|array|WP_post $data Optional. Name of the type of taxonomy object, or an object (row from posts). Defaults to global $post.
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'taxonomy-list', $taxonomy = null, $delimiter = ', ', $data = null, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content = '', $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		// This catches if we didn't pass anything in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		$this->delimiter = $delimiter;

		if ( null !== $taxonomy ) {
			$this->taxonomy = $taxonomy;
		} else {
			$post_object_taxonomies = get_object_taxonomies( $this->data );
			$this->taxonomy = array_shift( $post_object_taxonomies );
		}
	}

	/**
	 * get_content
	 *
	 * @return string
	 */
	public function get_content() {

		$terms_arr      = get_the_terms( $this->data, $this->taxonomy );
		$term_names_arr = array();

		if ( ! empty( $terms_arr ) ) {

			foreach ( $terms_arr as $term_obj ) {
				$term_names_arr[] = '<span class="name">' . $term_obj->name . '</span>';
			}

			$terms_list = implode( $this->delimiter, $term_names_arr );

			$this->content = $this->prepend . $terms_list . $this->append;
		} else {
			$this->content = '';
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
