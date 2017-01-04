<?php
/**
 * Template Name: Content Sidebar
 *
 * Description: Page template with sidebar on the right-side
 *
 * @package Rosh
 */

get_header();

?><div id="primary" class="content-area content-sidebar"><?php

	/**
	 * The rosh_main_before action hook.
	 */
	do_action( 'rosh_main_before' );

	?><main id="main" role="main"><?php

	/**
	 * The rosh_while_before action hook
	 *
	 * @hooked 		title_archive
	 * @hooked 		title_single_post
	 */
	do_action( 'rosh_while_before' );

	while ( have_posts() ) : the_post();

		/**
		 * The rosh_entry_before action hook
		 */
		do_action( 'rosh_entry_before' );

		get_template_part( 'template-parts/content', 'page' );

		/**
		 * The rosh_entry_after action hook
		 *
		 * @hooked 		comments 		10
		 */
		do_action( 'rosh_entry_after' );

	endwhile; // loop

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
