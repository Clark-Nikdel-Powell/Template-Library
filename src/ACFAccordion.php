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
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-accordion';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide        = $this->data['hide'];
		$this->panels_data = $this->data['panels'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->panels = new ACFLoop( $this->organism_name( 'panels' ), $this->panels_data, 'CNP\\TemplateLibrary\\ACFAccordionPanel' );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->panels ];
	}
}
