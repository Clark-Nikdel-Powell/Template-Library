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
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		$name = 'acf-accordion__panel';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

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

		$title = new Content( $this->organism_name( 'content-title' ), $this->data['title'] );

		$subtitle = new Content( $this->organism_name( 'content-subtitle' ), $this->data['subtitle'] );
		$text     = new Content( $this->organism_name( 'content-text' ), $this->data['text'] );

		$container = new Container( $this->organism_name( 'content' ), [
			$title,
			$subtitle,
			$text,
		] );

		$container->attributes['class']            = [ 'accordion-content' ];

		if ( 0 !== $data['loop-index'] ) {
			$container->attributes['style'] = [ 'display:none;' ];
		}

		$container->attributes['data-tab-content'] = '';

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $link, $container ];
	}

	/**
	 * Get organism markup
	 *
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
