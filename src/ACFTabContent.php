<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFTabContent
 * @package CNP\TemplateLibrary
 */
class ACFTabContent extends Organism {

	public $inside;
	public $title;
	public $subtitle;
	public $text;
	public $link_text;
	public $link;

	public function __construct( $data ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide             = $this->data['hide'];
		$this->attributes['id'] = 'panel' . $this->data['loop-index'];

		if ( 0 === $this->data['loop-index'] ) {
			$this->attributes['class'][] = Organism::organism_name( 'isActive', '--' );
		}

		if ( ! empty( trim( $this->data['link_text'] ) ) ) {
			$this->link_text = $this->data['link_text'];
		} else {
			$this->link_text = 'Click Here';
		}

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->title    = new Content( Organism::organism_name( 'title' ), $this->data['title'] );
		$this->subtitle = new Content( Organism::organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->text     = new Content( Organism::organism_name( 'text' ), $this->data['text'] );
		$this->link     = new Link( Organism::organism_name( 'link' ), $this->data['link'], $this->link_text );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		$this->structure = [ $this->title, $this->subtitle, $this->text, $this->link ];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
