<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostTitleLink
 * @package CNP\TemplateLibrary
 *
 * A link with the post title set as the content.
 *
 * @link https://developer.wordpress.org/reference/functions/get_permalink/
 * @link https://developer.wordpress.org/reference/functions/get_the_title/
 */
class PostTitleLink extends PostTitle {

	public $link;

	/**
	 * PostTitleLink constructor.
	 *
	 * @param string $name
	 * @param string $tag Optional. Defaults to h2.
	 * @param array $attributes
	 * @param int|WP_Post $data Optional. Takes either a post ID or a WP_Post object. Defaults to the global $post.
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'posttitle-link', $tag = 'h2', array $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $data, $before, $prepend, $append, $after );

		$this->link = new LinkPost( $this->name . '-anchor', $this->content, $this->attributes, $this->data, $this->before, $this->prepend, $this->append, $this->after );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		$this->content = $this->link->get_markup();

		return parent::get_markup();
	}
}
