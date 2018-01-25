<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFBlurbList
 *
 * @package CNP\TemplateLibrary
 */
class ACFBlurbList extends Organism {

	/**
	 * Elements to show.
	 *
	 * @var array $elements
	 */
	public $elements;

	/**
	 * Blurblist classes
	 *
	 * @var string $class
	 */
	public $class;

	/**
	 * Blurblist ID
	 *
	 * @var string $id
	 */
	public $id;

	/**
	 * Array of data for individual blurbs
	 *
	 * @var array $blurbs_data
	 */
	public $blurbs_data;

	/**
	 * Array of list-wide blurb settings.
	 *
	 * @var array $blurb_settings
	 */
	public $blurb_settings;

	/**
	 * Header container for list_title and list_intro
	 *
	 * @var Container $list_header
	 */
	public $list_header;

	/**
	 * The list title
	 *
	 * @var Content $list_title
	 */
	public $list_title;

	/**
	 * The list intro
	 *
	 * @var Content $list_intro
	 */
	public $list_intro;

	/**
	 * Loop for all blurbs
	 *
	 * @var ACFLoop $blurbs_loop
	 */
	public $blurbs_loop;

	/**
	 * Container for list_link
	 *
	 * @var Container $list_footer
	 */
	public $list_footer;

	/**
	 * List link
	 *
	 * @var Link $list_link
	 */
	public $list_link;

	/**
	 * ACFBlurblist constructor.
	 *
	 * @param array $data ACF data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-blurblist';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_id_and_hide( $this, $this->data );

		$this->elements    = $this->data['elements'];
		$this->blurbs_data = $this->data['blurbs'];

		foreach ( $this->blurbs_data as $key => $value ) {
			$this->blurbs_data[ $key ]['name']            = $this->organism_name( 'blurb' );
			$this->blurbs_data[ $key ]['blurb_elements']  = $this->elements;
			$this->blurbs_data[ $key ]['blurb_classes']   = $this->data['blurb_classes'];
			$this->blurbs_data[ $key ]['background_type'] = $this->data['background_type'];
			$this->blurbs_data[ $key ]['link_type']       = $this->data['link_type'];
			$this->blurbs_data[ $key ]['link_location']   = $this->data['link_location'];
		}

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————

		// ——————————————————————————————————————————
		// Header
		// ——————————————————————————————————————————
		if ( in_array( 'List Title', $this->elements, true ) ) {
			$this->list_title = new Content( $this->organism_name( 'list-title' ), $this->data['list_title'] );
		}
		if ( in_array( 'List Intro', $this->elements, true ) ) {
			$this->list_intro = new Content( $this->organism_name( 'list-intro' ), $this->data['list_intro'] );
		}

		// Container for the List Title & Intro.
		if ( is_object( $this->list_title ) || is_object( $this->list_intro ) ) {

			$this->list_header = new Container( $this->organism_name( 'list-header' ), [] );

			if ( is_object( $this->list_title ) ) {
				array_push( $this->list_header->structure, $this->list_title );
			}
			if ( is_object( $this->list_intro ) ) {
				array_push( $this->list_header->structure, $this->list_intro );
			}
		}

		// ——————————————————————————————————————————
		// Loop
		// ——————————————————————————————————————————
		$this->blurbs_loop = new ACFLoop( $this->organism_name( 'list-loop' ), $this->blurbs_data, 'CNP\\TemplateLibrary\\ACFBlurbListBlurb' );

		// ——————————————————————————————————————————
		// Footer
		// ——————————————————————————————————————————
		if ( in_array( 'List Link', $this->elements, true ) ) {

			$this->list_link = new Link( $this->organism_name( 'list-link' ), $this->data['list_link'], $this->data['list_link_text'] );

			// Container for the List Link.
			$this->list_footer = new Container( $this->organism_name( 'list-footer' ), [ $this->list_link ] );
		}

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		if ( is_object( $this->list_header ) ) {
			array_push( $this->structure, $this->list_header );
		}

		array_push( $this->structure, $this->blurbs_loop );

		if ( is_object( $this->list_footer ) ) {
			array_push( $this->structure, $this->list_footer );
		}
	}
}
