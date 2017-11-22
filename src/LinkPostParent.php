<?php

namespace CNP\TemplateLibrary;

/**
 * Class LinkPostParent
 *
 * @package CNP\TemplateLibrary
 */
class LinkPostParent extends Link {

	/**
	 * LinkPostParent constructor.
	 *
	 * @param string          $name       Organism name.
	 * @param string|\WP_Post $data       Optional. We'll try finding the post parent link if the post type supports it.
	 * @param string          $content    Link content.
	 */
	public function __construct( $name = 'link-post-parent', $content = '', $data = null ) {

		if ( null === $data ) {
			$data = get_post();
		}

		parent::__construct( $name, $data, $content );

		if ( is_int( $this->data ) ) {
			$this->attributes['href'] = get_permalink( $this->data );
		} elseif ( is_object( $this->data ) && isset( $this->data->post_parent ) && 0 !== $this->data->post_parent ) {
			$this->attributes['href'] = get_permalink( $this->data->post_parent );
		} else {
			unset( $this->attributes['href'] );
			$this->tag = 'div';
		}
	}
}
