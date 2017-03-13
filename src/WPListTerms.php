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
	 * @param string   $name      Organism name.
	 * @param array    $list_args List args.
	 * @param string   $taxonomy  Registered taxonomy name.
	 * @param \WP_Post $data      WP_Post object.
	 */
	public function __construct( $name = 'wp-list-terms', $list_args, $taxonomy = '', $data = null ) {

		parent::__construct( $name, $list_args );

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
	 * Get the content.
	 *
	 * @return string
	 */
	public function get_content() {

		return $this->prepend . wp_list_categories( $this->list_vars ) . $this->append;
	}
}
