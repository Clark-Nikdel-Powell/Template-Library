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
	 * Vide options
	 *
	 * @var array
	 */
	public $vide_bg;

	/**
	 * BackgroundVideoVide constructor.
	 *
	 * @param string $name       Organism name.
	 * @param array  $vide_bg    Expects an array of settings for Vide's data attribute. The keys are 'mp4', 'webm', and 'jpg'. mp4 and jpg are required.
	 * @param string $tag        Organism tag.
	 * @param array  $attributes Set 'data-vide-options' to a comma-delimited string of settings.
	 * @param string $before     Text/Markup before the tag.
	 * @param string $prepend    Text/Markup after the opening tag.
	 * @param string $append     Text/Markup before the closing tag.
	 * @param string $after      Text/Markup after the closing tag.
	 */
	public function __construct( $name = 'background-video', array $vide_bg, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content = '', $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		$this->vide_bg = $vide_bg;

		$this->attributes['data-vide-bg'] = implode( ', ', $this->vide_bg );

		if ( ! isset( $this->attributes['data-vide-options'] ) ) {
			$this->attributes['data-vide-options'] = 'autoplay: true, posterType: jpg, loop: true, muted: true, position: left top';
		}
	}
}
