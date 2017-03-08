<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFSlideshowSlide
 *
 * @package CNP\TemplateLibrary
 */
class ACFSlideshowSlide extends Organism {

	/**
	 * Slide background
	 *
	 * @var bool|BackgroundVideo|Content|Image|string
	 */
	public $background;

	/**
	 * Slide text container
	 *
	 * @var Container
	 */
	public $text;

	/**
	 * Foreground image
	 *
	 * @var Image
	 */
	public $image;

	/**
	 * Title
	 *
	 * @var Content
	 */
	public $title;

	/**
	 * Subtitle
	 *
	 * @var Content
	 */
	public $subtitle;

	/**
	 * Description
	 *
	 * @var Content
	 */
	public $description;

	/**
	 * Link
	 *
	 * @var Link
	 */
	public $link;

	/**
	 * ACFSlideshowSlide constructor.
	 *
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		$name = 'acf-slide';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		parent::__construct( $name, $data, $content = '', $tag = 'div', $attributes = [], $structure = [], $parent_name = '', $separator = '-', $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->background = Utilities::acf_do_background( $this->data, $this );

		$this->text = new Container( Organism::organism_name( 'text', $this->separator ), [] );

		if ( isset( $this->data['foreground_image'] ) ) {
			$this->image = new Image( Organism::organism_name( 'image', $this->separator ), $this->data['foreground_image'], '' );
			array_push( $this->text->structure, $this->image );
		}

		if ( isset( $this->data['title'] ) ) {
			$this->title = new Content( Organism::organism_name( 'title', $this->separator ), $this->data['title'] );
			array_push( $this->text->structure, $this->title );
		}

		if ( isset( $this->data['subtitle'] ) ) {
			$this->subtitle = new Content( Organism::organism_name( 'subtitle', $this->separator ), $this->data['subtitle'] );
			array_push( $this->text->structure, $this->subtitle );
		}

		if ( isset( $this->data['description'] ) ) {
			$this->description = new Content( Organism::organism_name( 'description', $this->separator ), $this->data['description'] );
			array_push( $this->text->structure, $this->description );
		}

		if ( isset( $this->data['link_text'] ) ) {
			$this->link = new Link( Organism::organism_name( 'link', $this->separator ), $this->data['link'], $this->data['link_text'] );
			array_push( $this->text->structure, $this->link );
		}

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->background,
			$this->text,
		];
	}
}
