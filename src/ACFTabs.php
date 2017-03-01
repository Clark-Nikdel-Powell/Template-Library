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
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-tabs';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag = 'div', $attributes = [], $content = '', $data, $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide      = $this->data['hide'];
		$this->tabs_data = $this->data['tabs'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->headings = new ACFLoop( Organism::organism_name( 'headings' ), $this->tabs_data, 'CNP\\TemplateLibrary\\ACFTabHeading', [], 'ul', [ 'data-tabs' => '', 'id' => '' ] );
		$this->content  = new ACFLoop( Organism::organism_name( 'content' ), $this->tabs_data, 'CNP\\TemplateLibrary\\ACFTabContent', [], 'div', [ 'data-tabs-content' => '' ] );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->headings, $this->content ];
	}
}
