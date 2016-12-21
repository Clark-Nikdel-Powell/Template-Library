<?php
namespace CNP\TemplateLibrary;

/**
 * Class CommentNumber
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_comments_number/
 */
class CommentNumber extends Organism {

	/**
	 * CommentNumber constructor.
	 *
	 * @param string $name
	 * @param int|WP_Post $data Optional. Post ID or WP_Post object. Default is global $post.
	 * @param string $tag
	 * @param array $attributes
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'comment-number', $data = 0, $tag = 'div', $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, null, $before, $prepend, $append, $after );

		$this->content = get_comments_number( $this->data );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
