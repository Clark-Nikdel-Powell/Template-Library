<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTermSingleLink
 * @package CNP\TemplateLibrary
 */
class PostTermSingleLink extends PostTermSingle {

	public $taxonomy;
	public $term;

	/**
	 * PostTermSingleLink constructor.
	 *
	 * @param string $taxonomy
	 * @param string $name
	 * @param string $tag
	 * @param int|WP_Post $data Optional. Either a post ID or WP_Post object. Defaults to global $post. Resolves to post ID in the parent class, PostTermSingle.
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $taxonomy = 'category', $name = 'post-term-single', $tag = 'a', $data = null, array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $taxonomy, $name, $tag, $data, $attributes, $before, $prepend, $append, $after );

		// Post/taxonomy resolution is handled in parent class constructor.

		$this->content = parent::get_term();

		$this->attributes['href'] = get_term_link( $this->term->term_id, $this->taxonomy );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
