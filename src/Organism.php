<?php
namespace CNP\TemplateLibrary;

/**
 * Class Organism
 * @package CNP\TemplateLibrary
 *
 * @link https://developer.wordpress.org/reference/functions/apply_filters/
 */
abstract class Organism {

	public $name;
	public $tag;
	public $attributes;
	// TODO: ask again about attribute quote style.
	public $content;
	public $data;
	public $structure;
	public $parent_name;
	public $separator;
	public $before;
	public $prepend;
	public $append;
	public $after;
	public $hide = false;

	/**
	 * Organism constructor.
	 *
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes
	 * @param string $content
	 * @param null $data
	 * @param array $structure
	 * @param string $parent_name
	 * @param string $separator
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( $name = '', $data = null, $content = '', $tag = 'div', array $attributes = [], array $structure = [], $parent_name = '', $separator = '__', $before = '', $prepend = '', $append = '', $after = '' ) {

		$this->name        = $name;
		$this->tag         = $tag;
		$this->attributes  = $attributes;
		$this->content     = $content;
		$this->data        = $data;
		$this->structure   = $structure;
		$this->parent_name = $parent_name;
		$this->separator   = $separator;
		$this->before      = $before;
		$this->prepend     = $prepend;
		$this->append      = $append;
		$this->after       = $after;
	}

	/**
	 * Get_markup
	 *
	 * Returns an Organism's completed markup.
	 * Meant to be overridden when necessary. However, do_filter is required for all Organisms, so please include it as well.
	 *
	 * @return string
	 */
	public
	function get_markup() {

		// Note: If a child organism overwrites get_markup, please include Organism->do_filter so that we don't have a filterless Organism.
		$this->do_filter();

		if ( true === $this->hide ) {
			return '';
		}

		return sprintf( '%s<%s %s>%s</%s>%s', $this->before, $this->tag, $this->get_attributes(), $this->get_content(), $this->tag, $this->after );
	}

	/**
	 * Do_filter
	 *
	 * Run a namespaced filter for this organism, if we're in WordPress.
	 * The standard practice is to modify the object itself.
	 *
	 * @param string $suffix
	 */
	public
	function do_filter(
		$suffix = ''
	) {

		if ( defined( 'WP_CONTENT_DIR' ) ) {
			$filter_name = $this->name . $suffix;
			apply_filters( $filter_name, $this );
		}
	}

	/**
	 * Get_attributes
	 *
	 * @return string
	 */
	public
	function get_attributes() {

		// Add class for the Organism name.
		if ( key_exists( 'class', $this->attributes ) ) {

			if ( ! in_array( $this->name, $this->attributes['class'], true ) ) {
				array_push( $this->attributes['class'], $this->name );
			}
		} else {
			$this->attributes['class'] = [ $this->name ];
		}

		// Remove duplicate classes.
		array_filter( $this->attributes['class'] );

		$attributes = [];
		if ( is_array( $this->attributes ) ) {
			foreach ( $this->attributes as $key => $value ) {
				if ( ! $value ) {
					array_push( $attributes, $key . ' ' );
					continue;
				}
				$attr_value = is_array( $value ) ? implode( ' ', $value ) : $value;
				array_push( $attributes, sprintf( '%s="%s"', $key, $attr_value ) );
			}
		}

		$imploded_value = implode( ' ', $attributes );

		return $imploded_value;
	}

	/**
	 * get_content
	 *
	 * @return string
	 */
	public
	function get_content() {

		return $this->prepend . $this->content . $this->get_structure() . $this->append;
	}

	/**
	 * get_structure
	 *
	 * @return string
	 */
	public
	function get_structure() {

		if ( ! isset( $this->structure ) || ! is_array( $this->structure ) ) {
			return '';
		}

		$structure = '';
		foreach ( $this->structure as $child ) {

			// For scoping the children of a parent, i.e., "header__logo".
			if ( ! empty( $this->parent_name ) ) {

				// Pass the parent name and separator down to any children.
				$child->parent_name = $this->parent_name;
				$child->separator   = $this->separator;

				// Prepend the parent name to the child name.
				$child->name        = $child->parent_name . $this->separator . $child->name;
			}

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
	public
	function class_name() {

		return strtolower( get_class( $this ) );
	}

	/**
	 * class_root
	 *
	 * @return string
	 */
	public
	function class_root() {

		return sprintf( '%s_%s_', $this->class_name(), $this->name );
	}

	/**
	 * organism_name
	 *
	 * Returns a namespaced organism based on the current name and the given org_name.
	 * Example: TODO: add example
	 *
	 * @param $org_name
	 * @param $separator
	 *
	 * @return string
	 */
	public
	function organism_name(
		$org_name, $separator = '__'
	) {

		return $this->name . $separator . $org_name;
	}

	/**
	 * debug
	 *
	 * Used for debugging purposes.
	 */
	public
	function debug() {

		var_dump( $this );
	}
}
