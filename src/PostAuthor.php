<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostAuthor
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_post/
 * @link    https://developer.wordpress.org/reference/functions/get_the_author_meta/
 */
class PostAuthor extends Organism {

	/**
	 * The author meta to display.
	 *
	 * @var string
	 */
	public $author_meta;

	/**
	 * PostAuthor constructor.
	 *
	 * @param string $name        Organism name.
	 * @param string $author_meta The author meta to display in the content.
	 */
	public function __construct( $name = 'post-author', $author_meta = 'display_name' ) {

		parent::__construct( $name );
		$this->author_meta = $author_meta;

		// This catches if we didn't pass anything in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		// This catches objects that are passed in, and if we didn't pass anything in.
		if ( is_object( $this->data ) ) {
			$this->data = $this->data->post_author;
		}
	}

	/**
	 * Set up author content.
	 */
	public function set_content() {

		// The other alternative for $data is if an author id has been passed in directly.
		// This is so that child classes (PostAuthorLink) can pass in their own content, if they need to.
		if ( '' === $this->content ) {
			$this->content = get_the_author_meta( $this->author_meta, $this->data );
		}
	}
}
