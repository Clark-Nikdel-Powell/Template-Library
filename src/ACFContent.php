<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFContent
 *
 * @package CNP\TemplateLibrary
 */
class ACFContent extends Organism {

	/**
	 * ACFContent constructor.
	 *
	 * @param array $data ACF Data.
	 */
	public function __construct( array $data ) {

		// ——————————————————————————————————————————————————————————
		// 0. Parse Data
		// ——————————————————————————————————————————————————————————
		$name = 'acf-content';
		if ( ! empty( $data['name'] ) ) {
			$name = $data['name'];
		}

		$content = trim( $data['content'] );

		parent::__construct( $name, $data, $content );

		Utilities::acf_set_class_and_id( $this, $this->data );

		$this->hide = $this->data['hide'];
	}

	/**
	 * Get_markup
	 *
	 * @return string
	 */
	public function get_markup() {

		$this->hide = empty( $this->content );

		return parent::get_markup();
	}
}
