<?php
namespace CNP;

class ExcerptSearch extends Excerpt {

	public $characters_before;
	public $characters_total;

	public function __construct( $data, $characters_before = 100, $characters_total = 250, $name = 'excerpt', $tag = 'p', array $attributes = [], $before = '', $prepend = '', $append = '', $after = '' ) {

		parent::__construct( $data, $name, $tag, $attributes, $before, $prepend, $append, $after );

		$this->characters_before = $characters_before;
		$this->characters_total  = $characters_total;

		$this->content = $this->search_excerpt();
	}

	public function search_excerpt() {

		if ( ! is_object( $this->data ) ) {
			return;
		}

		// Get the search term
		$search_term = get_query_var( 's' );

		// Sanitize the search term
		$key = esc_html( $search_term, 1 );

		// Retrieve content and strip out all HTML
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
			$this->characters_total = strlen( $content ) - $key_position;
			$after                  = '';
		}

		// Get the part of the content that we'll use for the SearchExcerpt
		$search_excerpt_raw = substr( $content, $start, $this->characters_total );

		// Find matches for the search term.
		preg_match_all( "/$key+/i", $search_excerpt_raw, $matches );

		$search_excerpt_highlights = '';

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