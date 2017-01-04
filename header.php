<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rosh
 */

/**
 * The rosh_html_before action hook
 */
do_action( 'rosh_html_before' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head><?php

		/**
		 * The rosh_head_top action hook
		 */
		do_action( 'rosh_head_top' );

		/**
		 * The rosh_head_content action hook
		 */
		do_action( 'rosh_head_content' );

		wp_head();

		/**
		 * The rosh_head_bottom action hook
		 */
		do_action( 'rosh_head_bottom' );

	?></head>
	<body <?php body_class(); ?>><?php

		/**
		 * The rosh_body_top action hook
		 *
		 * @hooked 		analytics_code 			10
		 * @hooked 		add_hidden_search		15
		 * @hooked 		skip_link 				20
		 */
		do_action( 'rosh_body_top' );

		/**
		 * The rosh_header_before action hook
		 */
		do_action( 'rosh_header_before' );

		?><header class="site-header" role="banner"><?php

			/**
			 * The rosh_header_top action hook
			 *
			 * @hooked 		header_wrap_start 		10
			 * @hooked 		site_branding_begin 	15
			 */
			do_action( 'rosh_header_top' );

			/**
			 * The header_content action hook
			 *
			 * @hooked 		title_site 			10
			 * @hooked 		site_description 	15
			 */
			do_action( 'rosh_header_content' );

			/**
			 * The rosh_header_bottom action hook
			 *
			 * @hooked 		rosh_header_bottom 	85
			 * @hooked 		header_wrap_end 	90
			 * @hooked 		menu_primary 		95
			 */
			do_action( 'rosh_header_bottom' );

		?></header><?php

		/**
		 * The rosh_header_after action hook
		 */
		do_action( 'rosh_header_after' );

		/**
		 * The rosh_content_before action hook
		 */
		do_action( 'rosh_content_before' );

		?><div id="content" class="site-content"><?php

			/**
			 * The rosh_content_top action hook
			 *
			 * @hooked 		breadcrumbs
			 */
			do_action( 'rosh_content_top' );
