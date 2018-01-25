<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFTabHeading
 *
 * @package CNP\TemplateLibrary
 */
class ACFTabHeading extends Organism {

	/**
	 * Link
	 *
	 * @var Link
	 */
	public $link;

	/**
	 * ACFTabHeading constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		$name = 'acf-tabheading';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		Utilities::acf_set_class_id_and_hide( $this, $this->data );

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->link = new Link( $this->organism_name( 'link', '-' ), '#panel' . $this->data['loop-index'], $this->data['tab_title'] );

		if ( 0 === $this->data['loop-index'] ) {
			$this->attributes['class'][]               = $this->organism_name( 'isActive', '--' );
			$this->link['attributes']['aria-selected'] = 'true';
		}

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->link ];
	}
}
