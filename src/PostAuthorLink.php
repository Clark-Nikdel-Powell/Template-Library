<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostAuthorLink
 * @package CNP\TemplateLibrary
 */
class PostAuthorLink extends PostAuthor {

	public $author_meta;

	/**
	 * PostAuthorLink constructor.
	 *
	 * @param string $author_meta
	 * @param string $name
	 * @param array $attributes
	 * @param string $content
	 * @param int|WP_Post $data Optional. A WP_Post object, or an Author ID. Defaults to global $post if not supplied.
	 * @param array $structure
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $author_meta = 'display_name', $name = 'post-author-link', array $attributes = [], $content = '', $data = null, $structure = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $author_meta, $name, $tag = 'a', $attributes, $data, $content, $before, $prepend, $append, $after );

		$this->author_meta = $author_meta;

		// $this->data is pre-set in PostAuthor, so we can use it safely without a check here.
		$this->attributes['href'] = get_author_posts_url( $this->data );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
