<?php
namespace CNP;

class PostDate extends Organism {

	public function __construct( $data, $name = 'postdate', $tag = 'p', array $attributes, $content = '', $before = '', $prepend = '<strong>Published:</strong> ', $append = '', $after = '' ) {

		$date_format = get_option( 'date_format' );

		parent::__construct( $name, $tag, $attributes, get_the_date( $date_format, $data ), $data, $before, $prepend, $append, $after );
	}
}
