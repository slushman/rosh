<?php

/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package _s
 */

class Rosh_WooCommerce {

	/**
	 * Class constructor.
	 */
	public function __construct() {}

		/**
		 * Registers all the WordPress hooks and filters for this class.
		 */
	public function hooks() {

		if ( ! class_exists( 'WooCommerce' ) ) { return; }

		/**
		 * Remove default WooCommerce wrapper.
		 */
		remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
		remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

		add_action( 'after_setup_theme', 				array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', 				array( $this, 'enqueue_scripts' ) );
		add_action( 'woocommerce_before_shop_loop', 	array( $this, 'product_columns_wrapper' ), 40 );
		add_action( 'woocommerce_after_shop_loop', 		array( $this, 'product_columns_wrapper_close' ), 40 );
		add_action( 'woocommerce_before_main_content', 	array( $this, 'wrapper_before' ) );
		add_action( 'woocommerce_after_main_content', 	array( $this, 'wrapper_after' ) );

		/**
		 * Disable the default WooCommerce stylesheet.
		 *
		 * Removing the default WooCommerce stylesheet and enqueing your own will
		 * protect you during WooCommerce core updates.
		 *
		 * @see 	https://docs.woocommerce.com/document/disable-the-default-stylesheet/
		 */
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		add_filter( 'body_class', 								array( $this, 'active_body_class' ) );
		add_filter( 'loop_shop_per_page', 						array( $this, 'products_per_page' ) );
		add_filter( 'woocommerce_product_thumbnails_columns', 	array( $this, 'thumbnail_columns' ) );
		add_filter( 'loop_shop_columns', 						array( $this, 'loop_columns' ) );
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
		add_filter( 'woocommerce_add_to_cart_fragments', 		array( $this, 'cart_link_fragment' ) );

	} // hooks()

	/**
	 * Add 'woocommerce-active' class to the body tag.
	 *
	 * @hooked 		body_class
	 * @since 		1.0.4
	 * @param 		array 		$classes 		CSS classes applied to the body tag.
	 * @return 		array 		$classes 		Modified to include 'woocommerce-active' class.
	 */
	public function active_body_class( $classes ) {

		$classes[] = 'woocommerce-active';

		return $classes;

	} // active_body_class()

	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @since 		1.0.4
	 */
	public function cart_link() {

		?><a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'rosh' ); ?>">
			<span class="amount"><?php

				echo wp_kses_data( WC()->cart->get_cart_subtotal() );

			?></span> <span class="count"><?php

				/* Translators: number of items in the mini cart */
				echo wp_kses_data(
					sprintf(
						_n( '%d item',
							'%d items',
							WC()->cart->get_cart_contents_count(),
						'rosh' ),
						WC()->cart->get_cart_contents_count()
					)
				);

			?></span>
		</a><?php

	} // cart_link()

	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @hooked 		woocommerce_add_to_cart_fragments
	 * @since 		1.0.4
	 * @param 		array 		$fragments 		Fragments to refresh via AJAX.
	 * @return 		array 						Fragments to refresh via AJAX.
	 */
	public function cart_link_fragment( $fragments ) {

		ob_start();
		$this->cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;

	} // cart_link_fragment()

	/**
	 * WooCommerce specific scripts & stylesheets.
	 *
	 * @hooked 		wp_enqueue_scripts
	 */
	public function enqueue_scripts() {

		wp_enqueue_style( 'rosh-woocommerce-style', get_theme_file_uri( '/woocommerce.css' ) );

		$font_path = WC()->plugin_url() . '/assets/fonts/';
		$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-style: normal;
			font-weight: normal;
		}';

		wp_add_inline_style( 'rosh-woocommerce-font', $inline_font );

	} // enqueue_scripts()

	/**
	 * Display Header Cart.
	 */
	public function header_cart() {

		if ( is_cart() ) {

			$class = 'current-menu-item';

		} else {

			$class = '';

		}

		?><ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>"><?php

				$this->cart_link();

			?></li>
			<li><?php

				$instance['title'] = '';

				the_widget( 'WC_Widget_Cart', $instance );

			?></li>
		</ul><?php

	} // header_cart()

	/**
	 * Default loop columns on product archives.
	 *
	 * @hooked 		loop_shop_columns
	 * @since 		1.0.4
	 * @return 		integer 		Products per row.
	 */
	public function loop_columns() {

		return 3;

	} // loop_columns()

	/**
	 * Product columns wrapper.
	 *
	 * @hooked 		woocommerce_before_shop_loop 		40
	 * @since 		1.0.4
	 */
	public function product_columns_wrapper() {

		$columns = $this->loop_columns();
		echo '<div class="columns-' . absint( $columns ) . '">';

	} // product_columns_wrapper()

	/**
	 * Products per page.
	 *
	 * @hooked 		loop_shop_per_page
	 * @return 		int 					Number of products.
	 */
	public function products_per_page() {

		return 12;

	} // products_per_page()

	/**
	 * Product columns wrapper close.
	 *
	 * @hooked 		woocommerce_after_shop_loop 		40
	 * since 		1.0.4
	 */
	public function product_columns_wrapper_close() {

		echo '</div>';

	} // product_columns_wrapper_close()

	/**
	 * Related Products Args.
	 *
	 * @hooked		woocommerce_output_related_products_args
	 * @since 		1.0.4
	 * @param 		array 		$args 		The current related products args.
	 * @return 		array 		$args 		The modified related products args.
	 */
	public function related_products_args( $args ) {

		$defaults['posts_per_page'] = 3;
		$defaults['columns'] 		= 3;

		$args = wp_parse_args( $defaults, $args );

		return $args;

	} // related_products_args()

	/**
	 * WooCommerce setup function.
	 *
	 * @hooked 		after_setup_theme
	 * @link 		https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
	 * @link 		https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
	 * @since 		1.0.4
	 */
	public function setup() {

		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

	} // setup()

	/**
	 * Product gallery thumnbail columns.
	 *
	 * @hooked 		woocommerce_product_thumbnails_columns
	 * @since 		1.0.4
	 * @return 		integer 		Number of columns.
	 */
	public function thumbnail_columns() {

		return 4;

	} // thumbnail_columns()

	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @hooked 		woocommerce_after_main_content
	 * @since 		1.0.4
	 */
	public function wrapper_after() {

			?></main><!-- #main --><?php

	} // wrapper_after()

	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @hooked 		woocommerce_before_main_content
	 * @since 		1.0.4
	 */
	public function wrapper_before() {

		?><main id="main" class="site-main" role="main"><?php

	} // wrapper_before()

} // class
