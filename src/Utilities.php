<?php

namespace CNP\TemplateLibrary;

class Utilities {

	public static function acf_do_background( $data, $object ) {

		$return_organism = '';
		$background_type = $data['background_type'];

		// @EXIT: If there is no background, get rid of the atom.
		if ( 'None' === $background_type ) {
			return false;
		}

		if ( 'Image' === $background_type ) {

			// @EXIT: If there's no image set, get rid of the atom.
			if ( empty( $data['background_image'] ) ) {
				return false;
			}

			$image_size = isset( $data['image-size'] ) ? $data['image-size'] : 'large';

			$return_organism = new Image( $object->name . $object->separator . 'image', $data['background_image'], $image_size );
		}

		if ( 'Video' === $background_type ) {

			// If there's no video or image files, get rid of the atom.
			if ( empty( $data['mp4'] ) && empty( $data['webm'] ) && empty( $data['jpg'] ) ) {
				return false;
			}

			$vide_bg = array();

			if ( ! empty( $data['mp4'] ) ) {
				$vide_bg['mp4'] = 'mp4:' . $data['mp4']['url'];
			}
			if ( ! empty( $data['webm'] ) ) {
				$vide_bg['webm'] = 'webm:' . $data['webm']['url'];
			}
			if ( ! empty( $data['jpg'] ) ) {
				$vide_bg['jpg'] = 'poster:' . $data['jpg']['url'];
			}

			$return_organism = new BackgroundVideo( $object->name . $object->separator . 'background-video', $vide_bg );
		}

		if ( 'Color' === $background_type ) {

			// If there's no color set, get rid of the atom.
			if ( empty( $data['background_color'] ) ) {
				return false;
			}

			$return_organism             = new Content( $object->name . $object->separator . 'background', '&nbsp;' );
			$return_organism->attributes = [
				'style' => 'background-color: ' . $data['background_color'] . ';',
			];
		}

		return $return_organism;
	}

	public static function set_event_date_type( $event_start, $event_end, $event_all_day ) {

		$event_date_type = 'uncategorized';

		$timezone_string = get_option( 'timezone_string' );

		// Temporary fix-- TODO: figure out a bulletproof way of getting the current time.
		if ( '' === $timezone_string ) {
			$timezone_string = 'America/New_York';
		}

		$now = new \DateTime( current_time( 'mysql' ), new \DateTimeZone( $timezone_string ) );

		$today    = false;
		$same_day = false;

		if ( $event_start < $now && $event_end > $now ) {
			$today = true;
		}

		if ( date( 'Ymd', $event_start ) === date( 'Ymd', $event_end ) ) {
			$same_day = true;
		}

		if ( true === $today && true === $same_day ) {
			$event_date_type = 'now';
		}
		if ( true === $event_all_day && true === $same_day ) {
			$event_date_type = 'allday-single';
		}
		if ( true === $event_all_day && false === $same_day ) {
			$event_date_type = 'allday-multiple';
		}
		if ( true === $same_day && false === $event_all_day ) {
			$event_date_type = 'single-day';
		}

		return $event_date_type;
	}

	public static function acf_set_class_id_and_hide( $object, $data ) {

		if ( ! empty( $data['class'] ) ) {
			$object->attributes['class'] = Utilities::parse_classes_as_array( $data['class'] );
		}

		if ( ! empty( $data['id'] ) ) {
			$object->attributes['id'] = Utilities::get_id( $data['id'] );
		}

		$object->hide = ( isset( $data['hide'] ) ? $data['hide'] : false );
	}

