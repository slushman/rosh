<?php
/**
 * Template part for displaying post excerpts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rosh
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php

	do_action( 'rosh_entry_top' );

	?><header class="entry-header justcontent"><?php

		/**
		 * @hooked 		title_entry 		10
		 * @hooked 		title_page 			10
		 * @hooked 		title_search 		10
		 * @hooked 		posted_on 			20
		 */
		do_action( 'entry_header_content' );

	?></header><!-- .entry-header --><?php

	do_action( 'rosh_entry_content_before' );

	?><div class="entry-content"><?php

		the_excerpt();

	?></div><!-- .entry-content --><?php

	do_action( 'rosh_entry_content_after' );

	?><footer class="entry-footer"><?php

		rosh_entry_footer();

	?></footer><!-- .entry-footer --><?php

	do_action( 'rosh_entry_bottom' );

?></article><!-- #post-## -->
