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
	 * @param string $name       Organism name.
	 * @param string $data       Optional. We'll try finding the post parent link if the post type supports it.
	 * @param string $content    Link content.
	 * @param array  $attributes Link attributes.
	 */
	public function __construct( $name = 'link-post-parent', $data = '#', $content = '', array $attributes = [] ) {

		parent::__construct( $name, $data, $content, $attributes );

		if ( '#' === $this->attributes['href'] ) {

			// Reset data to a \WP_Post object.
			$this->data = get_post();

			// Do a lot of checking to make sure we CAN get a post parent link outta this post.
			if ( isset( $this->data->post_type ) && is_post_type_hierarchical( $this->data->post_type ) && 0 !== $this->data->post_parent ) {

				// Get all the post ancestors, direct parents at the beginning, highest ancestors at the end.
				$post_parents = get_post_ancestors( $this->data );

				if ( ! empty( $post_parents ) ) {

					// Get the first item from the array.
					$direct_parent = array_shift( $post_parents );

					// Now set the link.
					$this->attributes['href'] = get_permalink( $direct_parent );
				}
			}
		}
	}
}
