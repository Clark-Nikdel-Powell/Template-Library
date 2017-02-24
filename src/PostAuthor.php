<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostAuthor
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_post/
 * @link https://developer.wordpress.org/reference/functions/get_the_author_meta/
 */
class PostAuthor extends Organism {

	public $author_meta;

	/**
	 * PostAuthor constructor.
	 *
	 * @param string $author_meta
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param WP_Post|int $data Optional. A WP_Post object, or an Author ID. Defaults to global $post if not supplied.
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'post-author', $author_meta = 'display_name', $tag = 'p', array $attributes = [], $data = null, $content = '', $before = '', $prepend = 'By: ', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content, $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		$this->author_meta = $author_meta;

		// This catches if we didn't pass anything in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		// This catches objects that are passed in, and if we didn't pass anything in.
		if ( is_object( $this->data ) ) {
			$this->data = $this->data->post_author;
		}

		// The other alternative for $data is if an author id has been passed in directly.

		// This is so that child classes (PostAuthorLink) can pass in their own content, if they need to.
		if ( '' === $this->content ) {
			$this->content = get_the_author_meta( $this->author_meta, $this->data );
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
