<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFTabContent
 *
 * @package CNP\TemplateLibrary
 */
class ACFTabContent extends Organism {

	/**
	 * Title
	 *
	 * @var Content
	 */
	public $title;

	/**
	 * Subtitle
	 *
	 * @var Content
	 */
	public $subtitle;

	/**
	 * Text
	 *
	 * @var Content
	 */
	public $text;

	/**
	 * Link text
	 *
	 * @var string
	 */
	public $link_text;

	/**
	 * Link
	 *
	 * @var Link
	 */
	public $link;

	/**
	 * ACFTabContent constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		$name = 'acf-tabcontent';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide             = $this->data['hide'];
		$this->attributes['id'] = 'panel' . $this->data['loop-index'];

		if ( 0 === $this->data['loop-index'] ) {
			$this->attributes['class'][] = $this->organism_name( 'isActive', '--' );
		}

		if ( ! empty( trim( $this->data['link_text'] ) ) ) {
			$this->link_text = $this->data['link_text'];
		} else {
			$this->link_text = 'Click Here';
		}

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->title    = new Content( $this->organism_name( 'title' ), $this->data['title'] );
		$this->subtitle = new Content( $this->organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->text     = new Content( $this->organism_name( 'text' ), $this->data['text'] );
		$this->link     = new Link( $this->organism_name( 'link' ), $this->data['link'], $this->link_text );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->title,
			$this->subtitle,
			$this->text,
			$this->link,
		];
	}
}
