<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostDate
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/get_option/
 * @link https://developer.wordpress.org/reference/functions/get_post/
 * @link https://developer.wordpress.org/reference/functions/get_the_date/
 */
class PostDate extends Organism {

	private $date_format = '';

	/**
	 * PostDate constructor.
	 *
	 * @param string $date_format Optional. Defaults to WordPress data_format option.
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param null $data Optional. A WP_Post Object. Defaults to global $post.
	 * @param string $content
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'post-date', $date_format = '', $tag = 'p', array $attributes = [], $data = null, $content = '', $before = '', $prepend = '<strong>Published:</strong> ', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content, $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		if ( empty( $date_format ) ) {
			$this->date_format = get_option( 'date_format' );
		} else {
			$this->date_format = $date_format;
		}

		if ( null === $this->data ) {
			$this->data = get_post();
		}

		$this->content = get_the_date( $this->date_format, $this->data );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
