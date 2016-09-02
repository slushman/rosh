<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) { return NULL; }

/**
 * Menu select customizer control class.
 *
 * @author 		Paul Underwood
 * @since 		1.0.0
 * @access 		public
 */
class Select_Menu_Custom_Control extends WP_Customize_Control {

    private $menus = false;

    public function __construct( $manager, $id, $args = array(), $options = array() ) {

        $this->menus = wp_get_nav_menus($options);

        parent::__construct( $manager, $id, $args );

    } // __construct()

    /**
     * Render the content on the theme customizer page
     */
    public function render_content() {

        if ( empty( $this->menus ) ) { return false; }

        ?><label>
            <span class="customize-menu-dropdown"><?php echo esc_html( $this->label ); ?></span>
            <select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>"><?php

            foreach ( $this->menus as $menu ) {

                printf('<option value="%s" %s>%s</option>', $menu->term_id, selected($this->value(), $menu->term_id, false), $menu->name);

            }

            ?></select>
        </label><?php

    } // render_content()

} // class
