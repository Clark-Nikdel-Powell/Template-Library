<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFAccordion
 *
 * @package CNP\TemplateLibrary
 */
class ACFAccordion extends Organism {

	/**
	 * Array of individual panel data
	 *
	 * @var array
	 */
	public $panels_data;

	/**
	 * The generated panels
	 *
	 * @var ACFLoop
	 */
	public $panels;

	/**
	 * ACFAccordion constructor.
	 *
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-accordion';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide        = $this->data['hide'];
		$this->panels_data = $this->data['panels'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->panels = new ACFLoop( Organism::organism_name( 'panels' ), $this->panels_data, 'CNP\\TemplateLibrary\\ACFAccordionPanel', [], 'div', [ 'data-accordion' => '' ] );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->panels ];
	}
}
