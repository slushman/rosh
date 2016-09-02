<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Pagex
 *
 * @package Rosh
 */

get_header();

?><div id="primary" class="content-area">
	<main id="main" role="main">
		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rosh' ); ?></h1>
			</header><!-- .page-header -->
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rosh' ); ?></p><?php

			/**
			 * The rosh_404_content action hook
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

		?></section><!-- .error-404 -->
	</main><!-- #main -->
</div><!-- #primary --><?php

get_footer();
