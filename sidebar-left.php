<?php
/**
 * The sidebar for the Sidebar Content page template
 *
 * @package Rosh
 */

if ( ! is_active_sidebar( 'sidebar-left' ) ) { return; }

/**
 * The rosh_sidebars_before action hook
 */
do_action( 'rosh_sidebars_before' );

?><aside id="secondary" class="widget-area sidebar-left" role="complementary"><?php

	/**
	 * The rosh_sidebar_top action hook
	 */
	do_action( 'rosh_sidebar_top' );

	dynamic_sidebar( 'sidebar-left' );

	/**
	 * The rosh_sidebar_bottom action hook
	 */
	do_action( 'rosh_sidebar_bottom' );

?></aside><!-- #secondary --><?php

/**
 * The rosh_sidebars_after action hook
 */
do_action( 'rosh_sidebars_after' );
