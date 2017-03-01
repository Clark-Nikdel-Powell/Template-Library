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
	 * Blurb Text
	 *
	 * @var Content
	 */
	public $text;

	/**
	 * Blurb Link
	 *
	 * @var Content
	 */
	public $link;

	/**
	 * ACFBlurb constructor.
	 *
	 * @param string $data ACF Data.
	 */
	public function __construct( $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-blurb';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag = 'div', $attributes = [], $content = '', $data, $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide = $this->data['hide'];

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->image    = new Image( Organism::organism_name( 'image' ), $this->data['foreground_image'], '' );
		$this->icon     = new Content( Organism::organism_name( 'icon' ), Utilities::get_svg_icon( $this->data['icon_name'] ) );
		$this->title    = new Content( Organism::organism_name( 'title' ), $this->data['title'] );
		$this->subtitle = new Content( Organism::organism_name( 'subtitle' ), $this->data['subtitle'] );
		$this->text     = new Content( Organism::organism_name( 'text' ), $this->data['text'] );
		// TODO: the key "link_url" is inconsistent with other organisms hee. We oughta standardize it to "link".
		$this->link = new Link( Organism::organism_name( 'link' ), $this->data['link_url'], $this->data['link_text'] );

		$this->inside = new Container( Organism::organism_name( 'inside' ), [ $this->image, $this->icon, $this->title, $this->subtitle, $this->text, $this->link ] );

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->inside,
		];
	}
}
