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
	 * @param array           $attributes Link attributes.
	 */
	public function __construct( $name = 'link-post-parent', $data = null, $content = '', array $attributes = [] ) {

		parent::__construct( $name, $data, $content, $attributes );

		if ( null === $this->data ) {
			$this->data = get_post();
		}

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
