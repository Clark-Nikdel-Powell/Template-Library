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

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide                              = $this->data['hide'];
		$this->attributes['data-accordion-item'] = '';

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->panel_title = new Link( Organism::organism_name( 'title' ), '#', $this->data['panel_title'] );

		$this->content_title    = new Content( Organism::organism_name( 'content-title' ), $this->data['title'] );
		$this->content_subtitle = new Content( Organism::organism_name( 'content-subtitle' ), $this->data['subtitle'] );
		$this->content_text     = new Content( Organism::organism_name( 'content-text' ), $this->data['text'] );

		$this->content = new Container( Organism::organism_name( 'content' ), [ $this->content_title, $this->content_subtitle, $this->content_text ], 'div', [ 'data-tab-content' => '' ] );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->panel_title, $this->content ];
	}
}
