<?php
namespace CNP\TemplateLibrary;

/**
 * Class ShareLink
 * @package CNP\TemplateLibrary
 */
class ShareLink extends Organism {

	public $network;
	public $href_base;
	public $share_url;
	public $use_icon;

	/**
	 * ShareLink constructor.
	 *
	 * @param string $network Required. Network name is used in the substitute_icon_in_content method to find the correct icon.
	 * @param string $href_base Required. The base href of the share link, usually provided by the social network.
	 * @param string $share_url Optional. A custom URL to share, usually appended to the $href_base. Resolved in child classes.
	 * @param bool $use_icon Optional. Will attempt to replace content with a network icon when set to true.
	 * @param string $content
	 * @param string $name
	 * @param array $attributes
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = 'share-link', $network, $href_base, $share_url = '', $use_icon = false, $content = '', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content, $tag = 'a', $attributes, $structure = [], $before, $prepend, $append, $after );

		$this->network   = $network;
		$this->href_base = $href_base;
		$this->share_url = $share_url;
		$this->use_icon  = $use_icon;

		$this->build_link_target();
		$this->substitute_icon_in_content();
	}

	/**
	 * build_link_target
	 */
	public function build_link_target() {

		if ( ! isset( $this->attributes['target'] ) ) {
			$this->attributes['target'] = '_blank';
		}
	}

	/**
	 * substitute_icon_in_content
	 */
	public function substitute_icon_in_content() {

		if ( true === $this->use_icon && class_exists( 'Utility' ) ) {
			$this->content = Utility::get_svg_icon( 'icon-' . $this->network );
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
