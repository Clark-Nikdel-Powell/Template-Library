<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLinkEmail
 *
 * @package CNP\TemplateLibrary
 */
class ShareLinkEmail extends Link {

	/**
	 * Message body.
	 *
	 * @var string
	 */
	public $message_body;

	/**
	 * ShareLinkEmail constructor.
	 *
	 * @param string              $name         Organism name.
	 * @param string              $message_body The email message.
	 * @param string|int|\WP_Post $data         Designed for the page link, which can be supplied as a WP_Post object, a post ID, or a string.
	 * @param string              $content      Link text.
	 */
	public function __construct( $name = 'email-share', $message_body = 'Check out this link!', $data = null, $content = 'Email This' ) {

		parent::__construct( $name, $href = 'mailto:?', $content, $attributes = [ 'target' => '_blank' ] );

		$this->data         = $data;
		$this->message_body = trim( $message_body ) . ' ';

		$this->attributes['href'] = $this->encode_body();
	}

	/**
	 * Encodes the share URL.
	 *
	 * @return mixed
	 */
	private function encode_body() {

		if ( ! isset( $this->data ) ) {
			$this->message_body .= get_site_url();
		} elseif ( is_string( $this->data ) ) {
			$this->message_body .= $this->data;
		} elseif ( is_a( $this->data, 'WP_Post' ) || is_int( $this->data ) ) {
			$this->message_body .= get_permalink( $this->data );
		}

		return preg_replace( '/ /', '+', $this->message_body );
	}
}
