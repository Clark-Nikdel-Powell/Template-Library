<?php

namespace CNP\TemplateLibrary;

/**
 * Class WPListTerms
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/wp_parse_args/
 * @link    https://developer.wordpress.org/reference/functions/wp_list_pages/
 */
class WPListTerms extends WPList {

	/**
	 * Registered taxonomy name.
	 *
	 * @var string
	 */
	public $taxonomy;

	/**
	 * WPListTerms constructor.
	 *
	 * @param string $name      Organism name.
	 * @param array  $list_args List args.
	 * @param string $taxonomy  Registered taxonomy name.
	 */
	public function __construct( $name = 'wp-list-terms', $list_args, $taxonomy = '' ) {

		parent::__construct( $name, $list_args );
		$this->taxonomy = $taxonomy;

		if ( null === $this->data ) {
			$this->data = get_post();
		}
	}

	/**
	 * If a taxonomy was not passed in, assume either "category" or the first taxonomy associated with the post type.
	 */
	public function resolve_taxonomy() {

		if ( 'post' === $this->data->post_type ) {
			$this->taxonomy = 'category';
		} else {

			$post_object_taxonomies = get_object_taxonomies( $this->data );
			$this->taxonomy         = array_shift( $post_object_taxonomies );
		}
	}

	/**
	 * Get the content.
	 */
	public function set_content() {

		if ( '' !== $this->taxonomy ) {
			$this->resolve_taxonomy();
		}

		$list_defaults   = [
			'taxonomy' => $this->taxonomy,
			'title_li' => '',
			'echo'     => false,
		];
		$this->list_vars = wp_parse_args( $list_defaults, $this->list_args );
		$category_links  = wp_list_categories( $this->list_vars );

		$this->content = $category_links;
	}
}
