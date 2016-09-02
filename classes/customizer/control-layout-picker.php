<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * Layout Picker customizer control class.
 *
 * @author  Paul Underwood
 * @since  1.0.0
 * @access public
 */
class Layout_Picker_Custom_Control extends WP_Customize_Control {

	/**
	 * Render the content on the theme customizer page
	 */
	 public function render_content() {

		 ?><label>
			 <span class="customize-layout-control"><?php echo esc_html( $this->label ); ?></span>
			 <ul>
				 <li>
					 	<img src="<?php echo trailingslashit( get_stylesheet_directory_uri() ); ?>1col.png" alt="Full Width" />
						<input type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[full_width]" value="1" />
				</li>
				 <li>
					 <img src="<?php echo trailingslashit( get_stylesheet_directory_uri() ); ?>2cl.png" alt="Left Sidebar" />
					 <input type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[left_sidebar]" value="1" />
				 </li>
				 <li>
					 <img src="<?php echo trailingslashit( get_stylesheet_directory_uri() ); ?>2cr.png" alt="Right Sidebar" />
					 <input type="radio" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>[right_sidebar]" value="1" />
				 </li>
			 </ul>
		 </label><?php

	 } // render_content()

} // class
