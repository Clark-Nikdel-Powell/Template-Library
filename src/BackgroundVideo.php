<?php
namespace CNP\TemplateLibrary;

class BackgroundVideo extends Organism {

	public $vide_bg;

	public function __construct( $vide_bg, $name = 'backgroundVideo', $tag = 'div', $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {
		parent::__construct( $name, $tag, $attributes, '', null, $before, $prepend, $append, $after );

		$this->vide_bg = $vide_bg;

		if ( isset( $this->vide_bg ) ) {
			$this->attributes['data-vide-bg'] = implode( ', ', $this->vide_bg );
		}

		if ( ! isset( $this->attributes['data-vide-options'] ) ) {
			$this->attributes['data-vide-options'] = 'autoplay: true, posterType: jpg, loop: true, muted: true, position: left top';
		}
	}
}
