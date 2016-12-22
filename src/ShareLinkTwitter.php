<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLinkTwitter
 * @package CNP\TemplateLibrary
 */
class ShareLinkTwitter extends ShareLink {

	public $status;

	/**
	 * ShareLinkTwitter constructor.
	 *
	 * @param string $status Optional. The status is used to pre-fill a tweet.
	 * @param string $share_url Optional. A custom URL to share. Defaults to the current post, or the site URL.
	 * @param bool $use_icon Optional. Whether to substitute content with an icon. Resolved in parent ShareLink class.
	 * @param string $content Optional. Content to display inside the link, can be overridden with use_icon parameter.
	 * @param string $name
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $status = '', $share_url = '', $use_icon = false, $content = 'Share on Twitter', $name = 'share-link-twitter', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $network = 'twitter', $href_base = 'https://twitter.com/home?status=', $share_url, $use_icon, $content, $name, $attributes, $before, $prepend, $append, $after );

		$this->status = $status;

		$this->build_share_href();
	}

	/**
	 * build_share_href
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
	 * @param $status_arr
	 *
	 * @return mixed
	 */
	public function encode_status( $status_arr ) {

		$status_share = implode( ' ', $status_arr );

		return preg_replace( '/ /', '+', $status_share );
	}

	/**
	 * get_markup
	 *
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
