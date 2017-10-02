<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLink
 *
 * @package CNP\TemplateLibrary
 */
class ShareLink extends Organism {

	/**
	 * The network name, like Facebook or Twitter.
	 *
	 * @var string
	 */
	public $network;

	/**
	 * The start of the sharing link.
	 *
	 * @var string
	 */
	public $href_base;

	/**
	 * A custom URL to share.
	 *
	 * @var string
	 */
	public $share_url;

	/**
	 * Whether or not to include the network icon.
	 *
	 * @var bool
	 */
	public $use_icon;

	/**
	 * ShareLink constructor.
	 *
	 * @param string $name      Organism name.
	 * @param string $network   Required. Network name is used in the substitute_icon_in_content method to find the correct icon.
	 * @param string $href_base Required. The base href of the share link, usually provided by the social network.
	 * @param string $share_url Optional. A custom URL to share, usually appended to the $href_base. Resolved in child classes.
	 * @param bool   $use_icon  Optional. Will attempt to replace content with a network icon when set to true.
	 * @param string $content   Link text.
	 */
	public function __construct( $name = 'share-link', $network, $href_base, $share_url = '', $use_icon = false, $content = '' ) {

		parent::__construct( $name, $data = null, $content, $tag = 'a' );

		$this->network   = $network;
		$this->href_base = $href_base;
		$this->share_url = $share_url;
		$this->use_icon  = $use_icon;
	}

	/**
	 * Gets the content.
	 */
	public function get_content() {

		$this->build_link_target();
		$this->substitute_icon_in_content();
	}

	/**
	 * Build the link target.
	 */
	public function build_link_target() {

		if ( ! isset( $this->attributes['target'] ) ) {
			$this->attributes['target'] = '_blank';
		}
	}

	/**
	 * Put the icon in.
	 */
	public function substitute_icon_in_content() {

		if ( true === $this->use_icon && class_exists( 'Utility' ) ) {
			$this->content = Utility::get_svg_icon( 'icon-' . $this->network );
		}
	}
}
