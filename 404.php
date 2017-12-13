<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Pagex
 *
 * @package Rosh
 */

get_header();

?><div id="primary" class="content-area"><?php

	/**
	 * The rosh_main_before action hook.
	 */
	do_action( 'rosh_main_before' );

	?><main id="main"><?php

	/**
	 * The rosh_while_before action hook
	 *
	 * @hooked 		title_archive
	 * @hooked 		title_single_post
	 */
	do_action( 'rosh_while_before' );

		?><section class="error-404 not-found">
			<header class="page-header"><?php

				/**
				 * The rosh_404_header action hook.
				 *
				 * @hooked 		title_404 		10
				 */
				do_action( 'rosh_404_header' );

			?></header><!-- .page-header --><?php

			/**
			 * The rosh_404_content action hook
			 *
			 * @hooked 		four_04_message 		10
			 */
			do_action( 'rosh_404_before' );

			?><div class="page-content"><?php

				/**
				 * The rosh_404_content action hook
				 *
				 * @hooked 		add_search 					10
				 * @hooked 		four_04_posts_widget 		15
				 * @hooked 		four_04_categories 			20
				 * @hooked 		four_04_archives 			25
				 * @hooked 		four_04_tag_cloud 			30
				 */
				do_action( 'rosh_404_content' );

			?></div><!-- .page-content --><?php

			/**
			 * The rosh_404_after action hook
			 */
			do_action( 'rosh_404_after' );

		?></section><!-- .error-404 --><?php

		/**
		 * The rosh_while_after action hook
		 */
		do_action( 'rosh_while_after' );

	?></main><!-- #main --><?php

	/**
	 * The rosh_main_after action hook.
	 *
	 * @hooked 		sidebar 		10
	 */
	do_action( 'rosh_main_after' );

?></div><!-- #primary --><?php

get_footer();
