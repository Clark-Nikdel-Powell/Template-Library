<?php
namespace CNP\TemplateLibrary;

class PostDate extends Organism {

	private $date_format = '';

	public function __construct( $data, $date_format = '', $name = 'post-date', $tag = 'p', array $attributes, $content = '', $before = '', $prepend = '<strong>Published:</strong> ', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		if ( empty( $date_format ) ) {
			$this->date_format = get_option( 'date_format' );
		} else {
			$this->date_format = $date_format;
		}

		$this->content = get_the_date( $this->date_format, $this->data );
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
