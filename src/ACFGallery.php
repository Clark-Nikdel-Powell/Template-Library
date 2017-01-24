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
		$this->image_size  = ( isset( $this->data['image_size'] ) && ! empty( $this->data['image_size'] ) ? $this->data['image_size'] : 'post-thumbnail' );

		$images_count = count( $this->images_data );

		if ( 1 === $images_count ) {
			$this->attributes['class'][] = 'gallery--hidePagination';
			$this->attributes['class'][] = 'gallery--hideNav';
		}

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————

		//——————————————————————————————————————————
		//  Images & Captions
		//——————————————————————————————————————————
		if ( ! empty( $this->images_data ) ) {
			self::generate_images_and_captions();
		}

		if ( is_object( $this->images ) ) {

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

			//——————————————————————————————————————————
			//  Footer
			//——————————————————————————————————————————
			$this->footer = new Container( Organism::organism_name( 'footer' ), [ $this->pagination, $this->captions, $this->nav ] );

			//——————————————————————————————————————————
			//  Inside
			//——————————————————————————————————————————
			$this->inside = new Container( Organism::organism_name( 'inside' ), [ $this->images, $this->footer ] );

		}

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		if ( is_object( $this->inside ) ) {
			$this->structure = [ $this->inside ];
		}
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}


	/**
	 *
	 */
	public function generate_images_and_captions() {

		$this->images   = new Container( Organism::organism_name( 'images' ), [] );
		$this->captions = new Container( Organism::organism_name( 'captions' ), [] );

		foreach ( $this->images_data as $image_index => $image_datum ) {

			$new_image   = new Image( Organism::organism_name( 'image' ), $image_datum['id'], $this->image_size, $icon = false, [ 'data-image' => $image_index ] );

			$new_caption = new Content( Organism::organism_name( 'caption' ), $image_datum['caption'], 'div', [ 'data-image' => $image_index ] );

			if ( 0 === $image_index ) {
				$active_caption_class = $this->name . '__caption--isActive';

				if ( is_array( $new_caption->attributes['class'] ) ) {
					array_push( $new_caption->attributes['class'], $active_caption_class );
				} else {
					$new_caption->attributes['class'] = [ $active_caption_class ];
				}
			}

			$this->images->structure[]   = $new_image;
			$this->captions->structure[] = $new_caption;
		}
	}
}
