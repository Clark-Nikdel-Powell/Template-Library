<?php

namespace CNP\TemplateLibrary;

use \CNP\Utility;

/**
 * Class ACFBlurbListBlurb
 *
 * @package CNP\TemplateLibrary
 */
class ACFBlurbListBlurb extends Organism {

	/**
	 * List of classes
	 *
	 * @var string
	 */
	public $blurb_classes;

	/**
	 * Background Type
	 *
	 * @var string
	 */
	public $background_type;

	/**
	 * Link type
	 *
	 * @var string
	 */
	public $link_type;

	/**
	 * Link location
	 *
	 * @var string
	 */
	public $link_location;

	/**
	 * Inside
	 *
	 * @var Container
	 */
	public $inside;

	/**
	 * Inside tag
	 *
	 * @var string
	 */
	public $inside_tag;

	/**
	 * Inside attributes
	 *
	 * @var array
	 */
	public $inside_attributes;

	/**
	 * Background
	 *
	 * @var bool|BackgroundVideo|Content|Image|string
	 */
	public $background;

	/**
	 * Media
	 *
	 * @var Container
	 */
	public $media;

	/**
	 * Blurb icon
	 *
	 * @var Content
	 */
	public $icon;

	/**
	 * Foreground Image
	 *
	 * @var Image
	 */
	public $image;

	/**
	 * Text Container
	 *
	 * @var Container
	 */
	public $text_container;

	/**
	 * Title
	 *
	 * @var Content
	 */
	public $title;

	/**
	 * Subtitle
	 *
	 * @var Content
	 */
	public $subtitle;

	/**
	 * Text
	 *
	 * @var Content
	 */
	public $text_content;

	/**
	 * Link
	 *
	 * @var Link
	 */
	public $link;

	/**
	 * ACFBlurblistblurb constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		$name = 'acf-blurb';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		if ( isset( $this->data['blurb_classes'] ) ) {
			$this->blurb_classes = $this->data['blurb_classes'];
		}

		if ( isset( $this->data['background_type'] ) ) {
			$this->background_type = $this->data['background_type'];
		}

		if ( isset( $this->data['link_type'] ) ) {
			$this->link_type = $this->data['link_type'];
		}

		if ( isset( $this->data['link_location'] ) ) {
			$this->link_location = $this->data['link_location'];
		}

		Utilities::acf_set_class_and_id( $this, $this->data );
		$this->separator = '-';
		$this->hide      = $this->data['hide'];

		$this->inside_tag        = 'div'; // Can switch to 'a' if we're using a background link.
		$this->inside_attributes = []; // Can add an href if we're using a background link.

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->do_background_link(); // Gets put on $this->inside if applicable.
		$this->background = Utilities::acf_do_background( $this->data, $this );

		$this->media = new Container( $this->organism_name( 'media' ), [] );
		if ( in_array( 'Blurb Icon', $this->data['blurb_elements'], true ) ) {
			$this->icon = new Content( $this->organism_name( 'icon' ), Utility::get_svg_icon( $this->data['icon'] ) );
			array_push( $this->media->structure, $this->icon );
		}

		if ( in_array( 'Blurb Image', $this->data['blurb_elements'], true ) ) {
			$this->image = new Image( $this->organism_name( 'image' ), $this->data['foreground_image'], '' );
			array_push( $this->media->structure, $this->image );
		}

		$this->title        = new Content( $this->organism_name( 'title' ), $this->data['title'] );
		$this->subtitle     = new Content( $this->organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->text_content = new Content( $this->organism_name( 'content' ), $this->data['text'] );

		$this->text_container = new Container( $this->organism_name( 'text' ), [ $this->title, $this->subtitle, $this->text_content ] );

		$this->do_button();

		$this->inside = new Container( $this->organism_name( 'inside' ), [ $this->media, $this->text_container ] );

		$this->inside->tag        = $this->inside_tag;
		$this->inside->attributes = $this->inside_attributes;

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		if ( is_object( $this->background ) ) {
			array_unshift( $this->inside->structure, $this->background );
		}

		$this->structure = [
			$this->inside,
		];
	}

	/**
	 * Check for background link
	 *
	 * @return bool
	 */
	private function is_background_link() {

		return 'Background' === $this->link_type;
	}

	/**
	 * Check for button link
	 *
	 * @return bool
	 */
	private function is_button_link() {

		return 'Button' === $this->link_type;
	}

	/**
	 * Check for link type internal
	 *
	 * @return bool
	 */
	private function is_internal_links() {

		return 'Internal' === $this->link_location;
	}

	/**
	 * Check for link type external
	 *
	 * @return bool
	 */
	private function is_external_links() {

		return 'External' === $this->link_location;
	}

	/**
	 * Get the link
	 *
	 * @return bool
	 */
	private function get_link() {

		$link = false;

		if ( $this->is_internal_links() && isset( $this->data['page_link'] ) && ! empty( $this->data['page_link'] ) ) {
			$link = $this->data['page_link'];
		}
		if ( $this->is_external_links() && isset( $this->data['link'] ) && ! empty( $this->data['link'] ) ) {
			$link = $this->data['link'];
		}

		return $link;
	}

	/**
	 * Set the link as a button
	 */
	private function do_button() {

		$link = $this->get_link();
		$text = isset( $this->data['link_text'] ) && ! empty( $this->data['link_text'] ) ? $this->data['link_text'] : 'Learn More';

		if ( $this->is_button_link() && $link ) {
			$this->link                        = new Link( $this->organism_name( 'link' ), $link, $text );
			$this->text_container->structure[] = $this->link;
		}
	}

	/**
	 * Set the link as a background
	 */
	private function do_background_link() {

		$link = $this->get_link();

		// If the background is a link, add a Link atom.
		if ( $this->is_background_link() && $link ) {
			$this->inside_tag                = 'a';
			$this->inside_attributes['href'] = $link;
		}
	}
}
