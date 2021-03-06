<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Rosh
 */

get_header();

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

while ( have_posts() ) : the_post();

	/**
	 * The rosh_entry_before action hook
	 */
	do_action( 'rosh_entry_before' );

	get_template_part( 'template-parts/content', get_post_type() );

	/**
	 * The rosh_entry_after action hook
	 *
	 * @hooked 		comments 		10
	 */
	do_action( 'rosh_entry_after' );

endwhile; // End of the loop.

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

get_footer();
