<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTermSingleLink
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_term_link/
 */
class PostTermSingleLink extends PostTermSingle {

	/**
	 * PostTermSingleLink constructor.
	 *
	 * @param string      $name     Organism name.
	 * @param string      $taxonomy Registered taxonomy name.
	 * @param string      $tag      Organism tag.
	 * @param int|WP_Post $data     Optional. Either a post ID or WP_Post object. Defaults to global $post. Resolves to post ID in the parent class, PostTermSingle.
	 */
	public function __construct( $name = 'post-term-single-link', $taxonomy = 'category', $tag = 'a', $data = null ) {

		parent::__construct( $taxonomy, $name, $tag, $data );

		// Post/taxonomy resolution is handled in parent class constructor.
		$this->content = parent::get_term();

		$this->attributes['href'] = get_term_link( $this->term->term_id, $this->taxonomy );
	}
}
