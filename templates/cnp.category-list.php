<?php
namespace CNP;

class CategoryList extends Organism {

	public function __construct( $data, $separator = ', ', $name = 'category-list', $tag = 'p', array $attributes, $before, $prepend = '<strong>Categories:</strong> ', $append, $after ) {

		parent::__construct( $name, $tag, $attributes, '', $data, $before, $prepend, $append, $after );

		$this->content = get_the_category_list( $separator, '', $data );
	}
}
