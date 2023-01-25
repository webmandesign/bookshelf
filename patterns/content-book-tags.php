<?php
/**
 * Title: Header book tags
 * Slug: bookshelf/content-book-tags
 * Inserter: no
 */

?>

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"secondary","textColor":"base","fontSize":"small"} -->
<p class="has-base-color has-secondary-background-color has-text-color has-background has-link-color has-small-font-size"><a href="<?php esc_attr_e( '/book_tag/read/', 'bookshelf' ); ?>"><?php esc_html_e( '✔ Read', 'bookshelf' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"backgroundColor":"primary","textColor":"contrast","fontSize":"small"} -->
<p class="has-contrast-color has-primary-background-color has-text-color has-background has-link-color has-small-font-size"><a href="<?php esc_attr_e( '/book_tag/reading/', 'bookshelf' ); ?>"><?php esc_html_e( '⋯ Reading', 'bookshelf' ); ?></a></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"dark","textColor":"base","fontSize":"small"} -->
<p class="has-base-color has-dark-background-color has-text-color has-background has-link-color has-small-font-size"><a href="<?php esc_attr_e( '/book_tag/to-read/', 'bookshelf' ); ?>"><?php esc_html_e( '⨯ To read', 'bookshelf' ); ?></a></p>
<!-- /wp:paragraph -->
