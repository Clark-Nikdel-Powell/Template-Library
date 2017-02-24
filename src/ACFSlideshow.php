<?php
namespace CNP\TemplateLibrary;

/**
 * Class ACFSlideshow
 * @package CNP\TemplateLibrary
 */
class ACFSlideshow extends Organism {

	// Supporting Data
	public $elements;
	public $slides_data;
	public $slide_settings;

	// Pieces
	public $slides;

	public function __construct( $data, $tag = 'div', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		//——————————————————————————————————————————————————————————
		//  0. Parse Data
		//——————————————————————————————————————————————————————————
		$name = 'acf-slideshow';
		if ( isset( $data['name'] ) ) {
			$name = $data['name'];
		}

		parent::__construct( $name, $tag, $attributes, $content = '', $data, $structure = [], $parent_name = '', $separator = '__', $before, $prepend, $append, $after );

		Utilities::acf_set_class_and_id( $this, $this->data, $this->attributes );

		$this->hide        = $this->data['hide'];
		$this->elements    = $this->data['elements'];
		$this->slides_data = $this->data['slides'];

		$this->get_slideshow_settings();

		$this->slide_settings = [
			'name'           => Organism::organism_name( 'slide' ),
			'slide_elements' => $this->elements,
		];

		//——————————————————————————————————————————————————————————
		//  1. Set Up Pieces
		//——————————————————————————————————————————————————————————
		$this->slides = new ACFLoop( Organism::organism_name( 'slides' ), $this->slides_data, 'CNP\\TemplateLibrary\\ACFSlideshowSlide', $this->slide_settings );

		//——————————————————————————————————————————————————————————
		//  2. Assemble Structure
		//——————————————————————————————————————————————————————————
		$this->structure = [ $this->slides ];
	}

	/**
	 * @return string
	 */
	public function get_markup() {

		return parent::get_markup();
	}

	/*
	 * get_slideshow_settings
	 *
	 * Finds settings from a Slideshow settings
	 *
	 * These settings don't come from the $data (i.e., from the page itself), but rather from a centralized ACF Options
     * Page for site-wide Slideshow Settings. If options aren't available from the ACF Options page, they could still
	 * be filtered in or Slick can use the defaults.
	 */
	private function get_slideshow_settings() {

		/**
		 * Initialize all the booleans to false-- anything that's checked is set to true.
		 */
		$boolean_defaults = [
			'accessibility'    => false,
			'autoplay'         => false,
			'centerMode'       => false,
			'draggable'        => false,
			'fade'             => false,
			'arrows'           => false,
			'mobileFirst'      => false,
			'infinite'         => false,
			'pauseOnHover'     => false,
			'pauseOnDotsHover' => false,
			'swipe'            => false,
			'swipeToSlide'     => false,
			'touchMove'        => false,
			'useCSS'           => false,
			'variableWidth'    => false,
			'vertical'         => false,
			'verticalSwiping'  => false,
			'rtl'              => false,
			'dots'             => false,
		];

		// This will return any key that is set to true.
		$boolean_settings = Utilities::get_acf_fields_as_array( [ 'slideshow_boolean_options' ], true );

		if ( is_null( $boolean_settings ) ) {
			return false;
		}

		if ( is_array( $boolean_settings ) ) {
			$boolean_settings = $boolean_settings['slideshow_boolean_options'];
		}

		// Overwrite the default false value with true for each checked value.
		// Not sure why I didn't use wp_parse_args here...
		$boolean_vars = array();
		if ( ! empty( $boolean_settings ) ) {
			foreach ( $boolean_settings as $boolean_setting_key ) {
				$boolean_vars[ $boolean_setting_key ] = true;
			}
		}

		// Merge the defaults (everything false) with the true values from our settings.
		$boolean_vars = array_merge( $boolean_defaults, $boolean_vars );

		$settings_keys = [
			'slidesToShow',
			'slidesToScroll',
			'initialSlide',
			'rows',
			'slidesPerRow',
			'pagination_type',
			'cssEase',
			'easing',
			'speed',
			'touchThreshold',
			'edgeFriction',
			'lazyLoad',
			'respondTo',
			'autoplaySpeed',
			'centerPadding',
			'dotsClass',
		];

		// Retrieve string settings data
		$string_vars = Utilities::get_acf_fields_as_array( $settings_keys, true );

		// If both arrays come back empty, something's gone wrong, and we don't need to go through the rest.
		if ( empty( $boolean_vars ) && empty( $string_vars ) ) {
			return false;
		}

		/*——————————————————————————————————————————————————————————
		/  Combine and Encode Slideshow Options
		——————————————————————————————————————————————————————————*/
		$slideshow_vars = array_merge( $boolean_vars, $string_vars );

		if ( 'none' !== $slideshow_vars['pagination_type'] ) {
			$slideshow_vars['dots'] = true;
		}

		//——————————————————————————————————————————
		//  Filter before we switch to JSON
		//——————————————————————————————————————————
		if ( defined( 'WP_CONTENT_DIR' ) ) {

			// Global filter
			$slideshow_vars = apply_filters( 'slideshow_organism_vars', $slideshow_vars );

			// Namespaced filter
			$slideshow_vars_filter = $this->name . '_slideshow_vars';
			$slideshow_vars        = apply_filters( $slideshow_vars_filter, $slideshow_vars );
		}

		$acf_slideshow_settings_json = json_encode( $slideshow_vars, JSON_NUMERIC_CHECK );

		$this->attributes['data-slick'] = $acf_slideshow_settings_json;

		return true;
	}
}
