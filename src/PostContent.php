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
	 * @param string $name The organism name.
	 * @param string $class A CSS class.
	 */
	public function __construct( $name = 'postcontent', $class = 'postcontent' ) {

		parent::__construct( $name, get_the_content() );

		if ( is_array( $this->attributes['class'] ) ) {
			array_push( $this->attributes['class'], $this->class );
		} else {
			$this->attributes['class'] = $this->class;
		}
	}
}
