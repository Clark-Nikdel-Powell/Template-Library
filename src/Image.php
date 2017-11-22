<?php

namespace CNP\TemplateLibrary;

/**
 * Class Image
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 */
class Image extends Organism {

	/**
	 * The image attachment ID.
	 *
	 * @var null|string
	 */
	public $attachment_id = '';

	/**
	 * A registered WordPress image size.
	 *
	 * @var string
	 */
	public $image_size;

	/**
	 * Honestly, idk what this does.
	 *
	 * @var bool
	 */
	public $icon;

	/**
	 * Image constructor.
	 *
	 * @param string             $name       Organism name.
	 * @param int|\WP_Post|array $data       Required. Either an Attachment post object, an Attachment array (like from ACF) or an Attachment ID.
	 * @param string             $image_size A registered WordPress image size.
	 * @param bool               $icon       Whether this image should be treated as an icon.
	 */
	public function __construct( $name = 'image', $data, $image_size, $icon = false ) {

		parent::__construct( $name, $data );
		$this->tag                 = 'img';
		$this->attributes['class'] = $this->name;
		$this->image_size          = $image_size;
		$this->icon                = $icon;

		if ( isset( $data ) && is_object( $data ) ) {
			$this->attachment_id = $data->ID;
		} elseif ( isset( $data ) && is_array( $data ) ) {
			$this->attachment_id = $data['ID'];
		} else {
			$this->attachment_id = $data;
		}
	}

	/**
	 * Generates WordPress responsive image markup.
	 */
	public function set_content() {
		$this->content = wp_get_attachment_image( $this->attachment_id, $this->image_size, $this->icon, $this->attributes );
	}
}
