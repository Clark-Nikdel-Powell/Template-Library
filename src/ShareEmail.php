<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareEmail
 * @package CNP\TemplateLibrary
 */
class ShareEmail extends Link {

	public $message_body;

	/**
	 * ShareEmail constructor.
	 *
	 * @param string $message_body
	 * @param null $data
	 * @param string $name
	 * @param string $content
	 * @param array $attributes
	 */
	public function __construct( $message_body = 'Check out this link!', $data = null, $name = 'email-share', $content = 'Email This', $attributes = [ 'target' => '_blank' ] ) {

		parent::__construct( $href = 'mailto:?', $name, $attributes, $content );

		$this->data         = $data;
		$this->message_body = trim( $message_body ) . ' ';

		$this->attributes['href'] = $this->encode_body();
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}

	/**
	 * @return mixed
	 */
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
