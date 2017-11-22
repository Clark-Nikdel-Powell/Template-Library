<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFBlurb
 *
 * @package CNP\TemplateLibrary
 */
class ACFBlurb extends Organism {

	/**
	 * Inside
	 *
	 * @var Container
	 */
	public $inside;

	/**
	 * Blurb image
	 *
	 * @var Image
	 */
	public $image;

	/**
	 * Blurb Text
	 *
	 * @var Container
	 */
	public $text;

	/**
	 * Blurb Icon
	 *
	 * @var Content
	 */
	public $icon;

	/**
	 * Blurb Title
	 *
	 * @var Content
	 */
	public $title;

	/**
	 * Blurb Subtitle
	 *
	 * @var Content
	 */
	public $subtitle;

	/**
	 * Blurb Text Content
	 *
	 * @var Content
	 */
	public $text_content;

	/**
	 * Blurb Link
	 *
	 * @var Content
	 */
	public $link;

	/**
	 * ACFBlurb constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-blurb';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->image        = new Image( $this->organism_name( 'image' ), $this->data['foreground_image'], '' );
		$this->icon         = new Content( $this->organism_name( 'icon' ), ( '' !== $this->data['icon_name'] ? Utilities::get_svg_icon( $this->data['icon_name'] ) : '' ) );
		$this->title        = new Content( $this->organism_name( 'title' ), $this->data['title'] );
		$this->subtitle     = new Content( $this->organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->text_content = new Content( $this->organism_name( 'content' ), $this->data['text'] );
		// TODO: the data array key "link_url" is inconsistent with other organisms here. We ought to standardize it to "link", both here and in flex-content.php in ACF Flex Layouts.
		$this->link = new Link( $this->organism_name( 'link' ), $this->data['link'], $this->data['link_text'] );

		$this->text = new Container( $this->organism_name( 'text' ), [ $this->icon, $this->title, $this->subtitle, $this->text_content, $this->link ] );

		$this->inside = new Container( $this->organism_name( 'inside' ), [ $this->image, $this->text ] );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->inside,
		];
	}
}
