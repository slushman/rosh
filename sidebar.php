<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link 	https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rosh
 */

if ( ! is_active_sidebar( 'sidebar' ) ) { return; }

/**
 * The rosh_sidebars_before action hook
 */
do_action( 'rosh_sidebars_before' );

?><aside id="secondary" class="widget-area"><?php

	/**
	 * The rosh_sidebar_top action hook
	 */
	do_action( 'rosh_sidebar_top' );

	dynamic_sidebar( 'sidebar' );

	/**
	 * The rosh_sidebar_bottom action hook
	 */
	do_action( 'rosh_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The rosh_sidebars_after action hook
 */
do_action( 'rosh_sidebars_after' );
