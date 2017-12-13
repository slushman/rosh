<?php
/**
 * Template used for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rosh
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	/**
	 * The rosh_entry_top action hook.
	 */
	do_action( 'rosh_entry_top' );

	?><header class="page-header contentpage"><?php

		/**
		 * @hooked 		title_entry 		10
		 * @hooked 		title_page 			10
		 * @hooked 		title_search 		10
		 * @hooked 		posted_on 			20
		 */
		do_action( 'rosh_entry_header_content' );

	?></header><!-- .entry-header --><?php

	/**
	 * The rosh_entry_content_before action hook.
	 */
	do_action( 'rosh_entry_content_before' );

	?><div class="page-content"><?php

		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'rosh' ),
			'after'  => '</div>',
		) );

	?></div><!-- .entry-content --><?php

	/**
	 * The rosh_entry_content_after action hook.
	 */
	do_action( 'rosh_entry_content_after' );

	?><footer class="entry-footer"><?php

		/**
		 * The rosh_entry_footer action hook.
		 *
		 * @hooked 		entry_categories_links() 		10
		 * @hooked		entry_tags_links() 				15
		 * @hooked		entry_comments_links() 			20
		 * @hooked 		entry_edit_link() 				25
		 */
		do_action( 'rosh_entry_footer_content' );

	?></footer><!-- .entry-footer --><?php

	/**
	 * The rosh_entry_bottom action hook.
	 */
	do_action( 'rosh_entry_bottom' );

?></article><!-- #post-<?php the_ID(); ?> -->
