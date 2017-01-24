<?php
namespace CNP\TemplateLibrary;

/**
 * Class Blurblist
 * @package CNP\TemplateLibrary
 */
class ACFHeader extends Organism {

	// Supporting Data
	public $class;
	public $id;

	// Pieces
	public $background;
	public $text;
	public $title;
	public $subtitle;
	public $description;
	public $link;

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-header';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data, $content = '', $tag, $attributes, $structure = [], $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $data, $attributes );

		$this->hide = $this->data['hide'];

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->background  = Utilities::acf_do_background( $this->data, $this );
		$this->title       = new Content( Organism::organism_name( 'title' ), $this->data['title'] );
		$this->subtitle    = new Content( Organism::organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->description = new Content( Organism::organism_name( 'description' ), $this->data['description'] );
		$this->link        = new Link( Organism::organism_name( 'link' ), $this->data['link'], $this->data['link_text'] );

		$this->text = new Container( Organism::organism_name( 'text' ), [ $this->title, $this->subtitle, $this->description, $this->link ] );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		$this->structure = [
			$this->background,
			$this->text,
		];
	}
}