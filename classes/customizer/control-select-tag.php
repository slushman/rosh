<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * recent posts select menu customizer control class.
 *
 * @author 		Paul Underwood
 * @since 		1.0.0
 * @access 		public
 */
class Tags_Dropdown_Custom_Control extends WP_Customize_Control {

     private $tags = false;

     public function __construct( $manager, $id, $args = array(), $options = array() ) {

         $this->tags = get_tags($options);

         parent::__construct( $manager, $id, $args );

     } // __construct()

	 /**
      * Render the content on the theme customizer page
      */
     public function render_content() {

         if( empty( $this->tags ) ) { return false; }

		 ?><label>
			 <span class="customize-tags-dropdown"><?php echo esc_html( $this->label ); ?></span>
			 <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"><?php\

			 foreach ( $this->tags as $tag ) {

				 printf('<option value="%s" %s>%s</option>',
				 	$tag->term_id,
					selected($this->value(), $tag->term_id, false),
					$tag->name);
				 }

			?></select>
		</label><?php

     } // render_content()

} // class
