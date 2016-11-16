<?php
namespace CNP;

class PostAuthor extends Organism {

	public function __construct( $data, $author_meta = 'display_name', $name = 'post-author', $tag = 'p', array $attributes, $content = '', $before = '', $prepend = 'By: ', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		if ( isset( $this->data ) && isset( $this->data->post_author ) ) {
			$this->content = get_the_author_meta( $author_meta, $data->post_author );
		}
	}
}
