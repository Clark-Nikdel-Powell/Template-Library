<?php
namespace CNP\TemplateLibrary;

/**
 * Class TaxonomyListWithLinks
 *
 * @package CNP\TemplateLibrary
 *
 * @link    https://developer.wordpress.org/reference/functions/get_the_term_list/
 */
class TaxonomyListWithLinks extends TaxonomyList {

	/**
	 * TaxonomyListWithLinks constructor.
	 *
	 * @param string $name      Organism name.
	 * @param string $taxonomy  Registered taxonomy name.
	 * @param string $delimiter Inserted between each item.
	 */
	public function __construct( $name = 'taxonomy-list-with-links', $taxonomy = null, $delimiter = ', ' ) {

		parent::__construct( $name, $taxonomy, $delimiter );

		// Double-checking
		if ( null === $this->data ) {
			$this->data = get_post();
		}

		// Taxonomy is resolved in TaxonomyList.
	}

	/**
	 * Gets the term list.
	 */
	public function get_content() {

		$this->content = get_the_term_list( $this->data, $this->taxonomy, $this->prepend, $this->delimiter, $this->append );
	}
}
