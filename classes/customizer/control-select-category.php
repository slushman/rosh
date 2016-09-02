<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * Categories Select menu customizer control class.
 *
 * @author  Paul Underwood
 * @since  1.0.0
 * @access public
 */
 class Select_Category_Custom_Control extends WP_Customize_Control {

	 private $cats = false;

	 public function __construct( $manager, $id, $args = array(), $options = array() ) {

		 $this->cats = get_categories( $options );

		 parent::__construct( $manager, $id, $args );

	 } // __construct()

	 /**
	  * Render the content of the category dropdown
	  * @return HTML
	  */
	 public function render_content() {

		 if ( empty( $this->cats ) ) { return false; }

		 ?><label>
			 <span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
			 <select <?php $this->link(); ?>><?php

			 foreach ( $this->cats as $cat ) {

				 printf('<option value="%s" %s>%s</option>', $cat->term_id, selected($this->value(), $cat->term_id, false), $cat->name);

			 } // foreach

			 ?></select>
		 </label><?php

	 } // render_content()

} // class
