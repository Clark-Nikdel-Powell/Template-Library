<?php
namespace CNP\TemplateLibrary;

/**
 * Class BackgroundVideoVide
 *
 * @package CNP\TemplateLibrary
 *
 * A background video, set up using Vide.
 *
 * @link    https://github.com/VodkaBears/Vide#readme
 */
class BackgroundVideoVide extends Organism {

	/**
	 * BackgroundVideoVide constructor.
	 *
	 * @param string $name Organism name.
	 * @param array  $data Vide BG options. Expects an array of settings for Vide's data attribute. The keys are 'mp4', 'webm', and 'jpg'. mp4 and jpg are required.
	 */
	public function __construct( $name = 'background-video', array $data ) {

		parent::__construct( $name, $data );

		$this->attributes['data-vide-bg'] = implode( ', ', $this->data );

		if ( ! isset( $this->attributes['data-vide-options'] ) ) {
			$this->attributes['data-vide-options'] = 'autoplay: true, posterType: jpg, loop: true, muted: true, position: left top';
		}
	}
}
