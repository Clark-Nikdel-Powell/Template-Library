<?php
namespace CNP\TemplateLibrary;

/**
 * Class Video
 *
 * @package CNP\TemplateLibrary
 */
class Video extends Organism {

	/**
	 * Video constructor.
	 *
	 * @param string $name       Organism name.
	 * @param array  $attributes Attributes, namely "src" is required.
	 */
	public function __construct( $name = 'video', array $attributes ) {

		$tag = 'video';

		parent::__construct( $name, $data = null, $content = '', $tag, $attributes, $structure = [], $parent_name = '', $separator = '', $before = '', $prepend = '', $append = '', $after = '' );

	}
}
