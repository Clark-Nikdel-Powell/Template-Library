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

		parent::__construct( $name );

		$this->attributes = $attributes;
		$this->tag        = 'video';
	}
}
