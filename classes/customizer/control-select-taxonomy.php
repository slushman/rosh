<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * Taxonomy select menu customizer control class.
 *
 * @author 		Paul Underwood
 * @since 		1.0.0
 * @access 		public
 */
class Select_Taxonomy_Custom_Control extends WP_Customize_Control {

     private $options = false;

     public function __construct( $manager, $id, $args = array(), $options = array() ) {

         $this->options = $options;

         parent::__construct( $manager, $id, $args );

     } // __construct()

     /**
      * Render the control's content.
      *
      * Allows the content to be overriden without having to rewrite the wrapper.
      *
      * @return  void
      */
     public function render_content() {

		$this->defaults['hide_empty'] 		= 0;
		$this->defaults['id'] 				= $this->id;
		$this->defaults['orderby'] 			= 'name';
		$this->defaults['selected'] 		= $this->value();
		$this->defaults['show_option_none'] = __( 'None' );

 		$cats = wp_parse_args( $this->options, $this->defaults );

 		?><label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span><?php

				wp_dropdown_categories( $cats );

		?></label><?php

	} // render_content()

} // class
