<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFBlurblistblurb
 * @package CNP\TemplateLibrary
 */
class ACFBlurblistblurb extends Organism {

	// Settings
	public $blurb_classes;
	public $background_type;
	public $link_type;
	public $link_location;
	public $separator = '-';

	// Pieces
	public $inside;
	public $inside_tag;
	public $inside_attributes;

	public $background;
	public $image;
	public $title;
	public $subtitle;
	public $text;
	public $link;

	public function __construct( $data ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $before = '', $prepend = '', $append = '', $after = '' );

		$this->blurb_classes   = $this->data['blurb_classes'];
		$this->background_type = $this->data['background_type'];
		$this->link_type       = $this->data['link_type'];
		$this->link_location   = $this->data['link_location'];

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];

		$this->inside_tag        = 'div'; // Can switch to 'a' if we're using a background link
		$this->inside_attributes = []; // Can add an href if we're using a background link.

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->do_background_link(); // Gets put on $this->inside if applicable
		$this->background = Utilities::acf_do_background( $this->data, $this );
		$this->image      = new Image( Organism::organism_name( 'image', $this->separator ), $this->data['foreground_image'], '' );
		$this->title      = new Content( Organism::organism_name( 'title', $this->separator ), $this->data['title'] );
		$this->subtitle   = new Content( Organism::organism_name( 'subtitle', $this->separator ), $this->data['subtitle'] );
		$this->text       = new Content( Organism::organism_name( 'text', $this->separator ), $this->data['text'] );
		$this->do_button();

		$this->inside = new Container( Organism::organism_name( 'inside', $this->separator ), [ $this->image, $this->title, $this->subtitle, $this->text ], $this->inside_tag, $this->inside_attributes );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		if ( is_object( $this->background ) ) {
			array_unshift( $this->inside->structure, $this->background );
		}

		if ( is_object( $this->link ) ) {
			array_push( $this->inside->structure, $this->link );
		}

		$this->structure = [
			$this->inside,
		];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}

	private function is_background_link() {
		return 'Background' === $this->link_type;
	}

	private function is_button_link() {
		return 'Button' === $this->link_type;
	}

	private function is_internal_links() {
		return 'Internal' === $this->link_location;
	}

	private function is_external_links() {
		return 'External' === $this->link_location;
	}

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

	private function do_button() {

		$link = $this->get_link();
		$text = isset( $this->data['link_text'] ) && ! empty( $this->data['link_text'] ) ? $this->data['link_text'] : 'Learn More';

		if ( $this->is_button_link() && $link ) {
			$this->link = new Link( Organism::organism_name( 'link', $this->separator ), $link, $text );
		}
	}

	private function do_background_link() {

		$link = $this->get_link();

		// If the background is a link, add a Link atom
		if ( $this->is_background_link() && $link ) {
			$this->inside_tag                = 'a';
			$this->inside_attributes['href'] = $link;
		}
	}
}
