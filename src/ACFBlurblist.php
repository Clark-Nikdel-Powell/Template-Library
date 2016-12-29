<?php
namespace CNP\TemplateLibrary;

/**
 * Class Blurblist
 * @package CNP\TemplateLibrary
 */
class ACFBlurblist extends Organism {

	// Supporting Data
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

	public function __construct( $data, $name = 'acf-blurblist', $tag = 'div', array $attributes = [], $content = '', $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content, $tag, $attributes, $structure = [], $before, $prepend, $append, $after );

		$this->blurb_data = [
			'blurb_classes'   => $this->data['blurb_classes'],
			'background_type' => $data['background_type'],
			'link_type'       => $data['link_type'],
			'link_location'   => $data['link_location'],
		];

		//——————————————————————————————————————————
		//  Header
		//——————————————————————————————————————————
		$this->list_title = new Content( Organism::organism_name( 'list-title' ), $this->data['list_title'] );
		$this->list_intro = new Content( Organism::organism_name( 'list-intro' ), $this->data['list_intro'] );

		// Container for the List Title & Intro
		$this->list_header = new Container( Organism::organism_name( 'list-header' ), [ $this->list_title, $this->list_intro ] );

		//——————————————————————————————————————————
		//  Loop
		//——————————————————————————————————————————
		$this->blurbs_loop = new Loop( $this->data['blurbs'], 'CNP\\TemplateLibrary\\ACFBlurblistblurb', $this->blurb_data );

		//——————————————————————————————————————————
		//  Footer
		//——————————————————————————————————————————
		$this->list_link = new Link( $this->data['list_link'], $this->data['list_link_text'], Organism::organism_name( 'list-link' ) );

		// Container for the List Link
		$this->list_footer = new Container( Organism::organism_name( 'list-footer' ), [ $this->list_link ] );

		$this->structure = [
			$this->list_header,
			$this->blurbs_loop,
			$this->list_footer,
		];

	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
