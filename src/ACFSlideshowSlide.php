<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFSlideshowSlide
 * @package CNP\TemplateLibrary
 */
class ACFSlideshowSlide extends Organism {

	// Settings
	public $separator = '-';

	// Pieces
	public $background;

	public $text;
	public $image;
	public $title;
	public $subtitle;
	public $description;
	public $link;

	public function __construct( $data ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->background  = Utilities::acf_do_background( $this->data, $this );
		$this->image       = new Image( Organism::organism_name( 'image', $this->separator ), $this->data['foreground_image'], '' );
		$this->title       = new Content( Organism::organism_name( 'title', $this->separator ), $this->data['title'] );
		$this->subtitle    = new Content( Organism::organism_name( 'subtitle', $this->separator ), $this->data['subtitle'] );
		$this->description = new Content( Organism::organism_name( 'description', $this->separator ), $this->data['description'] );
		$this->link        = new Link( Organism::organism_name( 'link', $this->separator ), $this->data['link'], $this->data['link_text'] );

		$this->text = new Container( Organism::organism_name( 'text', $this->separator ), [ $this->image, $this->title, $this->subtitle, $this->description, $this->link ] );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		$this->structure = [
			$this->background,
			$this->text,
		];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
