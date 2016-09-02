<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rosh
 */

			/**
			 * The rosh_content_bottom action hook
			 */
			do_action( 'rosh_content_bottom' );

		?></div><!-- #content --><?php

		/**
		 * The rosh_content_after action hook
		 */
		do_action( 'rosh_content_after' );

		/**
		 * The rosh_footer_before action hook
		 */
		do_action( 'rosh_footer_before' );

		?><footer id="colophon" role="contentinfo"><?php

			/**
			 * The rosh_footer_top action hook
			 *
			 * @hooked 		footer_wrap_begin
			 */
			do_action( 'rosh_footer_top' );

			/**
			 * The rosh_footer_content action hook
			 *
			 * @hooked 		footer_content 			20
			 */
			do_action( 'rosh_footer_content' );

			/**
			 * The rosh_footer_bottom action hook
			 *
			 * @hooked 		footer_wrap_end
			 */
			do_action( 'rosh_footer_bottom' );

		?></footer><!-- #colophon --><?php

	/**
	 * The rosh_footer_after action hook
	 */
	do_action( 'rosh_footer_after' );

	wp_footer();

	/**
	 * The rosh_body_bottom action hook
	 */
	do_action( 'rosh_body_bottom' );

	?></body>
</html>
