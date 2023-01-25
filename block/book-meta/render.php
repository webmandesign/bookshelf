<?php
/**
 * Book Meta block template.
 *
 * @param  array    $attributes  The block attributes.
 * @param  string   $content     The block default content.
 * @param  WP_Block $block       The block instance.
 *
 * @param  array      $block       The block settings and attributes.
 * @param  string     $content     The block inner HTML (empty).
 * @param  bool       $is_preview  True during AJAX preview.
 * @param  int|string $post_id     The post ID this block is saved to.
 */

if ( $is_preview ) {
	echo '<p>' . esc_html__( 'Book meta info.', 'bookshelf' ) . '</p>';
	return;
}

$class = 'book-meta';
if ( ! empty( $block['className'] ) ) {
	$class .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$class .= ' align' . $block['align'];
}

?>
<div class="<?php echo esc_attr( $class ); ?>">
	<?php

	$fields = array(
		'author',
		'publisher',
		'published',
		'isbn',
		'format',
		'pages',
		'language',
		'price',
		'category',
		'tags',
		'obtainment',
	);

	foreach (	$fields as $field_name ) {

		$field       = get_field_object( $field_name, $post_id );
		$field_value = get_field( $field_name, $post_id );

		if ( is_a( $field_value, 'WP_Term' ) ) {
			$field_value = array( $field_value );
		}

		$field_value = array_map(
			function( $item ) {

				if ( is_a( $item, 'WP_Term' ) ) {

					$term_link = '';
					$term_url  = get_term_link( $item );

					if ( ! is_wp_error( $term_url ) ) {
						$term_link .= '<a';
						$term_link .= ' href="' . esc_url( $term_url ) . '"';
						$term_link .= ' class="' . esc_attr( $item->taxonomy . ' ' . $item->taxonomy . '-' . $item->slug ) . '"';
						$term_link .= '>';
						$term_link .= esc_html( $item->name );
						$term_link .= '</a>';
					}

					return $term_link;
				}

				return esc_html( $item );
			},
			(array) $field_value
		);

		?>
		<div class="book-meta-item book-meta-item-<?php echo esc_attr( $field_name ); ?>">
			<span class="book-meta-label"><?php echo esc_html( $field['label'] ); ?></span>
			<span class="book-meta-value"><?php echo implode( ', ', (array) $field_value ); ?></span>
		</div>
		<?php
	}

	?>
</div>
