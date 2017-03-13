<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLinkTwitter
 *
 * @package CNP\TemplateLibrary
 */
class ShareLinkTwitter extends ShareLink {

	/**
	 * Used to pre-fill a tweet.
	 *
	 * @var string
	 */
	public $status;

	/**
	 * ShareLinkTwitter constructor.
	 *
	 * @param string $name      Organism name.
	 * @param string $status    Optional. The status is used to pre-fill a tweet.
	 * @param string $share_url Optional. A custom URL to share. Defaults to the current post, or the site URL.
	 * @param bool   $use_icon  Optional. Whether to substitute content with an icon. Resolved in parent ShareLink class.
	 * @param string $content   Optional. Content to display inside the link, can be overridden with use_icon parameter.
	 */
	public function __construct( $name = 'share-link-twitter', $status = '', $share_url = '', $use_icon = false, $content = 'Share on Twitter' ) {

		parent::__construct( $name, $network = 'twitter', $href_base = 'https://twitter.com/home?status=', $share_url, $use_icon, $content );

		$this->status = $status;

		$this->build_share_href();
	}

	/**
	 * Build the share href.
	 */
	public function build_share_href() {

		$current_post = get_post();
		$status_arr   = array();

		if ( ! empty( $this->status ) ) {
			$status_arr[] = trim( $this->status );
		}

		if ( ! empty( $this->share_url ) ) {
			$status_arr[] = $this->href_base . $this->share_url;
		} elseif ( ! $current_post ) {
			$status_arr[] = $this->href_base . get_site_url();
		} elseif ( $current_post ) {
			$status_arr[] = $this->href_base . get_the_permalink();
		}

		$this->attributes['href'] = $this->encode_status( $status_arr );
	}

	/**
	 * Encode the status for the link.
	 *
	 * @param array $status_arr The pieces of a status.
	 *
	 * @return mixed
	 */
	public function encode_status( $status_arr ) {

		$status_share = implode( ' ', $status_arr );

		return preg_replace( '/ /', '+', $status_share );
	}
}
