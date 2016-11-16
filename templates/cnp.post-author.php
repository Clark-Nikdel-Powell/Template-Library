<?php
namespace CNP;

class PostAuthor extends Organism {

	private $author = '';

	public function __construct( $data, $author_meta = 'display_name', $name = 'post-author', $tag = 'p', array $attributes, $content = '', $before = '', $prepend = 'By: ', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		if ( isset( $data ) && is_object( $data ) ) {
			$this->author = $data->post_author;
		} elseif ( isset( $data ) && is_array( $data ) ) {
			$this->author = $data['post_author'];
		} else {
			$this->author = $data;
		}

		$this->content = get_the_author_meta( $author_meta, $this->author );
	}
}
