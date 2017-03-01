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
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name = $data['name'], $data, $content = '', $tag = 'li', $attributes = [], $structure = [], $parent_name = '', $separator = '-', $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->link = new Link( Organism::organism_name( 'link', '-' ), '#panel' . $this->data['loop-index'], $this->data['tab_title'] );

		if ( 0 === $this->data['loop-index'] ) {
			$this->attributes['class'][]               = Organism::organism_name( 'isActive', '--' );
			$this->link['attributes']['aria-selected'] = 'true';
		}

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->link ];
	}
}
