<?php
/**
 * Template used for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rosh
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'rosh_entry_top' );

	?><header class="page-header contentpage"><?php

		/**
		 * @hooked 		title_entry 		10
		 * @hooked 		title_page 			10
		 * @hooked 		title_search 		10
		 * @hooked 		posted_on 			20
		 */
		do_action( 'entry_header_content' );

	?></header><!-- .entry-header --><?php

	do_action( 'rosh_entry_content_before' );

	?><div class="page-content"><?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rosh' ),
			'after'  => '</div>',
		) );

	?></div><!-- .entry-content --><?php

	do_action( 'rosh_entry_content_after' );

	?><footer class="entry-footer"><?php

		edit_post_link( esc_html__( 'Edit', 'rosh' ), '<span class="edit-link">', '</span>' );

	?></footer><!-- .entry-footer --><?php

	do_action( 'rosh_entry_bottom' );

?></article><!-- #post-## -->
