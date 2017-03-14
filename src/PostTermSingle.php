<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTermSingle
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_post/
 * @link    https://developer.wordpress.org/reference/functions/wp_get_post_terms/
 * @link    https://developer.wordpress.org/reference/functions/is_wp_error/
 */
class PostTermSingle extends Organism {

	/**
	 * Registered taxonomy term.
	 *
	 * @var string
	 */
	public $taxonomy;

	/**
	 * A single taxonomy term.
	 *
	 * @var string
	 */
	public $term;

	/**
	 * PostTermSingle constructor.
	 *
	 * @param string       $name     Organism name.
	 * @param string       $taxonomy Registered taxonomy name.
	 * @param string       $tag      Optional. Included because PostTermSingleLink changes the tag to 'a'.
	 * @param int|\WP_Post $data     Optional. Either a post ID or WP_Post object. Defaults to global $post. Resolves to post ID.
	 */
	public function __construct( $name = 'post-term-single', $taxonomy = 'category', $tag = 'div', $data = null ) {

		parent::__construct( $name, $data, $content = '', $tag, $attributes = [], $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' );

		$this->taxonomy = $taxonomy;

		// This catches if we didn't pass a post ID or WP_Post object in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		// This catches objects that are passed in, and if we didn't pass anything in.
		if ( is_object( $this->data ) ) {
			$this->data = $this->data->ID;
		}

		$this->content = $this->get_term();
	}

	/**
	 * Get a single term.
	 *
	 * @return string
	 */
	public function get_term() {

		// Get the post terms.
		$post_terms          = get_the_terms( $this->data, $this->taxonomy );
		$first_post_term_obj = '';
		$term_name           = '';

		if ( is_wp_error( $post_terms ) ) {
			return '';
		}

		if ( ! empty( $post_terms ) ) {
			$first_post_term_obj = array_shift( $post_terms );
		}

		$this->term = $first_post_term_obj;

		if ( '' !== $first_post_term_obj->name ) {
			$term_name = $first_post_term_obj->name;
		}

		return $term_name;
	}
}
