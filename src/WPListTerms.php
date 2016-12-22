<?php
namespace CNP\TemplateLibrary;

/**
 * Class WPListTerms
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/wp_parse_args/
 * @link https://developer.wordpress.org/reference/functions/wp_list_pages/
 */
class WPListTerms extends WPList {

	public $taxonomy;

	public function __construct( $list_args, $taxonomy = '', $name = 'wp-list-terms', $data = null, $tag = 'ul', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $list_args, $name, $tag, $attributes, $before, $prepend, $append, $after );

		if ( null === $data && '' === $taxonomy ) {
			$this->data = get_post();
		}

		if ( '' !== $taxonomy ) {
			$this->taxonomy = $taxonomy;
		} else {
			$this->resolve_taxonomy();
		}

		$list_defaults   = [
			'taxonomy' => $this->taxonomy,
			'title_li' => '',
			'echo'     => false,
		];
		$this->list_vars = wp_parse_args( $list_defaults, $list_args );
	}

	/**
	 * resolve_taxonomy
	 *
	 * If a taxonomy was not passed in, assume either "category" or the first taxonomy associated with the post type.
	 */
	public function resolve_taxonomy() {

		if ( 'post' === $this->data->post_type ) {

			$this->taxonomy = 'category';

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

		return $this->prepend . wp_list_categories( $this->list_vars ) . $this->append;
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
