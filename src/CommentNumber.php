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
	 * @param string       $name Organism name.
	 * @param int|\WP_Post $data Optional. Post ID or WP_Post object. Default is global $post.
	 */
	public function __construct( $name = 'comment-number', $data = null ) {

		parent::__construct( $name, $data );

		if ( null === $this->data ) {
			$this->data = get_post();
		}
	}

	public function set_content() {
		$this->content = get_comments_number( $this->data );
	}
}
