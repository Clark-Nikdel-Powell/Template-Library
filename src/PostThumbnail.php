<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostThumbnail
 *
 * @package CNP\TemplateLibrary
 *
 * Displays a post thumbnail as content inside of a containing div.
 *
 * @link    https://developer.wordpress.org/reference/functions/get_the_post_thumbnail/
 */
class PostThumbnail extends Organism {

	/**
	 * Post thumbnail size.
	 *
	 * @var string
	 */
	public $size;

	/**
	 * Attributes for the thumbnail.
	 *
	 * @var array
	 */
	public $attr;

	/**
	 * PostThumbnail constructor.
	 *
	 * @param string       $name Organism name.
	 * @param int|\WP_Post $data Optional. Either a post ID or WP_Post object. Defaults to global $post. Resolves to post ID.
	 * @param string       $size Optional. A registered WordPress image size.
	 * @param array        $attr Optional. NOTE: this is the "attr" parameter specific to get_the_post_thumbnail(), not the Organism-level attributes setting.
	 */
	public function __construct( $name = 'post-thumbnail', $data = null, $size = 'post-thumbnail', array $attr = [] ) {

		parent::__construct( $name, $data );

		$this->size = $size;
		$this->attr = $attr;

		// This catches if we didn't pass anything in.
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		// This catches objects that are passed in, and if we didn't pass anything in.
		if ( is_object( $this->data ) ) {
			$this->data = $this->data->ID;
		}

		// This uses call_user_func so that $attr can be passed in as an array. Pretty sure that's why.
		$this->content = call_user_func( 'get_the_post_thumbnail', $this->data, $this->size, $this->attr );
	}
}