	/**
	 * get_acf_fields_as_array.
	 *
	 * Gets a bunch of specific ACF fields at once. Especially useful for option page settings, which only
	 * have a way to get one field at a time.
	 *
	 * @since 0.8.0
	 *
	 * @see   get_field
	 * @link  https://www.advancedcustomfields.com/resources/get_field/
	 *
	 * @param array $fields_names_arr An array of the fields to get.
	 * @param bool  $option           Optional. Set to true if the fields are from an options page.
	 *
	 * @return array $data_arr Data array keyed to the field names.
	 */
	public static function get_acf_fields_as_array( $fields_names_arr, $option ) {

		if ( ! is_array( $fields_names_arr ) || empty( $fields_names_arr ) ) {
			return false;
		}

		$data_arr = array();

		$option_arg = '';

		if ( true === $option ) {
			$option_arg = 'option';
		}

		foreach ( $fields_names_arr as $field_name ) {
			$data_arr[ $field_name ] = get_field( $field_name, $option_arg );
		}

		return $data_arr;
	}

	/**
	 * multidimensional_array_map.
	 *
	 * Like array_map, but for multidimensional arrays.
	 *
	 * @param $function
	 * @param $array
	 *
	 * @return array
	 */
	public static function multidimensional_array_map( $function, $array ) {

		$return = array();

		foreach ( $array as $key => $value ) {

			if ( is_array( $value ) ) {
				$formatted_value = self::multidimensional_array_map( $function, $value );
			} else {
				$formatted_value = $function( $value );
			}

			$return[ $key ] = $formatted_value;
		}

		return $return;
	}

	/**
	 * parse_classes_as_array.
	 *
	 * Take a string or array of classes, trim them and then return classes as an array.
	 *
	 * @param string|array $classes . An array or comma-delimited string of classes.
	 *
	 * @return array|bool $data_classes_arr|false. Array of trimmed classes, or false if empty.
	 */
	public static function parse_classes_as_array( $classes ) {

		$data_classes_arr = array();

		if ( is_string( $classes ) ) {

			if ( '' === $classes ) {
				return $data_classes_arr;
			}

			// Create an array
			$data_classes_arr = explode( ',', $classes );

			// Trim the input for any whitespace
			$data_classes_arr = array_map( 'trim', $data_classes_arr );

		}

		if ( is_array( $classes ) ) {

			if ( empty( $classes ) ) {
				return $data_classes_arr;
			}

			$data_classes_arr = $classes;
		}

		return $data_classes_arr;
	}

	/**
	 * get_svg_icon.
	 *
	 * Gets an SVG icon. This is geared toward Icomoon, whose icons don't need a viewbox attribute.
	 * The main SVG sprite referenced by the `use` tag is loaded in the head in functions/add_svg_icon_sprite.php.
	 *
	 * @since 1.0.0
	 *
	 * @param string $icon_name The name of the icon
	 *
	 * @return string SVG icon markup.
	 */
	public static function get_svg_icon( $icon_name ) {

		$icon = '<svg class="icon ' . $icon_name . '"><use xlink:href="#' . $icon_name . '"></use></svg>';

		return $icon;
	}

	/**
	 * print_on_present
	 *
	 * A shorthand for checking to see if a string has data or if
	 * an array is not empty. If successful, the function echoes
	 * out markup, either from a string or a function call.
	 *
	 *
	 * @param string|array    $string_or_array    The variable to check for data.
	 * @param string|function $markup_or_function Markup as a string, or a 'get' function call that returns markup.
	 * @param array           $parameters         Parameters to pass into anonymous function.
	 *
	 * @return string  Prints out markup if check is successful.
	 **/
	public static function print_on_present( $string_or_array, $markup_or_function, $parameters = array() ) {

		$has_data = false;

		// @EXIT: If an object was supplied, return false.
		if ( is_object( $string_or_array ) ) {
			return false;
		}

		// String check
		if ( is_string( $string_or_array ) ) {

			$string_or_array = trim( $string_or_array );

			if ( '' !== trim( $string_or_array ) ) {
				$has_data = true;
			}
		}

		// Array check
		if ( is_array( $string_or_array ) ) {

			// Trim any whitespace first
			$string_or_array = self::multidimensional_array_map( 'trim', $string_or_array );

			if ( ! empty( $string_or_array ) ) {
				$has_data = true;
			}
		}

		// @EXIT: If we don't have any data, exit the function early.
		if ( false === $has_data ) {
			return false;
		}

		// If the second parameter is an anonymous function or a named function, check that
		// the function exists before calling the function
		if ( ( is_object( $markup_or_function ) && $markup_or_function instanceof Closure ) || function_exists( $markup_or_function ) ) {

			call_user_func_array( $markup_or_function, $parameters );

			return true;

		}

		echo $markup_or_function;

		return true;

	}

