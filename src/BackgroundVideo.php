<?php
namespace CNP\TemplateLibrary;

/**
 * Class BackgroundVideo
 *
 * @package CNP\TemplateLibrary
 *
 * A background video.
 */
class BackgroundVideo extends Organism {

	/**
	 * Container for poster and video
	 *
	 * @var Container
	 */
	public $container;

	/**
	 * Poster image for when video is loading
	 *
	 * @var ImageBackground
	 */
	public $poster;

	/**
	 * The video for the background
	 *
	 * @var Video
	 */
	public $video;

	/**
	 * BackgroundVideo constructor.
	 *
	 * @param string $name       Organism name.
	 * @param array  $data       Expects at least two keys, jpg and mp4.
	 * @param string $tag        Organism tag.
	 * @param array  $attributes Set 'data-vide-options' to a comma-delimited string of settings.
	 * @param string $before     Text/Markup before the tag.
	 * @param string $prepend    Text/Markup after the opening tag.
	 * @param string $append     Text/Markup before the closing tag.
	 * @param string $after      Text/Markup after the closing tag.
	 */
	public function __construct( $name = 'background-video', array $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $name, $data = null, $content = '', $tag, $attributes, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		$this->poster = new ImageBackground( Organism::organism_name( 'poster' ), $this->data['jpg'] );

		$video_attributes = [
			'autoplay'           => 'true',
			'loop'               => 'true',
			'muted'              => 'true',
			'webkit-playsinline' => '',
			'playsinline'        => '',
			'src'                => $this->data['mp4'],
		];

		$this->video = new Video( Organism::organism_name( 'video' ), $video_attributes );

		$this->container = new Container( Organism::organism_name( 'container' ), [ $this->poster, $this->video ] );
		$this->structure = [ $this->container ];
	}
}
