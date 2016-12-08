<?php
namespace CNP\TemplateLibrary;

class PostAuthor extends Organism {

	public $author_meta;

	public function __construct( $data, $author_meta = 'display_name', $name = 'post-author', $tag = 'p', array $attributes, $content = '', $before = '', $prepend = 'By: ', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		$this->author_meta = $author_meta;

		if ( isset( $this->data ) && isset( $this->data->post_author ) ) {
			$this->content = get_the_author_meta( $this->author_meta, $data->post_author );
		}
	}

	public function get_markup() {

		return parent::get_markup();
	}
}
