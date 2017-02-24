<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFAccordionToTabs
 * @package CNP\TemplateLibrary
 */
class ACFAccordionToTabs extends ACFAccordion {

	public $responsive_attribute = 'accordion medium-tabs';

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		// Name is treated a little differently here, since we're extending the ACFAccordion class.
		if ( ! empty( $data['name'] ) ) {
			$data['name'] = 'acf-accordion-tabs';
		}

		parent::__construct( $data, $tag, $attributes, $before, $prepend, $append, $after );

		// Hide, Class & ID are all handled in ACFAccordion.

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->panels = new ACFLoop( Organism::organism_name( 'panels' ), $this->panels_data, 'CNP\\TemplateLibrary\\ACFAccordionPanel', [], 'div', [ 'data-responsive-accordion-tabs' => $this->responsive_attribute ] );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		$this->structure = [ $this->panels ];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
