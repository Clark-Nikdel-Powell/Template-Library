<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostAuthorLink
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_author_posts_url/
 */
class PostAuthorLink extends PostAuthor {

	/**
	 * PostAuthorLink constructor.
	 *
	 * @param string $name        Organism name.
	 * @param string $author_meta Author meta to display, set up in PostAuthor.
	 */
	public function __construct( $name = 'post-author-link', $author_meta = 'display_name' ) {

		parent::__construct( $name, $author_meta );
		$this->tag = 'a';

		// $this->data is pre-set in PostAuthor, so we can use it safely without a check here.
		$this->attributes['href'] = get_author_posts_url( $this->data );
	}
}
