<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFTabs
 * @package CNP\TemplateLibrary
 */
class ACFTabs extends Organism {

	public $tabs_data;

	public $background;
	public $headings;
	public $content;

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-tabs';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide      = $this->data['hide'];
		$this->tabs_data = $this->data['tabs'];

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->headings = new ACFLoop( Organism::organism_name( 'headings' ), $this->tabs_data, 'CNP\\TemplateLibrary\\ACFTabHeading', [], 'ul', [ 'data-tabs' => '', 'id' => '' ] );
		$this->content  = new ACFLoop( Organism::organism_name( 'content' ), $this->tabs_data, 'CNP\\TemplateLibrary\\ACFTabContent', [], 'div', [ 'data-tabs-content' => '' ] );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		$this->structure = [ $this->background, $this->headings, $this->content ];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
