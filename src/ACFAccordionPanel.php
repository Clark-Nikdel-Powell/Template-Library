<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFAccordionPanel
 *
 * @package CNP\TemplateLibrary
 */
class ACFAccordionPanel extends Organism {

	/**
	 * Panel title
	 *
	 * @var Link
	 */
	public $panel_title;

	/**
	 * Container for panel content
	 *
	 * @var Container
	 */
	public $content;

	/**
	 * Title
	 *
	 * @var Content
	 */
	public $content_title;

	/**
	 * Subtitle
	 *
	 * @var Content
	 */
	public $content_subtitle;

	/**
	 * Text
	 *
	 * @var Content
	 */
	public $content_text;

	/**
	 * ACFAccordionPanel constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		$name = 'acf-accordion__panel';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide             = $this->data['hide'];
		$this->content_title    = $this->data['title'];
		$this->content_subtitle = $this->data['subtitle'];
		$this->content_text     = $this->data['text'];

		$this->attributes['class'] = [ 'accordion-item' ];
		if ( 0 === $data['loop-index'] ) {
			array_push( $this->attributes['class'], 'is-active' );
		}

		$this->attributes['data-accordion-item'] = '';

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$link                      = new Link( $this->organism_name( 'title' ), '#', $this->data['panel_title'] );
		$link->attributes['class'] = [ 'accordion-title' ];

		$title    = new Content( $this->organism_name( 'content-title' ), $this->content_title );
		$subtitle = new Content( $this->organism_name( 'content-subtitle' ), $this->content_subtitle );
		$text     = new Content( $this->organism_name( 'content-text' ), $this->content_text );

		$content_text_container = new Container( $this->organism_name( 'content-text-container' ), [
			$title,
			$subtitle,
			$text,
		] );

		$image           = new Image( $this->organism_name( 'content-image' ), $this->data['image'], 'large' );
		$image_container = new Container( $this->organism_name( 'content-image-container' ), [ $image ] );

		$container = new Container( $this->organism_name( 'content' ), [
			$content_text_container,
			$image_container,
		] );

		$container->attributes['class'] = [ 'accordion-content' ];

		if ( 0 !== $data['loop-index'] ) {
			$container->attributes['style'] = [ 'display:none;' ];
		}

		$container->attributes['data-tab-content'] = '';

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $link, $container ];
	}
}
