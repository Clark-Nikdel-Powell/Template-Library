<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFSlideshow
 *
 * @package CNP\TemplateLibrary
 */
class ACFSlideshow extends Organism {

	/**
	 * Elements to display
	 *
	 * @var array
	 */
	public $elements;

	/**
	 * Array of slides data
	 *
	 * @var array
	 */
	public $slides_data;

	/**
	 * Loop of slides
	 *
	 * @var ACFLoop
	 */
	public $slides;

	/**
	 * ACFSlideshow constructor.
	 *
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-slideshow';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide        = $this->data['hide'];
		$this->elements    = $this->data['elements'];
		$this->slides_data = $this->data['slides'];

		foreach ( $this->slides_data as $key => $value ) {
			$this->slides_data[ $key ]['name'] = $this->organism_name( 'slide' );
			$this->slides_data[ $key ]['elements'] = $this->elements;
		}

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->slides = new ACFLoop( $this->organism_name( 'slides' ), $this->slides_data, 'CNP\\TemplateLibrary\\ACFSlideshowSlide' );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [ $this->slides ];
	}
}
