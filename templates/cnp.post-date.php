<?php
namespace CNP;

class PostDate extends Organism {

	public $date_format;

	public function __construct( $data, $date_format = '', $name = 'post-date', $tag = 'p', array $attributes, $content = '', $before = '', $prepend = '<strong>Published:</strong> ', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		$this->set_date_format( $date_format );
		$this->content = get_the_date( $date_format, $data );
	}

	private function set_date_format( $date_format ) {

		if ( '' !== $date_format ) {
			$this->date_format = $date_format;

			return;
		}

		$this->date_format = get_option( 'date_format' );
	}
}
