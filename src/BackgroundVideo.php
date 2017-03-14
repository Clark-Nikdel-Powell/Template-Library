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
	 */
	public function __construct( $name = 'background-video', array $data ) {

		parent::__construct( $name, $data );

		$this->poster = new ImageBackground( $this->organism_name( 'poster' ), $this->data['jpg'] );

		$video_attributes = [
			'autoplay'           => 'true',
			'loop'               => 'true',
			'muted'              => 'true',
			'webkit-playsinline' => '',
			'playsinline'        => '',
			'src'                => $this->data['mp4'],
		];

		$this->video = new Video( $this->organism_name( 'video' ), $video_attributes );

		$this->container = new Container( $this->organism_name( 'container' ), [ $this->poster, $this->video ] );
		$this->structure = [ $this->container ];
	}
}
