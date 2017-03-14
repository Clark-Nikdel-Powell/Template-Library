<?php
namespace CNP\TemplateLibrary;

/**
 * Class ContainerPostClass
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_post_class/
 */
class ContainerPostClass extends Container {

	/**
	 * ContainerPostClass constructor.
	 *
	 * @param string   $name        Organism name.
	 * @param array    $structure   Structure.
	 * @param string   $parent_name Optional. Parent name.
	 * @param string   $separator   Optional. Separator between parent name and sub-organism names.
	 * @param \WP_Post $data        Optional. Defaults to current post.
	 */
	public function __construct( $name = 'container-post-class', $structure, $parent_name = '', $separator = '__', \WP_Post $data = null ) {

		parent::__construct( $name, $structure, $parent_name, $separator );

		if ( null === $this->data ) {
			$this->data = get_post();
		}

		array_merge( $this->attributes['class'], get_post_class( '', $this->data ) );
	}
}
