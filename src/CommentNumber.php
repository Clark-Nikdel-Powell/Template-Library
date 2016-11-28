<?php
namespace CNP\TemplateLibrary;

class CommentNumber extends Organism {
	public function __construct( $name = 'comment-number', $tag = 'div', $attributes = [], $content = '', $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {
		parent::__construct( $name, $tag, $attributes, $content, $data, $before, $prepend, $append, $after );

		if ( isset( $this->data ) && isset( $this->data->ID ) ) {
			$this->content = get_comments_number( $this->data->ID );
		}
	}
}
