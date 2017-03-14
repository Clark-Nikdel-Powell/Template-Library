<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostsLoop
 *
 * @package CNP\TemplateLibrary
 */
class PostsLoop extends Organism {

	/**
	 * The Organism class name of the organism to use for each post.
	 *
	 * @var string
	 */
	public $post_organism;

	/**
	 * PostsLoop constructor.
	 *
	 * @param string    $name          Organism Name.
	 * @param \WP_Query $data          Array of post objects.
	 * @param string    $post_organism The sub-organism to use.
	 */
	public function __construct( $name = 'posts-loop', $data, $post_organism ) {

		parent::__construct( $name, $data );

		$this->post_organism = $post_organism;
	}

	/**
	 * Uses a Loop to output post organisms to content.
	 *
	 * @return bool
	 */
	public function get_markup() {

		if ( empty( $this->data ) || ! isset( $this->post_organism ) || '' === $this->post_organism ) {

			$this->hide = true;

			return false;
		}

		$namespaced_post_organism = 'CNP\\TemplateLibrary\\' . $this->post_organism;

		while ( $this->data->have_posts() ) {

			// the_post advances onto the next post and sets the global $post variable.
			$this->data->the_post();

			$post_organism = new $namespaced_post_organism();
			$this->content .= $post_organism->get_markup();
		}
		wp_reset_postdata();

		return parent::get_markup();
	}
}
