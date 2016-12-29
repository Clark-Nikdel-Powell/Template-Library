<?php
namespace CNP\TemplateLibrary;

/**
 * Class Image
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/wp_get_attachment_image/
 */
class Image extends Organism {

	private $attachment_id = '';
	public $image_size;
	public $icon;

	/**
	 * Image constructor.
	 *
	 * @param string $name
	 * @param null $data Required. Either an Attachment post object, an Attachment array (like from ACF) or an Attachment ID.
	 * @param string $image_size A WordPress defined image size.
	 * @param bool $icon Whether this image should be treated as an icon.
	 * @param array $attributes
	 * @param string $before
	 * @param string $after
	 */
	public function __construct( $name = 'image', $data, $image_size, $icon = false, array $attributes = [], $before = '', $after = '' ) {

		parent::__construct( $name, $data, $content = null, $tag = 'img', $attributes, $structure = [], $before, $prepend = null, $append = null, $after );

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

	/**
	 * get_markup
	 *
	 * Returns WordPress responsive image markup.
	 *
	 * @return null|string
	 */
	public function get_markup() {

		Organism::do_filter();

		return $this->before . wp_get_attachment_image( $this->attachment_id, $this->image_size, $this->icon, $this->attributes ) . $this->after;
	}
}
