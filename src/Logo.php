<?php
namespace CNP\TemplateLibrary;

/**
 * Class Logo
 *
 * @package CNP\TemplateLibrary
 */
class Logo extends Organism {

	/**
	 * Piece for the site title.
	 *
	 * @var Content
	 */
	public $title;

	/**
	 * Piece for the logo.
	 *
	 * @var Content
	 */
	public $mark;

	/**
	 * Link to the front page.
	 *
	 * @var LinkFrontPage
	 */
	public $link;

	/**
	 * Logo constructor.
	 *
	 * @param string $name Organism name.
	 * @param string $data Logp file (image or svg tag).
	 */
	public function __construct( $name = '', $data ) {

		parent::__construct( $name, $data );

		$this->title                      = new Content( $this->organism_name( 'title', '-' ), get_bloginfo( 'name' ) );
		$this->title->attributes['class'] = [ 'show-for-sr', 'logo-title' ];

		$this->mark                      = new Content( $this->organism_name( 'mark', '-' ), $this->data );
		$this->mark->attributes['class'] = [ 'logo-mark' ];

		$this->link                      = new LinkFrontPage( $this->organism_name( 'link', '-' ), ' ' );
		$this->link->attributes['class'] = [ 'logo-link' ];

		$this->structure = [
			$this->title,
			$this->mark,
			$this->link,
		];
	}
}
