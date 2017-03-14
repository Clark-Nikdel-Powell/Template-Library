<?php
namespace CNP\TemplateLibrary;

/**
 * Class PostContent
 *
 * @package CNP\TemplateLibrary
 */
class PostContent extends Content {

	/**
	 * A CSS class.
	 *
	 * @var string $class
	 */
	public $class;

	/**
	 * PostContent constructor.
	 *
	 * @param string $name  The organism name.
	 * @param string $class Optional. A CSS class.
	 */
	public function __construct( $name = 'postcontent', $class = 'postcontent' ) {

		parent::__construct( $name, apply_filters( 'the_content', get_the_content() ) );

		$this->attributes['class'] = [ $this->class ];
	}
}
