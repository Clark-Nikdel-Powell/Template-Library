<?php
namespace CNP\TemplateLibrary;

/**
 * Class BackgroundVideo
 * @package CNP\TemplateLibrary
 */
class BackgroundVideo extends Organism {

	public $vide_bg;

	/**
	 * BackgroundVideo constructor.
	 * @link https://github.com/VodkaBears/Vide#readme
	 * TODO: discuss whether we need to change to a different implementation now that iOS supports inline background videos. We could always fork the thing, too.
	 *
	 * @param array $vide_bg Expects an array of settings for Vide's data attribute. The keys are 'mp4', 'webm', and 'jpg'. mp4 and jpg are required.
	 * @param string $name
	 * @param string $tag
	 * @param array $attributes Set 'data-vide-options' to a comma-delimited string of settings.
	 * @param string $before
	 * @param string $prepend
	 * @param string $append
	 * @param string $after
	 */
	public function __construct( array $vide_bg, $name = 'backgroundVideo', $tag = 'div', $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $tag, $attributes, '', null, null, $before, $prepend, $append, $after );

		$this->vide_bg = $vide_bg;

		$this->attributes['data-vide-bg'] = implode( ', ', $this->vide_bg );

		if ( ! isset( $this->attributes['data-vide-options'] ) ) {
			$this->attributes['data-vide-options'] = 'autoplay: true, posterType: jpg, loop: true, muted: true, position: left top';
		}
	}

	/**
	 * get_markup
	 *
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}
}
