<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFGallery
 * @package CNP\TemplateLibrary
 */
class ACFGallery extends Organism {

	// Settings
	public $images_data;
	public $image_size;

	// Pieces
	public $inside;
	public $images;
	public $footer;
	public $pagination;
	public $pagination_current;
	public $pagination_separator;
	public $pagination_total;
	public $captions;
	public $nav;
	public $nav_prev;
	public $nav_next;

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-gallery';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = [], $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $data, $attributes );

		$this->hide        = $this->data['hide'];
		$this->images_data = $this->data['images'];
		$this->image_size  = $this->data['image_size'];

		$images_count = count( $this->images_data );

		if ( 1 === $images_count ) {
			$this->attributes['class'][] = 'gallery--hidePagination';
			$this->attributes['class'][] = 'gallery--hideNav';
		}

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————

		//——————————————————————————————————————————
		//  Pagination
		//——————————————————————————————————————————
		$this->pagination_current   = new Content( Organism::organism_name( 'pagination-current' ), '1' );
		$this->pagination_separator = new Content( Organism::organism_name( 'pagination-separator' ), '/' );
		$this->pagination_total     = new Content( Organism::organism_name( 'pagination-total' ), $images_count );

		$this->pagination = new Container( Organism::organism_name( 'pagination' ), [ $this->pagination_current, $this->pagination_separator, $this->pagination_total ] );

		//——————————————————————————————————————————
		//  Nav
		//——————————————————————————————————————————
		$this->nav_prev = new Content( Organism::organism_name( 'prev' ), '<', 'button', [ 'class' => $this->name . '__nav-item' ] );
		$this->nav_next = new Content( Organism::organism_name( 'next' ), '>', 'button', [ 'class' => $this->name . '__nav-item' ] );

		$this->nav = new Container( Organism::organism_name( 'nav' ), [ $this->nav_prev, $this->nav_next ] );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		try {

			if ( empty( $this->images ) ) {
				throw new \Exception( 'No images defined.' );
			}

			foreach ( $this->images as $image_index => $image_data ) {
				$this->generate_image( $image_index, $image_data );
			}

			return parent::get_markup();

		} catch ( \Exception $e ) {

			return '<!-- Gallery failed: ' . $e->getMessage() . '-->' . "\n";
		}
	}

	public function generate_image( $image_index, $image_data ) {

	}
}
