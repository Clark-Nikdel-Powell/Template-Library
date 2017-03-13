<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLinkLinkedin
 *
 * @package CNP\TemplateLibrary
 */
class ShareLinkLinkedin extends ShareLink {

	/**
	 * LinkedIn-specific share URL parameters.
	 *
	 * @var array
	 */
	public $share_url_parameters;

	/**
	 * ShareLinkLinkedin constructor.
	 *
	 * @param string $name                 Organism name.
	 * @param array  $share_url_parameters Optional. LinkedIn-specific share URL parameters.
	 * @param string $share_url            Optional. A custom URL to share. Defaults to the current post, or the site URL.
	 * @param bool   $use_icon             Optional. Whether to substitute content with an icon. Resolved in parent ShareLink class.
	 * @param string $content              Optional. Content to display inside the link, can be overridden with use_icon parameter.
	 */
	public function __construct( $name = 'share-link-linkedin', array $share_url_parameters = [], $share_url = '', $use_icon = false, $content = 'Share on LinkedIn' ) {

		parent::__construct( $name, $network = 'linkedin', $href_base = 'https://www.linkedin.com/shareArticle?', $share_url, $use_icon, $content );

		$this->set_share_url_parameters( $share_url_parameters );
		$this->build_share_href();
	}

	/**
	 * Build the share URL parameters.
	 *
	 * @param array $share_url_parameters The parameters passed in through construct.
	 */
	public function set_share_url_parameters( $share_url_parameters ) {

		if ( ! empty( $share_url_parameters ) ) {
			$this->share_url_parameters = $share_url_parameters;
		} else {

			$current_post = get_post();

			$blog_title = get_option( 'blogname' );

			if ( $current_post ) {

				$excerpt = get_the_excerpt();
				if ( 250 > strlen( $excerpt ) ) {
					$excerpt = substr( $excerpt, 0, 250 );
				}

				$this->share_url_parameters = [
					'url'     => get_the_permalink(),
					'title'   => $blog_title,
					'summary' => $excerpt,
					'source'  => $blog_title,
				];

			} else {

				$this->share_url_parameters = [
					'url'     => get_site_url(),
					'title'   => $blog_title,
					'summary' => get_option( 'blogdescription' ),
					'source'  => $blog_title,
				];

			}
		}

		$this->share_url_parameters['mini'] = 'true';
	}

	/**
	 * Build the share href.
	 */
	public function build_share_href() {

		$this->attributes['href'] = $this->href_base . http_build_query( $this->share_url_parameters );
	}
}
