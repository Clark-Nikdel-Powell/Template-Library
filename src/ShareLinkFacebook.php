<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLinkFacebook
 * @package CNP\TemplateLibrary
 */
class ShareLinkFacebook extends ShareLink {

	/**
	 * ShareLinkFacebook constructor.
	 *
	 * @param string $name
	 * @param string $share_url Optional. A custom URL to share. Defaults to the current post, or the site URL.
	 * @param bool $use_icon Optional. Whether to substitute content with an icon. Resolved in parent ShareLink class.
	 * @param string $content Optional. Content to display inside the link, can be overridden with use_icon parameter.
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'share-link-facebook', $share_url = '', $use_icon = false, $content = 'Share on Facebook', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $network = 'facebook', $href_base = 'https://www.facebook.com/sharer/sharer.php?u=', $share_url, $use_icon, $content, $name, $attributes, $before, $prepend, $append, $after );

		$this->build_share_href();
	}

	/**
	 * build_share_href
	 */
	private function build_share_href() {

		$share_href = '';

		if ( '' !== $this->share_url ) {
			$share_href = $this->href_base . $this->share_url;
		} else {

			$current_post = get_post();

			if ( ! $current_post ) {
				$share_href = $this->href_base . get_site_url();
			}
			if ( $current_post ) {
				$share_href = $this->href_base . get_permalink();
			}
		}

		$this->attributes['href'] = $share_href;
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
