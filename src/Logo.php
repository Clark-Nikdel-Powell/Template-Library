<?php
namespace CNP\TemplateLibrary;

class Logo extends Organism {

	public $title;
	public $mark;
	public $link;

	/**
	 * Logo constructor.
	 *
	 * @param string $name Organism name
	 * @param null $data Log file (image or svg tag)
	 */
	public function __construct( $name = '', $data = null ) {

		parent::__construct( $name );

		$this->title                      = new Content( $this->organism_name( 'title', '-' ), get_bloginfo( 'name' ) );
		$this->title->attributes['class'] = [ 'show-for-sr', 'logo-title' ];

		$this->mark                      = new Content( $this->organism_name( 'mark', '-' ), $data );
		$this->mark->attributes['class'] = [ 'logo-mark' ];

		$this->link                      = new LinkFrontPage( $this->organism_name( 'link', '-' ) );
		$this->link->attributes['class'] = [ 'logo-link' ];

		$this->structure = [
			$this->title,
			$this->mark,
			$this->link,
		];
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