	public static function &array_get_path( &$array, $path, $delimiter = null, $value = null, $unset = false ) {

		$num_args = func_num_args();
		$element  = &$array;

		if ( ! is_array( $path ) && strlen( $delimiter = (string) $delimiter ) ) {
			$path = explode( $delimiter, $path );
		}

		if ( ! is_array( $path ) ) {
			// Exception?
		}

		while ( $path && ( $key = array_shift( $path ) ) ) {

			if ( ! $path && $num_args >= 5 && $unset ) {
				unset( $element[ $key ] );
				unset( $element );
				$element = null;
			} else {
				$element =& $element[ $key ];
			}
		}

		if ( $num_args >= 4 && ! $unset ) {
			$element = $value;
		}

		return $element;
	}

	public static function array_set_path( $value, &$array, $path, $delimiter = null ) {
		self::array_get_path( $array, $path, $delimiter, $value );

		return;
	}

	public static function array_unset_path( &$array, $path, $delimiter = null ) {
		self::array_get_path( $array, $path, $delimiter, null, true );

		return;
	}

	public static function array_has_path( $array, $path, $delimiter = null ) {
		$has = false;

		if ( ! is_array( $path ) ) {
			$path = explode( $delimiter, $path );
		}

		foreach ( $path as $key ) {

			if ( $has = array_key_exists( $key, $array ) ) {
				$array = $array[ $key ];
			}
		}

		return $has;
	}

	public static function set_or_unset( $string_to_check, $input_array, $key_to_unset, $key_to_set, $backup_string = '' ) {

		$string_to_check = trim( $string_to_check );

		// If the string is empty, we'll either clear out the array key or use a backup (read: default) string.
		if ( '' === $string_to_check ) {

			// If there's a backup, use that. Otherwise, clear out the array key.
			if ( '' !== $backup_string ) {
				self::array_set_path( $backup_string, $input_array, $key_to_set );
			} else {
				self::array_unset_path( $input_array, $key_to_unset );
			}
			// If the string exists, set it on the specified key.
		} else {
			self::array_set_path( $string_to_check, $input_array, $key_to_set );
		}

		return $input_array;

	}

	/**
	 * Inserts any number of scalars or arrays at the point
	 * in the haystack immediately after the search key ($needle) was found,
	 * or at the end if the needle is not found or not supplied.
	 * Modifies $haystack in place.
	 *
	 * @param array  &$haystack the associative array to search. This will be modified by the function
	 * @param string $needle    the key to search for
	 * @param mixed  $stuff     one or more arrays or scalars to be inserted into $haystack
	 *
	 * @return array the index at which $needle was found
	 */
	public static function array_insert_after( &$haystack, $needle = '', $stuff ) {

		if ( ! is_array( $haystack ) ) {
			return $haystack;
		}

		$new_array = array();

		// Merges all args (either strings or arrays) after haystack and needle into $new_array.
		for ( $i = 2; $i < func_num_args(); $i ++ ) {
			$arg = func_get_arg( $i );
			if ( is_array( $arg ) ) {
				$new_array = array_merge( $new_array, $arg );
			} else {
				$new_array[] = $arg;
			}
		}

		$insertion_index = 0;
		// Determine the insertion point.
		foreach ( $haystack as $key => $value ) {
			$insertion_index ++;
			if ( $key == $needle ) {
				break;
			}
		}

		$haystack = array_merge( array_slice( $haystack, 0, $insertion_index, true ), $new_array, array_slice( $haystack, $insertion_index, null, true ) );

		return $insertion_index;
	}

