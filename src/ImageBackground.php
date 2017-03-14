<?php
namespace CNP\TemplateLibrary;

/**
 * Class ImageBackground
 *
 * @package CNP\TemplateLibrary
 *
 * Returns a background image on a div instead of an img tag. Relies on the Image class for determining the attachment ID.
 *
 * @link    https://developer.wordpress.org/reference/functions/wp_get_attachment_image_src/
 */
class ImageBackground extends Image {

	/**
	 * Set from wp_get_attachment_image_src
	 *
	 * @var string
	 */
	private $image_url;

	/**
	 * Image constructor.
	 *
	 * @param string             $name       Organism name.
	 * @param int|\WP_Post|array $data       Required. Either an Attachment post object, an Attachment array (like from ACF) or an Attachment ID.
	 * @param string             $image_size A WordPress defined image size.
	 */
	public function __construct( $name = 'image-background', $data, $image_size ) {

		parent::__construct( $name, $data, $image_size, $icon = false, $tag = 'div' );

		if ( ! empty( $this->attachment_id ) ) {
			$img_array                 = wp_get_attachment_image_src( $this->attachment_id, $this->image_size, $this->icon );
			$this->image_url           = $img_array[0];
			$this->attributes['style'] = 'background-image: url(' . $this->image_url . ')';
		}
	}

	/**
	 * Returns default Organism markup.
	 *
	 * @return string
	 */
	public function get_markup() {

		// Skip over the Image organism get_markup method.
		return Organism::get_markup();
	}
}
