<?php
namespace CNP\TemplateLibrary;

/**
 * Class CategoryList
 *
 * @package CNP\TemplateLibrary
 *
 * Uses get_the_category_list() to return a comma-delimited list of category links wrapped in a paragraph.
 *
 * @link    https://developer.wordpress.org/reference/functions/get_the_category_list/
 */
class CategoryList extends Organism {

	/**
	 * Delimiter between categories
	 *
	 * @var string
	 */
	public $delimiter;

	/**
	 * Parents option
	 *
	 * @var string
	 */
	public $parents;

	/**
	 * Parents order
	 *
	 * @var string
	 */
	public $parents_order;

	/**
	 * Include category links or no.
	 *
	 * @var bool
	 */
	public $include_links;

	/**
	 * CategoryList constructor.
	 *
	 * @param string   $name          The Organism name.
	 * @param string   $delimiter     The separator for the category links.
	 * @param string   $parents       Either "multiple" or "single".
	 * @param string   $parents_order Either "first" or "last".
	 * @param bool     $include_links Include category links or not.
	 * @param \WP_Post $data          Optional. A WordPress post ID. Assumes global $post if not supplied.
	 */
	public function __construct( $name = 'category-list', $delimiter = ', ', $parents = '', $parents_order = 'first', $include_links = true, \WP_Post $data = null ) {

		parent::__construct( $name, $data );
		$this->delimiter     = $delimiter;
		$this->parents       = $parents;
		$this->parents_order = $parents_order;
		$this->include_links = $include_links;

		if ( true === $this->include_links ) {
			$this->content = get_the_category_list( $this->delimiter, $this->parents, $this->data );
		}
		if ( false === $this->include_links ) {
			$this->content = self::get_the_category_list_without_links( $this->delimiter, $this->parents, $this->data );
		}
	}

	/**
	 * Retrieve category list in either HTML list or custom format.
	 *
	 * @since 1.5.1
	 *
	 * @global \WP_Rewrite $wp_rewrite
	 *
	 * @param string       $separator Optional, default is empty string. Separator for between the categories.
	 * @param string       $parents   Optional. How to display the parents.
	 * @param int|bool     $post_id   Optional. Post ID to retrieve categories.
	 *
	 * @return string
	 */
	private function get_the_category_list_without_links( $separator = '', $parents = '', $post_id = false ) {
		global $wp_rewrite;
		if ( ! is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) ) {
			/** This filter is documented in wp-includes/category-template.php */
			return apply_filters( 'the_category', '', $separator, $parents );
		}

		/**
		 * Filters the categories before building the category list.
		 *
		 * @since 4.4.0
		 *
		 * @param array    $categories An array of the post's categories.
		 * @param int|bool $post_id    ID of the post we're retrieving categories for. When `false`, we assume the
		 *                             current post in the loop.
		 */
		$categories = apply_filters( 'the_category_list', get_the_category( $post_id ), $post_id );

		if ( empty( $categories ) ) {
			/** This filter is documented in wp-includes/category-template.php */
			return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );
		}

		$rel = ( is_object( $wp_rewrite ) && $wp_rewrite->using_permalinks() ) ? 'rel="category tag"' : 'rel="category"';

		$thelist = '';
		if ( '' === $separator ) {
			$thelist .= '<ul class="post-categories">';
			foreach ( $categories as $category ) {
				$thelist .= "\n\t<li>";
				switch ( strtolower( $parents ) ) {
					case 'multiple':
						if ( $category->parent ) {
							$thelist .= get_category_parents( $category->parent, true, $separator );
						}
						$thelist .= $category->name . '</li>';
						break;
					case 'single':
						if ( $category->parent ) {
							$thelist .= get_category_parents( $category->parent, false, $separator );
						}
						$thelist .= $category->name . '</li>';
						break;
					case '':
					default:
						$thelist .= $category->name . '</li>';
				}
			}
			$thelist .= '</ul>';
		} else {
			$i = 0;
			foreach ( $categories as $category ) {
				if ( 0 < $i ) {
					$thelist .= $separator;
				}
				switch ( strtolower( $parents ) ) {
					case 'multiple':

						$parents_string = '';
						$item_string    = '<span class="category">' . $category->name . '</span>';

						if ( $category->parent ) {

							if ( 'last' === $this->parents_order ) {
								$parents_string = self::get_category_parents_without_links( $category->parent, false, '' );
								$thelist .= $item_string . $separator . $parents_string;
							}
							if ( 'first' === $this->parents_order ) {
								$parents_string = self::get_category_parents_without_links( $category->parent, false, $separator );
								$thelist .= $parents_string . $item_string;
							}
						} else {
							$thelist .= $item_string;
						}

						break;
					case 'single':
						$thelist .= '<span class="category">';
						if ( $category->parent ) {
							$thelist .= self::get_category_parents_without_links( $category->parent, false, $separator );
						}
						$thelist .= "$category->name</span>";
						break;
					case '':
					default:
						$thelist .= '<span class="category">' . $category->name . '</span>';
				}
				++ $i;
			}
		}

		/**
		 * Filters the category or list of categories.
		 *
		 * @since 1.2.0
		 *
		 * @param array  $thelist   List of categories for the current post.
		 * @param string $separator Separator used between the categories.
		 * @param string $parents   How to display the category parents. Accepts 'multiple',
		 *                          'single', or empty.
		 */
		return apply_filters( 'the_category', $thelist, $separator, $parents );
	}


	/**
	 * Retrieve category parents with separator.
	 *
	 * @since 1.2.0
	 *
	 * @param int    $id        Category ID.
	 * @param bool   $link      Optional, default is false. Whether to format with link.
	 * @param string $separator Optional, default is '/'. How to separate categories.
	 * @param bool   $nicename  Optional, default is false. Whether to use nice name for display.
	 * @param array  $visited   Optional. Already linked to categories to prevent duplicates.
	 *
	 * @return string|\WP_Error A list of category parents on success, WP_Error on failure.
	 */
	private function get_category_parents_without_links( $id, $link = false, $separator = '/', $nicename = false, $visited = array() ) {

		$chain  = '';
		$parent = get_term( $id, 'category' );
		if ( is_wp_error( $parent ) ) {
			return $parent;
		}

		if ( $nicename ) {
			$name = $parent->slug;
		} else {
			$name = $parent->name;
		}

		if ( $parent->parent && ( $parent->parent !== $parent->term_id ) && ! in_array( $parent->parent, $visited, true ) ) {
			$visited[] = $parent->parent;
			$chain .= get_category_parents( $parent->parent, $link, $separator, $nicename, $visited );
		}

		$chain .= '<span class="category">' . $name . '</span>' . $separator;

		return $chain;
	}
}
