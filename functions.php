<?php
/**
 * Theme functionality.
 */

/**
 * Load theme styles.
 *
 * @return  void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Processing

		wp_enqueue_style( 'bookshelf', get_stylesheet_uri() );

}, 1000 );

/**
 * Register Book Meta block with ACF.
 *
 * @return  void
 */
add_action( 'acf/init', function() {

	// Processing

		if ( function_exists( 'acf_register_block' ) ) {
			acf_register_block( array(
				'name'        => 'bookshelf/book-meta',
				'title'       => esc_html__( 'Book Meta', 'bookshelf' ),
				'description' => esc_html__( 'Displays meta info about single Book post type.', 'bookshelf' ),
				'version'     => '1.0.0',
				'keywords'    => array( 'book', 'meta' ),

				'category' => 'theme',
				'icon'     => 'book-alt',

				'supports' => array(
					'align' => true,
					'spacing' => array(
						'margin'  => true,
						'padding' => true,
					),
					'typography' => array(
						'lineHeight' => true,
						'fontSize'   => true,
					),
				),

				'render_template' => 'block/book-meta/render.php',
			) );
		}

} );

/**
 * Extend WordPress search to include custom fields.
 *
 * @link  https://adambalee.com/search-wordpress-by-custom-fields-without-a-plugin/
 */

	/**
	 * Join `posts` and `postmeta` tables.
	 *
	 * @param  string $join
	 *
	 * @return  string
	 */
	add_filter( 'posts_join', function( string $join ): string {

		// Variables

			global $wpdb;


		// Processing

			if ( is_search() ) {
				$join .=
					' LEFT JOIN '
					. $wpdb->postmeta
					. ' ON '
					. $wpdb->posts
					. '.ID = '
					. $wpdb->postmeta
					. '.post_id ';
			}


		// Output

			return $join;

	} );

	/**
	 * Modify the search query with `posts_where`.
	 *
	 * @param  string $where
	 *
	 * @return  string
	 */
	add_filter( 'posts_where', function( string $where ): string {

		// Variables

			global $pagenow, $wpdb;


		// Processing

			if ( is_search() ) {
				$where = preg_replace(
					"/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
					"(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)",
					$where
				);
			}


		// Output

			return $where;

	} );

	/**
	 * Prevent duplicates.
	 *
	 * @param  string $where
	 *
	 * @return  string
	 */
	add_filter( 'posts_distinct', function( string $where ): string {

		// Output

			if ( is_search() ) {
				return "DISTINCT";
			} else {
				return $where;
			}

	} );
