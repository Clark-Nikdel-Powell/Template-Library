<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFAccordionToTabs
 *
 * @package CNP\TemplateLibrary
 */
class ACFAccordionToTabs extends ACFAccordion {

	/**
	 * Foundation setting for when it should become tabs instead of accordion.
	 *
	 * @var string
	 */
	public $responsive_attribute = 'accordion medium-tabs';

	/**
	 * ACFAccordionToTabs constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		// Name is treated a little differently here, since we're extending the ACFAccordion class.
		if ( ! empty( $data['name'] ) ) {
			$data['name'] = 'acf-accordion-tabs';
		}

		// Hide, Class & ID are all handled in ACFAccordion.
		parent::__construct( $data );

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->panels                      = new ACFLoop( $this->organism_name( 'panels' ), $this->panels_data, 'CNP\\TemplateLibrary\\ACFAccordionPanel' );
		$this->panels->attributes['class'] = [ 'accordion' ];

		$this->panels->attributes['data-responsive-accordion-tabs'] = [ 'accordion', 'medium-accordion', 'large-tabs' ];

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->panels ];
	}
}
