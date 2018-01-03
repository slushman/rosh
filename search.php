<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Rosh
 */

get_header();

/**
 * The rosh_main_before action hook.
 */
do_action( 'rosh_main_before' );

?><main id="main"><?php

if ( have_posts() ) :

	/**
	 * The rosh_while_before action hook
	 *
	 * @hooked 		title_archive
	 * @hooked 		title_single_post
	 */
	do_action( 'rosh_while_before' );

	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/**
		 * The rosh_entry_before action hook
		 */
		do_action( 'rosh_entry_before' );

		/**
		 * Run the loop for the search to output the results.
		 * If you want to overload this in a child theme then include a file
		 * called content-search.php and that will be used instead.
		 */
		get_template_part( 'template-parts/content', 'search' );

		/**
		 * The rosh_entry_after action hook
		 *
		 * @hooked 		comments 		10
		 */
		do_action( 'rosh_entry_after' );

	endwhile;

	/**
	 * The rosh_while_after action hook
	 *
	 * @hooked 		posts_nav
	 */
	do_action( 'rosh_while_after' );

else :

	/**
	 * The rosh_entry_before action hook
	 */
	do_action( 'rosh_entry_before' );

	get_template_part( 'template-parts/content', 'none' );

	/**
	 * The rosh_entry_after action hook
	 *
	 * @hooked 		comments 		10
	 */
	do_action( 'rosh_entry_after' );

endif;

?></main><!-- #main --><?php

/**
 * The rosh_main_after action hook.
 *
 * @hooked 		sidebar 		10
 */
do_action( 'rosh_main_after' );

get_footer();
