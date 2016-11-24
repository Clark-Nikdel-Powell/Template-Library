<?php
namespace CNP;

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

	public function __construct( $name = '', $tag = 'div', $attributes = [], $content = '', $data = null, $structure = [], $before = '', $prepend = '', $append = '', $after = '' ) {

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

	public function get_markup() {

		return sprintf( '%s<%s %s>%s</%s>%s', $this->before, $this->tag, $this->get_attributes(), $this->get_content(), $this->tag, $this->after );
	}

	public function get_attributes() {

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

	public function get_content() {

		return $this->prepend . $this->content . $this->get_structure() . $this->append;
	}

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

	public function class_name() {

		return strtolower( get_class( $this ) );
	}

	public function class_root() {

		return sprintf( '%s_%s_', $this->class_name(), $this->name );
	}

	public function organism_name( $org_name ) {

		return $this->name . '__' . $org_name;
	}

	public function debug() {

		var_dump( $this );
	}
}
