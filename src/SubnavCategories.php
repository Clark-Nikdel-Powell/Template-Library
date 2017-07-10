<?php

namespace CNP\TemplateLibrary;

class SubnavCategories extends Organism {

	public $subnav_basis;
	public $parent_id;
	public $back_link;
	public $header;
	public $links;

	public function __construct() {

		$current_post   = get_post();
		$subnav_classes = array();

		parent::__construct(
			$name = 'subnav',
			$data = $current_post,
			$content = '',
			$tag = 'div',
			$attributes = [
				'class' => $subnav_classes,
			],
			$structure = [],
			$parent_name = '',
			$separator = '__',
			$before = '',
			$prepend = '',
			$append = '',
			$after = ''
		);

		$this->back_link = new LinkPostsPage( $this->organism_name( 'back-link' ), 'News Categories' );
		$this->header    = new Container( $this->organism_name( 'header' ), [ $this->back_link ] );
		$this->links     = new WPListTerms( $this->organism_name( 'links' ), [
			'link_before' => '<span class="text">',
			'link_after'  => '</span>',
		], 'category' );

		$this->structure = [
			$this->header,
			$this->links,
		];
	}
}
