<?php
namespace CNP\TemplateLibrary;

/**
 * Class Menu
 * @package CNP\TemplateLibrary
 */
class Menu extends Organism {

	public $menu_vars;

	/**
	 * Menu constructor.
	 *
	 * @param array $menu_args
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param null $data
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( array $menu_args, $name = 'menu', $tag = 'div', array $attributes = [], $data = null, $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = null, $before, $prepend, $append, $after );

		$menu_defaults = [
			'echo' => false,
		];
		$menu_vars     = wp_parse_args( $menu_defaults, $menu_args );

		$this->menu_vars = $menu_vars;

		$this->content = wp_nav_menu( $this->menu_vars );
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
