<?php
namespace CNP\TemplateLibrary;

class EmailShare extends Link {

	public $message_body;

	public function __construct( $message_body = 'Check out this link!', $data = null, $name = 'email-share', $content = 'Email This', $attributes = [ 'target' => '_blank' ] ) {

		parent::__construct( 'mailto:?', $name, $attributes, $content );

		$this->data         = $data;
		$this->message_body = trim( $message_body ) . ' ';

		$this->href .= $this->encode_body();
	}

	private function encode_body() {

		if ( ! isset( $this->data ) ) {
			$this->message_body .= get_site_url();
		} elseif ( is_string( $this->data ) ) {
			$this->message_body .= $this->data;
		} elseif ( is_array( $this->data ) || is_a( $this->data, 'WP_Post' ) || is_int( $this->data ) ) {
			$this->message_body .= get_permalink( $this->data );
		}

		return preg_replace( '/ /', '+', $this->message_body );
	}
}
