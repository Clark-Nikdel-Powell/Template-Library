<?php
namespace CNP\TemplateLibrary;

/**
 * Class Organism
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/apply_filters/
 */
abstract class Organism {

	/**
	 * The Organism name
	 *
	 * @var string $name
	 */
	public $name;

	/**
	 * Data, mixed
	 *
	 * @var string $data
	 */
	public $data;

	/**
	 * Content
	 *
	 * @var string $content
	 */
	public $content;

	/**
	 * The Organism name
	 *
	 * @var string $name
	 */
	public $tag;

	/**
	 * Attributes
	 *
	 * @var string $attributes
	 */
	public $attributes;

	/**
	 * Structure
	 *
	 * @var array $structure
	 */
	public $structure;

	/**
	 * Parent Name
	 *
	 * @var string $parent_name
	 */
	public $parent_name;

	/**
	 * Separator
	 *
	 * @var string $separator
	 */
	public $separator;

	/**
	 * Before
	 *
	 * @var string $before
	 */
	public $before;

	/**
	 * Prepend
	 *
	 * @var string $prepend
	 */
	public $prepend;

	/**
	 * Append
	 *
	 * @var string $append
	 */
	public $append;

	/**
	 * After
	 *
	 * @var string $after
	 */
	public $after;

	/**
	 * Hide
	 *
	 * @var bool $hide
	 */
	public $hide = false;

	/**
	 * Organism constructor.
	 *
	 * @param string $name        The Organism name.
	 * @param null   $data        Data, mixed.
	 * @param string $content     Content.
	 * @param string $tag         The tag.
	 * @param array  $attributes  Attributes.
	 * @param array  $structure   A structure array.
	 * @param string $parent_name The parent name to scope children on.
	 * @param string $separator   The separator between parent and children names.
	 * @param string $before      Markup/text before the tag.
	 * @param string $prepend     Markup/text before the content.
	 * @param string $append      Markup/text after the content.
	 * @param string $after       Markup/text after the tag.
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
	public function get_markup() {

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
	 * @param string $suffix The suffix to put on the filter.
	 */
	public function do_filter( $suffix = '' ) {

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
	public function get_attributes() {

		// Add class for the Organism name.
		if ( key_exists( 'class', $this->attributes ) ) {

			if ( is_array( $this->attributes['class'] ) ) {

				if ( ! in_array( $this->name, $this->attributes['class'], true ) ) {
					array_push( $this->attributes['class'], $this->name );
				}
			}

			// This covers weird circumstances where the class value is a string, like in the WordPress image function attributes.
			if ( is_string( $this->attributes['class'] ) ) {

				if ( false === strpos( $this->attributes['class'], $this->name ) ) {
					$this->attributes['class'] .= $this->name;
				}
			}
		} else {
			$this->attributes['class'] = [ $this->name ];
		}

		// Remove duplicate classes.
		if ( is_array( $this->attributes['class'] ) ) {
			array_filter( $this->attributes['class'] );
		}

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
	 * Gets the content
	 *
	 * @return string
	 */
	public function get_content() {

		return $this->prepend . $this->content . $this->get_structure() . $this->append;
	}

	/**
	 * Gets the structure of an Organism
	 *
	 * @return string
	 */
	public function get_structure() {

		if ( ! isset( $this->structure ) || ! is_array( $this->structure ) ) {
			return '';
		}

		$structure = '';
		foreach ( $this->structure as $child ) {

			// For scoping the children of a parent, i.e., "header__logo".
			if ( ! empty( $this->parent_name ) ) {

				// Pass the parent name and separator down to any children.
				$child->parent_name = $this->parent_name;

				// Prepend the parent name to the child name.
				$child->name = $child->parent_name . $this->separator . $child->name;
			}

			$structure .= $child->get_markup();
		}

		return $structure;
	}

	/**
	 * Returns the current organism's class name.
	 *
	 * @return string
	 */
	public function class_name() {

		return strtolower( get_class( $this ) );
	}

	/**
	 * Generates the class root.
	 *
	 * @return string
	 */
	public function class_root() {

		return sprintf( '%s_%s_', $this->class_name(), $this->name );
	}

	/**
	 * Returns a namespaced organism based on the current name and the given org_name.
	 * Example: TODO: add example
	 *
	 * @param string $org_name  The organism name.
	 * @param string $separator The separator.
	 *
	 * @return string
	 */
	public function organism_name( $org_name, $separator = '__' ) {

		return $this->name . $separator . $org_name;
	}

	/**
	 * Used for debugging purposes.
	 */
	public function debug() {

		var_dump( $this );
	}
}
