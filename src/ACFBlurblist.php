<?php
namespace CNP\TemplateLibrary;

/**
 * Class Blurblist
 * @package CNP\TemplateLibrary
 */
class ACFBlurblist extends Organism {

	// Supporting Data
	public $elements;
	public $class;
	public $id;
	public $blurbs_data;
	public $blurb_settings;

	// Pieces
	public $list_header;
	public $list_title;
	public $list_intro;
	public $blurbs_loop;
	public $list_footer;
	public $list_link;

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-blurblist';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data, $content = '', $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide        = $this->data['hide'];
		$this->elements    = $this->data['elements'];
		$this->blurbs_data = $this->data['blurbs'];

		$this->blurb_settings = [
			'name'            => Organism::organism_name( 'blurb' ),
			'blurb_elements'  => $this->elements,
			'blurb_classes'   => $this->data['blurb_classes'],
			'background_type' => $this->data['background_type'],
			'link_type'       => $this->data['link_type'],
			'link_location'   => $this->data['link_location'],
		];

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————

		//——————————————————————————————————————————
		//  Header
		//——————————————————————————————————————————
		if ( in_array( 'List Title', $this->elements ) ) {
			$this->list_title = new Content( Organism::organism_name( 'list-title' ), $this->data['list_title'] );
		}
		if ( in_array( 'List Intro', $this->elements ) ) {
			$this->list_intro = new Content( Organism::organism_name( 'list-intro' ), $this->data['list_intro'] );
		}

		// Container for the List Title & Intro
		if ( is_object( $this->list_title ) || is_object( $this->list_intro ) ) {

			$this->list_header = new Container( Organism::organism_name( 'list-header' ), [] );

			if ( is_object( $this->list_title ) ) {
				array_push( $this->list_header->structure, $this->list_title );
			}
			if ( is_object( $this->list_intro ) ) {
				array_push( $this->list_header->structure, $this->list_intro );
			}
		}

		//——————————————————————————————————————————
		//  Loop
		//——————————————————————————————————————————
		$this->blurbs_loop = new ACFLoop( Organism::organism_name( 'list-loop' ), $this->blurbs_data, 'CNP\\TemplateLibrary\\ACFBlurblistblurb', $this->blurb_settings );

		//——————————————————————————————————————————
		//  Footer
		//——————————————————————————————————————————
		if ( in_array( 'List Link', $this->elements ) ) {

			$this->list_link = new Link( Organism::organism_name( 'list-link' ), $this->data['list_link'], $this->data['list_link_text'] );

			// Container for the List Link
			$this->list_footer = new Container( Organism::organism_name( 'list-footer' ), [ $this->list_link ] );
		}

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		if ( is_object( $this->list_header ) ) {
			array_push( $this->structure, $this->list_header );
		}

		array_push( $this->structure, $this->blurbs_loop );

		if ( is_object( $this->list_footer ) ) {
			array_push( $this->structure, $this->list_footer );
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