	public static function get_featured_image_id_by_term( $term_slug ) {

		$header_bg_image_args = [
			'numberposts'            => 1,
			'post_type'              => 'attachment',
			'post_status'            => 'any',
			'no_found_rows'          => true,
			'update_post_meta_cache' => false,
			'tax_query'              => [
				[
					'taxonomy'         => 'media-category',
					'field'            => 'slug',
					'terms'            => $term_slug,
					'include_children' => false,
				],
			],
		];

		$header_bg_image = get_posts( $header_bg_image_args );

		if ( empty( $header_bg_image ) || false === $header_bg_image ) {
			return false;
		}

		return $header_bg_image[0]->ID;
	}

	/**
	 * get_classes
	 *
	 * Sanitizes and returns the provided classes as a strong
	 *
	 * @param string       $prefix      | The prefix for filters.
	 * @param string|array $raw_classes | The classes to check.
	 *
	 * @filter $classes_filter | Use this filter to adjust the atom classes array.
	 * @filter $generic_class_filter | Use this filter to adjust individual classes.
	 *
	 * @return string $classes | A space-delimited string of classes.
	 */
	public static function get_classes( $raw_classes, $prefix = '' ) {

		$classes_arr = array();

		// Configure the raw classes in an array
		if ( is_string( $raw_classes ) && '' !== $raw_classes ) {
			$classes_arr = explode( ',', $raw_classes );
		} elseif ( is_array( $raw_classes ) && ! empty( $raw_classes ) ) {
			$classes_arr = $raw_classes;
		}

		// Apply any filters
		if ( defined( 'WP_CONTENT_DIR' ) ) {

			$classes_filter = $prefix . '_classes';
			$classes_arr    = apply_filters( $classes_filter, $classes_arr );
		}

		// Sanitize each class
		if ( defined( 'WP_CONTENT_DIR' ) ) {

			foreach ( $classes_arr as $class_index => $class ) {

				$sanitized_class = sanitize_html_class( $class );

				$generic_class_filter = 'cnp_modify_css_class';
				$filtered_class       = apply_filters( $generic_class_filter, $sanitized_class, $prefix );

				$classes_arr[ $class_index ] = $filtered_class;
			}
		}

		// Filter out duplicates
		$classes_arr = array_unique( $classes_arr );

		// Convert to space-delimited string
		$classes = implode( ' ', $classes_arr );

		return $classes;
	}

	/**
	 * echo_classes
	 *
	 * Uses get_classes to echo a class attribute.
	 *
	 * @param $raw_classes
	 * @param $prefix
	 *
	 * @return string Class attribute
	 */
	public static function echo_classes( $raw_classes, $prefix ) {

		$classes_str = Utilities::get_classes( $raw_classes, $prefix );

		if ( '' !== $classes_str ) {
			echo 'class="' . $classes_str . '"';
		}
	}

	/**
	 * get_id
	 *
	 * Sanitizes and returns the provided ID.
	 *
	 * @see configure_atom_attributes
	 *
	 * @param string|array $raw_id | The ID to check.
	 * @param string       $prefix | The prefix for filters.
	 *
	 * @filter $atomname_id | Use this filter to adjust the atom ID string.
	 *
	 * @return string $id | A single ID.
	 */
	public static function get_id( $raw_id, $prefix = '' ) {

		/* @EXIT: sanity check */
		if ( ! is_string( $raw_id ) || '' == $raw_id ) {
			return false;
		}

		// Set up return variable
		$id = '';

		// Check to make sure we only have one ID.
		$id_arr = explode( ' ', trim( $raw_id ) );

		// Sanitize the first entry in the ID array.
		if ( ! empty( $id_arr ) && defined( 'WP_CONTENT_DIR' ) ) {
			$id = sanitize_html_class( $id_arr[0] );
		}

		// Apply ID filter
		if ( defined( 'WP_CONTENT_DIR' ) ) {

			$prefixed_id_filter = $prefix . '_id';
			$id                 = apply_filters( $prefixed_id_filter, $id );
		}

		return $id;
	}
}
