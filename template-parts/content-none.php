<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Rosh
 */

?><section class="no-results not-found"><?php

	/**
	 * The rosh_entry_top action hook.
	 */
	do_action( 'rosh_entry_top' );

	?><header class="page-header contentnone">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'rosh' ); ?></h1>
	</header><!-- .page-header --><?php

	/**
	 * The rosh_entry_content_before action hook.
	 */
	do_action( 'rosh_entry_content_before' );

	?><div class="page-content"><?php

		if ( is_home() && current_user_can( 'publish_posts' ) ) :

			?><p><?php

				/* Translators: 1: link to WP admin new post page. */
				printf(
					wp_kses(
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'rosh' ),
						array(
							'a' => array(
								'href' => array()
							)
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);

			?></p><?php

		elseif ( is_search() ) :

			?><p><?php

				esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'rosh' );

			?></p><?php

			get_search_form();

		else :

			?><p><?php

				esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'rosh' );

			?></p><?php

			get_search_form();

		endif;

	?></div><!-- .page-content --><?php

	/**
	 * The rosh_entry_content_after action hook.
	 */
	do_action( 'rosh_entry_content_after' );

	/**
	 * The rosh_entry_bottom action hook.
	 */
	do_action( 'rosh_entry_bottom' );

?></section><!-- .no-results -->
