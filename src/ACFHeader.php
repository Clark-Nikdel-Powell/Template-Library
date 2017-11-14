<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFHeader
 *
 * @package CNP\TemplateLibrary
 */
class ACFHeader extends Organism {

	/**
	 * Background
	 *
	 * @var bool|BackgroundVideo|Content|Image|string
	 */
	public $background;

	/**
	 * Text container
	 *
	 * @var Container
	 */
	public $text;

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
	 * Description
	 *
	 * @var Content
	 */
	public $description;

	/**
	 * Link
	 *
	 * @var Link
	 */
	public $link;

	/**
	 * ACFHeader constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-header';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->background = new Container( $this->organism_name( 'background' ), [] );
		$background_atom = false;
		if ( isset( $this->data['elements']['Background'] ) ) {
			$background_atom = Utilities::acf_do_background( $this->data, $this );
		}
		if ( false !== $background_atom ) {
			$this->background->structure[] = $background_atom;
		}
		$this->title       = new Content( $this->organism_name( 'title' ), $this->data['title'] );
		$this->subtitle    = new Content( $this->organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->description = new Content( $this->organism_name( 'description' ), $this->data['description'] );
		$this->link        = new Link( $this->organism_name( 'link' ), $this->data['link'], $this->data['link_text'] );

		$this->text = new Container( $this->organism_name( 'text' ), [ $this->title, $this->subtitle, $this->description, $this->link ] );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		if ( false !== $this->background ) {
			$this->structure[] = $this->background;
		}
		if ( false !== $this->text ) {
			$this->structure[] = $this->text;
		}
	}
}
