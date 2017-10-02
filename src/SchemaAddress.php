<?php
namespace CNP\TemplateLibrary;

/**
 * Class SchemaAddress
 *
 * @package CNP\TemplateLibrary
 */
class SchemaAddress extends Organism {

	/**
	 * SchemaAddress constructor.
	 *
	 * @param string $name Organism name.
	 * @param array  $data Address data.
	 */
	public function __construct( $name = 'schema-address', $data = null ) {

		parent::__construct( $name, $data );
	}

	/**
	 * Assemble the address schema block
	 */
	public function get_content() {

		$address_pieces = array();

		if ( isset( $this->data['street_address'] ) && ! empty( $this->data['street_address'] ) ) {
			$address_pieces[] = '<span itemprop="streetAddress">' . $this->data['street_address'] . '</span>';
		}

		if ( isset( $this->data['city'] ) && ! empty( $this->data['city'] ) ) {
			$address_pieces[] = '<span itemprop="addressLocality">' . $this->data['city'] . '</span>';
		}

		if ( isset( $this->data['state'] ) && ! empty( $this->data['state'] ) ) {
			$address_pieces[] = ', <span itemprop="addressRegion">' . $this->data['state'] . '</span>';
		}

		if ( isset( $this->data['zip_code'] ) && ! empty( $this->data['zip_code'] ) ) {
			$address_pieces[] = ' <span itemprop="postalCode">' . $this->data['zip_code'] . '</span>';
		}

		if ( isset( $this->data['country'] ) && ! empty( $this->data['country'] ) ) {
			$address_pieces[] = ', <span itemprop="addressCountry">' . $this->data['country'] . '</span>';
		}

		$address = '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">' . implode( '', $address_pieces ) . '</div>';

		$this->content = $address;
	}
}
