<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFSlideshowSlide
 *
 * @package CNP\TemplateLibrary
 */
class ACFSlideshowSlide extends Organism {

	/**
	 * Slide background
	 *
	 * @var bool|BackgroundVideo|Content|Image|string
	 */
	public $background;

	/**
	 * Slide text container
	 *
	 * @var Container
	 */
	public $text;

	/**
	 * Foreground image
	 *
	 * @var Image
	 */
	public $image;

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
	 * ACFSlideshowSlide constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		$name = 'acf-slide';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );
		$this->separator = '-';
		$this->hide      = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->background = Utilities::acf_do_background( $this->data, $this );

		$this->text = new Container( $this->organism_name( 'text' ), [] );

		if ( isset( $this->data['foreground_image'] ) ) {
			$this->image = new Image( $this->organism_name( 'image' ), $this->data['foreground_image'], '' );
			array_push( $this->text->structure, $this->image );
		}

		if ( isset( $this->data['title'] ) ) {
			$this->title = new Content( $this->organism_name( 'title' ), $this->data['title'] );
			array_push( $this->text->structure, $this->title );
		}

		if ( isset( $this->data['subtitle'] ) ) {
			$this->subtitle = new Content( $this->organism_name( 'subtitle' ), $this->data['subtitle'] );
			array_push( $this->text->structure, $this->subtitle );
		}

		if ( isset( $this->data['description'] ) ) {
			$this->description = new Content( $this->organism_name( 'description' ), $this->data['description'] );
			array_push( $this->text->structure, $this->description );
		}

		if ( isset( $this->data['link_text'] ) ) {
			$this->link = new Link( $this->organism_name( 'link' ), $this->data['link'], $this->data['link_text'] );
			array_push( $this->text->structure, $this->link );
		}

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->background,
			$this->text,
		];
	}
}
