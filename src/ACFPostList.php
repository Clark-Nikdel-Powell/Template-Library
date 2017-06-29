<?php

namespace CNP\TemplateLibrary;

/**
 * Class ACFPostList
 *
 * @package CNP\TemplateLibrary
 */
class ACFPostList extends Organism {

	public $post_args;
	public $post_organism = '';
	public $post_query;
	public $list_title;
	public $header;
	public $posts_loop;
	public $list_link;
	public $footer;

	/**
	 * ACFPostList constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-postlist';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		$data['post_args'] = [
			'post_type'      => $data['post_type'],
			'posts_per_page' => $data['number_of_posts'],
		];

		parent::__construct( $name, $data );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide       = $this->data['hide'];
		$this->post_args  = $this->data['post_args'];
		$this->post_query = new \WP_Query( $this->post_args );

		// ——————————————————————————————————————————————————————————
		// 1. Set Up Pieces
		// ——————————————————————————————————————————————————————————
		$this->list_title  = new Content( $this->organism_name( 'listtitle' ), $this->data['list_title'] );
		$this->header      = new Container( $this->organism_name( 'header' ), [ $this->list_title ] );
		$this->header->tag = 'header';

		$this->posts_loop = new PostsLoop( $this->organism_name( 'loop' ), $this->post_query, $this->post_organism );

		$this->list_link   = new Link( $this->organism_name( 'listlink' ), $this->data['link'], $this->data['link_text'] );
		$this->footer      = new Container( $this->organism_name( 'footer' ), [ $this->list_link ] );
		$this->footer->tag = 'footer';

		// ——————————————————————————————————————————————————————————
		// 2. Assemble Structure
		// ——————————————————————————————————————————————————————————
		$this->structure = [
			$this->header,
			$this->posts_loop,
			$this->footer,
		];
	}
}
