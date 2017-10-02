<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostDate
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_option/
 * @link    https://developer.wordpress.org/reference/functions/get_post/
 * @link    https://developer.wordpress.org/reference/functions/get_the_date/
 */
class PostDate extends Organism {

	/**
	 * PHP Date format.
	 *
	 * @var string
	 */
	public $date_format;

	/**
	 * PostDate constructor.
	 *
	 * @param string $name        Organism name.
	 * @param string $date_format Optional. Defaults to WordPress date_format option.
	 */
	public function __construct( $name = 'post-date', $date_format = '' ) {

		parent::__construct( $name );

		if ( empty( $date_format ) ) {
			$this->date_format = get_option( 'date_format' );
		} else {
			$this->date_format = $date_format;
		}

		if ( null === $this->data ) {
			$this->data = get_post();
		}
	}

	/**
	 * Sets up the content.
	 */
	public function get_content() {

		$this->content = get_the_date( $this->date_format, $this->data );
	}
}
