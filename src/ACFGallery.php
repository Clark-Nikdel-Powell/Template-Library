<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFGallery
 *
 * @package CNP\TemplateLibrary
 */
class ACFGallery extends Organism {

	/**
	 * The images data.
	 *
	 * @var array
	 */
	public $images_data;

	/**
	 * The image size to use.
	 *
	 * @var string
	 */
	public $image_size;

	/**
	 * Inside
	 *
	 * @var Container
	 */
	public $inside;

	/**
	 * Images
	 *
	 * @var Container
	 */
	public $images;

	/**
	 * Footer
	 *
	 * @var Container
	 */
	public $footer;

	/**
	 * Pagination
	 *
	 * @var Container
	 */
	public $pagination;

	/**
	 * Current number
	 *
	 * @var Content
	 */
	public $pagination_current;

	/**
	 * Separator character
	 *
	 * @var Content
	 */
	public $pagination_separator;

	/**
	 * Total number of images
	 *
	 * @var Content
	 */
	public $pagination_total;

	/**
	 * Container for all captions
	 *
	 * @var Container
	 */
	public $captions;

	/**
	 * Container for nav buttons
	 *
	 * @var Container
	 */
	public $nav;

	/**
	 * Previous link
	 *
	 * @var Content
	 */
	public $nav_prev;

	/**
	 * Next button
	 *
	 * @var Content
	 */
	public $nav_next;

	/**
	 * ACFGallery constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-gallery';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_id_and_hide( $this, $this->data );

		$this->images_data = $this->data['images'];
		$this->image_size  = ( isset( $this->data['image_size'] ) && ! empty( $this->data['image_size'] ) ? $this->data['image_size'] : 'post-thumbnail' );

		$images_count = count( $this->images_data );

		if ( 1 === $images_count ) {
			$this->attributes['class'][] = 'gallery--hidePagination';
			$this->attributes['class'][] = 'gallery--hideNav';
		}

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		// ——————————————————————————————————————————
		// Images & Captions
		// ——————————————————————————————————————————
		if ( ! empty( $this->images_data ) ) {
			self::generate_images_and_captions();
		}

		if ( is_object( $this->images ) ) {

			// ——————————————————————————————————————————
			// Pagination
			// ——————————————————————————————————————————
			$this->pagination_current   = new Content( $this->organism_name( 'pagination-current' ), '1' );
			$this->pagination_separator = new Content( $this->organism_name( 'pagination-separator' ), '/' );
			$this->pagination_total     = new Content( $this->organism_name( 'pagination-total' ), $images_count );

			$this->pagination = new Container( $this->organism_name( 'pagination' ), [ $this->pagination_current, $this->pagination_separator, $this->pagination_total ] );

			// ——————————————————————————————————————————
			// Nav
			// ——————————————————————————————————————————
			$this->nav_prev = new Content( $this->organism_name( 'prev' ), '<', 'button', [ 'class' => $this->name . '__nav-item' ] );
			$this->nav_next = new Content( $this->organism_name( 'next' ), '>', 'button', [ 'class' => $this->name . '__nav-item' ] );

			$this->nav = new Container( $this->organism_name( 'nav' ), [ $this->nav_prev, $this->nav_next ] );

			// ——————————————————————————————————————————
			// Footer
			// ——————————————————————————————————————————
			$this->footer = new Container( $this->organism_name( 'footer' ), [ $this->pagination, $this->captions, $this->nav ] );

			// ——————————————————————————————————————————
			// Inside
			// ——————————————————————————————————————————
			$this->inside = new Container( $this->organism_name( 'inside' ), [ $this->images, $this->footer ] );

		}

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		if ( is_object( $this->inside ) ) {
			$this->structure = [ $this->inside ];
		}
	}

	/**
	 * Generates images and captions.
	 */
	public function generate_images_and_captions() {

		$this->images   = new Container( $this->organism_name( 'images' ), [] );
		$this->captions = new Container( $this->organism_name( 'captions' ), [] );

		foreach ( $this->images_data as $image_index => $image_datum ) {

			$new_image = new Image( $this->organism_name( 'image' ), $image_datum['id'], $this->image_size, $icon = false );

			$new_caption             = new Content( $this->organism_name( 'caption' ), $image_datum['caption'] );
			$new_caption->attributes = [
				'data-image' => $image_index + 1,
			];

			if ( 0 === $image_index ) {
				$active_caption_class = $this->name . '__caption--isActive';

				if ( isset( $new_caption->attributes['class'] ) && is_array( $new_caption->attributes['class'] ) ) {
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
