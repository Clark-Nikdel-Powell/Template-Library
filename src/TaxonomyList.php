<?php
namespace CNP\TemplateLibrary;

/**
 * Class TaxonomyList
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_post/
 * @link    https://developer.wordpress.org/reference/functions/get_object_taxonomies/
 * @link    https://developer.wordpress.org/reference/functions/get_the_terms/
 */
class TaxonomyList extends Organism {

	/**
	 * Registered taxonomy name.
	 *
	 * @var string
	 */
	public $taxonomy;

	/**
	 * Characters to put in between taxonomy items.
	 *
	 * @var string
	 */
	public $delimiter;

	/**
	 * TaxonomyList constructor.
	 *
	 * @param string $name      Organism name.
	 * @param string $taxonomy  Registered taxonomy name.
	 * @param string $delimiter Inserted between each item.
	 */
	public function __construct( $name = 'taxonomy-list', $taxonomy = '', $delimiter = ', ' ) {

		parent::__construct( $name );

		$this->data      = get_post();
		$this->delimiter = $delimiter;

		if ( null !== $taxonomy ) {
			$this->taxonomy = $taxonomy;
		} else {
			$post_object_taxonomies = get_object_taxonomies( $this->data );
			$this->taxonomy         = array_shift( $post_object_taxonomies );
		}
	}

	/**
	 * Gets the list.
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
}
