<?php
namespace CNP\TemplateLibrary;

/**
 * Class Video
 *
 * @package CNP\TemplateLibrary
 */
class Video extends Organism {

	public function __construct( $name = 'video', array $attributes = [], $tag = 'video', $content = '', $data = null, $structure = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data, $content, $tag, $attributes, $structure, $parent_name = '', $separator = '', $before, $prepend, $append, $after );

	}
}
