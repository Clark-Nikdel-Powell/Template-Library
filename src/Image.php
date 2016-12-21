<?php

namespace CNP\TemplateLibrary;

class Image extends Organism {

	private $attachment_id = '';
	public $image_size;
	public $icon;

	public function __construct( $image_size, $icon, $name = 'image', $attributes = [], $data = null, $before = '', $after = '' ) {

		parent::__construct( $name, 'img', $attributes, null, $data, $before, null, null, $after );

		$this->image_size = $image_size;
		$this->icon       = $icon;

		if ( isset( $data ) && is_object( $data ) ) {
			$this->attachment_id = $data->ID;
		} elseif ( isset( $data ) && is_array( $data ) ) {
			$this->attachment_id = $data['ID'];
		} else {
			$this->attachment_id = $data;
		}
	}

	public function get_markup() {

		Organism::do_filter();

		if ( defined( 'WP_CONTENT_DIR' ) ) {
			return $this->before . wp_get_attachment_image( $this->attachment_id, $this->image_size, $this->icon, $this->attributes ) . $this->after;
		}

		return null;
	}
}
