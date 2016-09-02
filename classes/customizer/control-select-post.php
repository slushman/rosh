<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * Post select menu customizer control class.
 *
 * @author 		Paul Underwood
 * @since 		1.0.0
 * @access 		public
 */
class Select_Post_Custom_Control extends WP_Customize_Control {

     private $posts = false;

     public function __construct( $manager, $id, $args = array(), $options = array() ) {

         $postargs = wp_parse_args($options, array('numberposts' => '-1'));
         $this->posts = get_posts($postargs);

         parent::__construct( $manager, $id, $args );
     }

     /**
     * Render the content on the theme customizer page
     */
	 public function render_content() {

         if ( empty( $this->posts) ) { return false; }

		 ?><label>
			 <span class="customize-post-dropdown"><?php echo esc_html( $this->label ); ?></span>
			 <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"><?php

			 foreach ( $this->posts as $post ) {

				 printf('<option value="%s" %s>%s</option>', $post->ID, selected($this->value(), $post->ID, false), $post->post_title);

			 }

			 ?></select>
		 </label><?php

	 } // render_content()

} // class
