<?php

namespace CNP\TemplateLibrary;

/**
 * Class ExcerptSearch
 *
 * @package CNP\TemplateLibrary
 */
class ExcerptSearch extends Excerpt {

	/**
	 * Number of characters before matched term.
	 *
	 * @var int
	 */
	public $characters_before;

	/**
	 * Number of characters after matched term.
	 *
	 * @var int
	 */
	public $characters_total;

	/**
	 * ExcerptSearch constructor.
	 *
	 * @param string   $name              Organism name.
	 * @param int      $characters_before Characters to display before matched search term.
	 * @param int      $characters_total  Characters to display after matched search term.
	 * @param \WP_Post $data              Optional. WP_Post Object. Set by Excerpt if not defined.
	 */
	public function __construct( $name = 'excerpt-search', $characters_before = 100, $characters_total = 250, \WP_Post $data = null ) {

		parent::__construct( $name, $data );

		$this->characters_before = $characters_before;
		$this->characters_total  = $characters_total;

		$this->content = $this->search_excerpt();
	}

	/**
	 * Find the search excerpt.
	 *
	 * @return string
	 */
	public function search_excerpt() {

		if ( ! is_object( $this->data ) ) {
			return '';
		}

		// Get the search term.
		$search_term = get_query_var( 's' );

		// Sanitize the search term.
		$key = esc_html( $search_term, 1 );

		// Retrieve content and strip out all HTML.
		$content = strip_shortcodes( strip_tags( $this->data->post_content ) );
		$content = preg_replace( '/\b(https?):\/\/[-A-Z0-9+&@#\/%?=~_|$!:,.;]*[A-Z0-9+&@#\/%=~_|$]/i', '', $content );
		$content = preg_replace( '|www\.[a-z\.0-9]+|i', '', $content );

		// Get the position of the key inside of the content.
		$key_position = stripos( $content, $key );
		$start        = 0;
		$before       = '';
		$after        = ' &hellip;';

		// If the key position is somewhere inside the content,
		// the starting position is calculated based on the charsBefore value,
		// and the SearchExcerpt needs a ellipsis prepended to it.
		if ( $key_position >= $this->characters_before ) {
			$start  = $key_position - $this->characters_before;
			$before = '&hellip; ';
		}

		// If our projected length is longer than the content string, then we don't need an ellipsis afterward,
		// and the length of the substr needs to be adjusted.
		if ( ( $start + $this->characters_total ) > strlen( $content ) ) {
			$this->characters_total = strlen( $content ) - $start;
			$after                  = '';
		}

		// Get the part of the content that we'll use for the SearchExcerpt.
		$search_excerpt_raw = substr( $content, $start, $this->characters_total );

		if ( empty( $key ) ) {
			return $search_excerpt_raw;
		}

		// Find matches for the search term.
		preg_match_all( "/$key+/i", $search_excerpt_raw, $matches );

		$search_excerpt_highlights = $search_excerpt_raw;

		// If we have matches (we should), add a span to each match for special styles.
		if ( is_array( $matches[0] ) && count( $matches[0] ) >= 1 ) {
			foreach ( $matches[0] as $match ) {
				$search_excerpt_highlights = str_replace( $match, '<strong class="highlighted">' . $match . '</strong>', $search_excerpt_raw );
			}
		}

		$search_excerpt = $before . $search_excerpt_highlights . $after;

		return $search_excerpt;
	}
}
