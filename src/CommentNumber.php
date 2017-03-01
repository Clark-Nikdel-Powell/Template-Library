<?php
namespace CNP\TemplateLibrary;

/**
 * Class CommentNumber
 *
 * @package CNP\TemplateLibrary
 *
 * Displays the number of comments on a post.
 *
 * @link    https://developer.wordpress.org/reference/functions/get_comments_number/
 */
class CommentNumber extends Organism {

	/**
	 * CommentNumber constructor.
	 *
	 * @param string      $name       Organism name.
	 * @param int|WP_Post $data       Optional. Post ID or WP_Post object. Default is global $post.
	 * @param string      $tag        Organism tag.
	 * @param array       $attributes Organism attributes.
	 * @param string      $content    Organism content.
	 * @param string      $before     Before.
	 * @param string      $prepend    Prepend.
	 * @param string      $append     Append.
	 * @param string      $after      After.
	 */
	public function __construct( $name = 'comment-number', $data = 0, $tag = 'div', array $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content, $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		$this->content = get_comments_number( $this->data );
	}
}
