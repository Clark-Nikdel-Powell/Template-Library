<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFTabs
 *
 * @package CNP\TemplateLibrary
 */
class ACFTabs extends Organism {

	/**
	 * Array of tabs data.
	 *
	 * @var array
	 */
	public $tabs_data;

	/**
	 * Container for all tab headings
	 *
	 * @var ACFLoop
	 */
	public $headings;

	/**
	 * Container for all tab content panels.
	 *
	 * @var ACFLoop
	 */
	public $content;

	/**
	 * ACFTabs constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		$name = 'acf-tabs';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide      = $this->data['hide'];
		$this->tabs_data = $this->data['tabs'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->headings                          = new ACFLoop( $this->organism_name( 'headings' ), $this->tabs_data, 'CNP\\TemplateLibrary\\ACFTabHeading' );
		$this->headings                          = 'ul';
		$this->headings->attributes['data-tabs'] = null;
		$this->headings->attributes['id']        = null;

		$this->content                                  = new ACFLoop( $this->organism_name( 'content' ), $this->tabs_data, 'CNP\\TemplateLibrary\\ACFTabContent' );
		$this->content->attributes['data-tabs-content'] = null;

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->headings,
			$this->content,
		];
	}
}
