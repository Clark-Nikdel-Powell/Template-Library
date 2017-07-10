<?php

namespace CNP\TemplateLibrary;

class SubnavParentBasis extends Organism {

	public $subnav_basis;
	public $parent_id;
	public $back_link;
	public $header;
	public $links;

	public function __construct() {

		$current_post   = get_post();
		$subnav_classes = array();

		if ( 0 === $current_post->post_parent ) {
			array_push( $subnav_classes, 'subnav--noParent' );
			$this->subnav_basis = $current_post->ID;
			$this->parent_id    = '';
		} else {
			$this->subnav_basis = $current_post->post_parent;
			$this->parent_id    = $this->subnav_basis;
		}

		$children_pages = get_pages( 'child_of=' . $this->subnav_basis );
		if ( empty( $children_pages ) ) {
			$subnav_classes[] = 'subnav--hasNoChildren';
		}

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

		$post_status = [ 'publish' ];

		if ( is_user_logged_in() ) {
			$post_status[] = 'private';
		}

		$this->back_link          = new LinkPostParent( $this->organism_name( 'back-link' ) );
		$this->back_link->content = get_the_title( $this->subnav_basis );
		$this->header             = new Container( $this->organism_name( 'header' ), [ $this->back_link ] );
		$this->links              = new WPListPages( $this->organism_name( 'links' ), [
			'child_of'    => $this->subnav_basis,
			'post_status' => $post_status,
			'link_before' => '<span class="text">',
			'link_after'  => '</span>',
		] );

		$this->structure = [
			$this->header,
			$this->links,
		];
	}
}
