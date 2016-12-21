<?php
namespace CNP\TemplateLibrary;

abstract class Organism {

	public $name;
	public $tag;
	public $attributes;
	public $content;
	public $data;
	public $structure;
	public $before;
	public $prepend;
	public $append;
	public $after;

	/**
	 * Organism constructor.
	 *
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $content
	 * @param null $data
	 * @param array $structure
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = '', $tag = 'div', array $attributes = [], $content = '', $data = null, array $structure = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		$this->name       = $name;
		$this->tag        = $tag;
		$this->attributes = $attributes;
		$this->content    = $content;
		$this->data       = $data;
		$this->structure  = $structure;
		$this->before     = $before;
		$this->prepend    = $prepend;
		$this->append     = $append;
		$this->after      = $after;
	}

	/**
	 * get_markup
	 *
	 * Returns an Organism's completed markup.
	 * Meant to be overridden when necessary. However, do_filter is required for all Organisms, so please include it as well.
	 *
	 * @return string
	 */
	public function get_markup() {

		// Note: If a child organism overwrites get_markup, please include Organism->do_filter so that we don't have a filterless Organism.
		$this->do_filter();

		return sprintf( '%s<%s %s>%s</%s>%s', $this->before, $this->tag, $this->get_attributes(), $this->get_content(), $this->tag, $this->after );
	}

	/**
	 * do_filter
	 *
	 * Run a namespaced filter for this organism, if we're in WordPress.
	 * The standard practice is to modify the object itself.
	 */
	public function do_filter() {

		if ( defined( 'WP_CONTENT_DIR' ) ) {
			$filter_name = $this->name;
			apply_filters( $filter_name, $this );
		}
	}

	/**
	 * get_attributes
	 *
	 * @return string
	 */
	public function get_attributes() {

		// TODO: check for CSS class sanitation (as in Atom class)
		if ( key_exists( 'class', $this->attributes ) ) {
			array_push( $this->attributes['class'], $this->name );
		} else {
			$this->attributes['class'] = [ $this->name ];
		}

		$attributes = '';
		if ( is_array( $this->attributes ) ) {
			foreach ( $this->attributes as $key => $value ) {
				if ( ! $value ) {
					$attributes .= $key . ' ';
					continue;
				}
				$attr_value = is_array( $value ) ? implode( ' ', $value ) : $value;
				$attributes .= sprintf( '%s="%s" ', $key, $attr_value );
			}
		}

		return $attributes;
	}

	/**
	 * get_content
	 *
	 * @return string
	 */
	public function get_content() {

		return $this->prepend . $this->content . $this->get_structure() . $this->append;
	}

	/**
	 * get_structure
	 *
	 * @return string
	 */
	public function get_structure() {

		if ( ! isset( $this->structure ) || ! is_array( $this->structure ) ) {
			return '';
		}

		$structure = '';
		foreach ( $this->structure as $child ) {
			$child->get_structure();
			$structure .= $child->get_markup();
		}

		return $structure;
	}

	/**
	 * class_name
	 *
	 * Returns the current organism's class name.
	 *
	 * @return string
	 */
	public function class_name() {

		return strtolower( get_class( $this ) );
	}

	/**
	 * class_root
	 *
	 * @return string
	 */
	public function class_root() {

		return sprintf( '%s_%s_', $this->class_name(), $this->name );
	}

	/**
	 * organism_name
	 *
	 * Returns a namespaced organism based on the current name and the given org_name.
	 * Example: TODO: add example
	 *
	 * @param $org_name
	 *
	 * @return string
	 */
	public function organism_name( $org_name ) {

		return $this->name . '__' . $org_name;
	}

	/**
	 * debug
	 *
	 * Used for debugging purposes.
	 */
	public function debug() {

		var_dump( $this );
	}
}
