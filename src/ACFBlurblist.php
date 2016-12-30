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
	public $blurb_data;

	// Pieces
	public $list_header;
	public $list_title;
	public $list_intro;
	public $blurbs_loop;
	public $list_footer;
	public $list_link;

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		if ( ! empty( $data['class'] ) ) {
			$attributes['class'] = explode( ',', $data['class'] );
		}

		if ( ! empty( $data['id'] ) ) {
			$attributes['id'] = $data['id'];
		}

		parent::__construct( $data['name'], $data, $content = '', $tag, $attributes, $structure = [], $before, $prepend, $append, $after );

		$this->elements = $data['elements'];

		$this->blurb_data = [
			'name'            => Organism::organism_name( 'blurb' ),
			'blurb_elements'  => $this->elements,
			'blurb_classes'   => $this->data['blurb_classes'],
			'background_type' => $data['background_type'],
			'link_type'       => $data['link_type'],
			'link_location'   => $data['link_location'],
		];

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
		$this->blurbs_loop = new Loop( Organism::organism_name( 'list-loop' ), $this->data['blurbs'], 'CNP\\TemplateLibrary\\ACFBlurblistblurb', $this->blurb_data );

		//——————————————————————————————————————————
		//  Footer
		//——————————————————————————————————————————
		if ( in_array( 'List Link', $this->elements ) ) {

			$this->list_link = new Link( Organism::organism_name( 'list-link' ), $this->data['list_link'], $this->data['list_link_text'] );

			// Container for the List Link
			$this->list_footer = new Container( Organism::organism_name( 'list-footer' ), [ $this->list_link ] );
		}

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

		$this->hide = empty( $this->elements );

		return parent::get_markup();
	}
}
