<?php
namespace CNP\TemplateLibrary;

/**
 * Class SchemaAddress
 *
 * @package CNP\TemplateLibrary
 */
class SchemaAddress extends Organism {

	/**
	 * Address data
	 *
	 * @var string
	 */
	public $address_data;

	/**
	 * SchemaAddress constructor.
	 *
	 * @param string $name         Organism name.
	 * @param string $address_data Address data.
	 * @param string $tag          HTML tag.
	 * @param array  $attributes   Attributes.
	 * @param string $before       Before tag.
	 * @param string $prepend      Inside opening tag.
	 * @param string $append       Just before closing tag.
	 * @param string $after        After closing tag.
	 */
	public function __construct( $name = 'schema-address', $address_data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content = '', $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		$this->address_data = $address_data;
	}

	/**
	 * Assemble the address schema block
	 *
	 * @return string
	 */
	public function get_content() {

		$address_pieces = array();

		if ( isset( $this->address_data['street_address'] ) && ! empty( $this->address_data['street_address'] ) ) {
			$address_pieces[] = '<span itemprop="streetAddress">' . $this->address_data['street_address'] . '</span>';
		}

		if ( isset( $this->address_data['city'] ) && ! empty( $this->address_data['city'] ) ) {
			$address_pieces[] = '<span itemprop="addressLocality">' . $this->address_data['city'] . '</span>';
		}

		if ( isset( $this->address_data['state'] ) && ! empty( $this->address_data['state'] ) ) {
			$address_pieces[] = ', <span itemprop="addressRegion">' . $this->address_data['state'] . '</span>';
		}

		if ( isset( $this->address_data['zip_code'] ) && ! empty( $this->address_data['zip_code'] ) ) {
			$address_pieces[] = ' <span itemprop="postalCode">' . $this->address_data['zip_code'] . '</span>';
		}

		if ( isset( $this->address_data['country'] ) && ! empty( $this->address_data['country'] ) ) {
			$address_pieces[] = ', <span itemprop="addressCountry">' . $this->address_data['country'] . '</span>';
		}

		$address = '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . implode( '', $address_pieces ) . '</div>';

		return $this->prepend . $address . $this->append;
	}
}
