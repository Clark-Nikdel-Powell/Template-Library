<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFBlurblistblurb
 * @package CNP\TemplateLibrary
 */
class ACFBlurblistblurb extends Organism {

	public $blurb_classes;
	public $background_type;
	public $link_type;
	public $link_location;
	public $separator = '-';

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

		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $before = '', $prepend = '', $append = '', $after = '' );

		$this->blurb_classes   = $this->data['blurb_classes'];
		$this->background_type = $this->data['background_type'];
		$this->link_type       = $this->data['link_type'];
		$this->link_location   = $this->data['link_location'];

		$this->do_classes();
		$this->do_id();

		$this->inside_tag        = 'div'; // Can switch to 'a' if we're using a background link
		$this->inside_attributes = []; // Can add an href if we're using a background link.

		$this->do_background_link(); // Gets put on $this->inside
		$this->do_background(); // TODO: add object check when adding this in
		$this->image    = new Image( Organism::organism_name( 'image', $this->separator ), $this->data['foreground_image'], '' );
		$this->title    = new Content( Organism::organism_name( 'title', $this->separator ), $this->data['title'] );
		$this->subtitle = new Content( Organism::organism_name( 'subtitle', $this->separator ), $this->data['subtitle'] );
		$this->text     = new Content( Organism::organism_name( 'text', $this->separator ), $this->data['text'] );
		$this->do_button();

		$this->inside = new Container( Organism::organism_name( 'inside', $this->separator ), [ $this->image, $this->title, $this->subtitle, $this->text ], $this->inside_tag, $this->inside_attributes );

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

	private function has_background() {
		return 'None' !== $this->background_type;
	}

	private function is_color_background() {
		return 'Color' === $this->background_type;
	}

	private function is_image_background() {
		return 'Image' === $this->background_type;
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

	private function do_classes() {

		$classes = $this->data['class'];
		if ( ! empty( $this->blurb_classes ) ) {
			$classes .= ',' . $this->blurb_classes;
		}
		if ( class_exists( 'CNP\Utility' ) ) {
			$this->attributes['class'] = \CNP\Utility::parse_classes_as_array( $classes );
		} else {

			// TODO: Debug function copied over until we figure out how to link this in development
			if ( is_string( $classes ) ) {

				if ( '' === $classes ) {
					return false;
				}

				// Create an array
				$data_classes_arr = explode( ',', $classes );

				// Trim the input for any whitespace
				$data_classes_arr = array_map( 'trim', $data_classes_arr );

			}

			if ( is_array( $classes ) ) {

				if ( empty( $classes ) ) {
					return false;
				}

				$data_classes_arr = $classes;
			}

			if ( ! empty( $data_classes_arr ) ) {
				return $this->attributes['class'] = $data_classes_arr;
			} else {
				return false;
			}
		}
	}

	private function do_id() {

		if ( isset( $this->data['id'] ) && ! empty( $this->data['id'] ) ) {
			$this->attributes['id'] = $this->data['id'];
		}
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

	private function do_background() {

		if ( $this->has_background() ) {

			$background_name = Organism::organism_name( 'background', $this->separator );

			if ( $this->is_image_background() && isset( $this->data['background_image'] ) && ! empty( $this->data['background_image'] ) ) {

				$this->background = new Image( $background_name, $this->data['background_image'], '' );
			}
			if ( $this->is_color_background() && isset( $this->data['background_color'] ) && ! empty( $this->data['background_color'] ) ) {

				$this->background = new Content( $background_name, '', 'div', [ 'style' => "background-color: $this->data['background_color']" ] );
			}
		}
	}
}
