<?php

/**
 * A class of helpful theme functions
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Utilities {

	/**
	 * Constructor
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_filter( 'script_loader_tag', 				array( $this, 'async_scripts' ), 10, 2 );
		add_filter( 'style_loader_src', 				array( $this, 'remove_cssjs_ver' ), 10, 2 );
		add_filter( 'script_loader_src', 				array( $this, 'remove_cssjs_ver' ), 10, 2 );

		add_filter( 'body_class', 						array( $this, 'page_body_classes' ) );
		add_action( 'wp_head', 							array( $this, 'background_images' ) );
		add_filter( 'embed_oembed_html', 				array( $this, 'youtube_add_id_attribute' ), 99, 4 );
		add_action( 'init', 							array( $this, 'disable_emojis' ) );
		add_filter( 'excerpt_length', 					array( $this, 'excerpt_length' ) );
		add_filter( 'excerpt_more', 					array( $this, 'excerpt_read_more' ) );

		add_filter( 'post_mime_types', 					array( $this, 'add_mime_types' ) );
		add_filter( 'upload_mimes', 					array( $this, 'custom_upload_mimes' ) );
		add_filter( 'manage_page_posts_columns', 		array( $this, 'page_template_column_head' ), 10 );
		add_action( 'manage_page_posts_custom_column', 	array( $this, 'page_template_column_content' ), 10, 2 );
		add_action( 'edit_category', 					array( $this, 'category_transient_flusher' ) );
		add_action( 'save_post', 						array( $this, 'category_transient_flusher' ) );
		add_filter( 'wpseo_metabox_prio', 				function() { return 'low'; } );

	} // hooks()

	/**
	 * Adds PDF as a filter for the Media Library
	 *
	 * @hooked 		post_mime_types
	 * @param 		array 		$post_mime_types 		The current MIME types
	 * @return 		array 								The modified MIME types
	 */
	public function add_mime_types( $post_mime_types ) {

		$post_mime_types['application/pdf'] = array( esc_html__( 'PDFs', 'rosh' ), esc_html__( 'Manage PDFs', 'rosh' ), _n_noop( 'PDF <span class="count">(%s)</span>', 'PDFs <span class="count">(%s)</span>', 'rosh' ) );
		$post_mime_types['text/x-vcard'] 	= array( esc_html__( 'vCards', 'rosh' ), esc_html__( 'Manage vCards', 'rosh' ), _n_noop( 'vCard <span class="count">(%s)</span>', 'vCards <span class="count">(%s)</span>', 'rosh' ) );

		return $post_mime_types;

	} // add_mime_types()

	/**
	 * Sets the async attribute on all script tags.
	 *
	 * @hooked 		script_loader_tag
	 */
	public function async_scripts( $tag, $handle ) {

		if ( is_admin() ) { return $tag; }

		$check = strpos( $handle, 'rosh-' );

		if ( ! $check || 0 < $check ) { return $tag; }

		return str_replace( ' src', ' async="async" src', $tag );

	} // async_scripts()

	/**
	 * Creates a style tag in the header with the background image
	 *
	 * @hooked 		wp_head
	 * @return 		mixed 			Style tag
	 */
	public function background_images() {

		$output = '';
		$image 	= rosh_get_thumbnail_url( get_the_ID(), 'full' );

		if ( ! $image ) {

			$image = get_theme_mod( 'default_featured_image' );

		}

		if ( empty( $image ) ) { return; }

		?><style>
			.featured-image {background-image:url(<?php echo esc_url( $image ); ?>);}
		</style><!-- Background Images --><?php

	} // background_images()

	/**
	 * Flush out the transients used in rosh_categorized_blog.
	 *
	 * @exits 		Doing Autosave.
	 * @hooked 		edit_category
	 * @hooked 		save_post
	 */
	public function category_transient_flusher() {

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }

		// Like, beat it. Dig?
		delete_transient( 'rosh_categories' );

	} // category_transient_flusher()

	/**
	 * Adds support for additional MIME types to WordPress
	 *
	 * @hooked 		upload_mimes
	 * @param 		array 		$existing_mimes 			The existing MIME types
	 * @return 		array 									The modified MIME types
	 */
	public function custom_upload_mimes( $existing_mimes = array() ) {

		// add your extension to the array
		$existing_mimes['vcf'] = 'text/x-vcard';

		return $existing_mimes;

	} // custom_upload_mimes()

	/**
	 * Removes WordPress emoji support everywhere
	 *
	 * @hooked 		init
	 */
	public function disable_emojis() {

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	} // disable_emojis()

	/**
	 * Limits excerpt length
	 *
	 * @hooked 		excerpt_length
	 * @param 		int 		$length 			The current word length of the excerpt
	 * @return 		int 							The word length of the excerpt
	 */
	public function excerpt_length( $length ) {

		if ( is_home() || is_front_page() ) {

			return 30;

		}

		return $length;

	} // excerpt_length()

	/**
	 * Customizes the "Read More" text for excerpts
	 *
	 * @hooked 		excerpt_more
	 * @global   				$post 		The post object
	 * @param 		mixed 		$more 		The current "read more"
	 * @return 		mixed 					The modifed "read more"
	 */
	public function excerpt_read_more( $more ) {

		global $post;

		$return = sprintf( '... <a class="moretag read-more" href="%s">', esc_url( get_permalink( $post->ID ) ) );
		$return .= esc_html__( 'Read more', 'rosh' );
		$return .= '<span class="screen-reader-text">';
		$return .= sprintf( esc_html__( ' about %s', 'rosh' ), $post->post_title );
		$return .= '</span></a>';

		return $return;

	} // excerpt_read_more()

	/**
	 * Returns a WordPress menu for a shortcode
	 *
	 * @hooked 		add_shortcode
	 * @param 		array 		$atts 			Shortcode attributes
	 * @param 		mixed 		$content 		The page content
	 * @return 		mixed 						A WordPress menu
	 */
	public function list_menu( $atts, $content = null ) {

		extract( shortcode_atts( array(
			'menu'            => '',
			'container'       => 'div',
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'menu',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'depth'           => 0,
			'walker'          => '',
			'theme_location'  => ''),
			$atts )
		);

		return wp_nav_menu( array(
			'menu'            => $menu,
			'container'       => $container,
			'container_class' => $container_class,
			'container_id'    => $container_id,
			'menu_class'      => $menu_class,
			'menu_id'         => $menu_id,
			'echo'            => false,
			'fallback_cb'     => $fallback_cb,
			'before'          => $before,
			'after'           => $after,
			'link_before'     => $link_before,
			'link_after'      => $link_after,
			'depth'           => $depth,
			'walker'          => $walker,
			'theme_location'  => $theme_location )
		);

	} // list_menu()

	/**
	 * Adds classes to the body tag.
	 *
	 * @hooked		body_class
	 * @global 		$post						The $post object
	 * @param 		array 		$classes 		Classes for the body element.
	 * @return 		array 						The modified body class array
	 */
	public function page_body_classes( $classes ) {

		global $post;

		if ( empty( $post->post_content ) ) {

			$classes[] = 'content-none';

		} else {

			$classes[] = $post->post_name;

		}

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {

			$classes[] = 'group-blog';

		}

		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {

			$classes[] = 'hfeed';

		}

		$tablet_menu = get_theme_mod( 'tablet_menu' );

		if ( ! empty( $tablet_menu ) ) {
			
			if ( FALSE !== strpos( $tablet_menu, '-slide-' ) ) {
				
				$classes[] = 'tablet-slide';
				
				if ( FALSE !== strpos( $tablet_menu, '-left' ) || FALSE !== strpos( $tablet_menu, '-right' ) ) {
					
					$classes[] = 'tablet-slide-sides';
					
				} elseif ( FALSE !== strpos( $tablet_menu, '-bottom' ) || FALSE !== strpos( $tablet_menu, '-top' ) ) {
					
					$classes[] = 'tablet-slide-topbot';					
					
				}
				
			} elseif ( FALSE !== strpos( $tablet_menu, '-push' ) ) {
				
				$classes[] = 'tablet-push';
				
			}
			
			$classes[] = $tablet_menu;

		}

		return $classes;

	} // page_body_classes()

	/**
	 * The content for each column cell
	 *
	 * @hooked		manage_page_posts_custom_column
	 * @param 		string 		$column_name 		The name of the column
	 * @param 		int 		$post_ID 			The post ID
	 * @return 		mixed 							The cell content
	 */
	public function page_template_column_content( $column_name, $post_ID ) {

		if ( 'page_template' !== $column_name ) { return; }

		$slug 		= get_page_template_slug( $post_ID );
		$templates 	= get_page_templates();
		$name 		= array_search( $slug, $templates );

		if ( ! empty( $name ) ) {

			echo '<span class="name-template">' . $name . '</span>';

		} else {

			echo '<span class="name-template">' . esc_html( 'Default', 'rosh' ) . '</span>';

		}

	} // page_template_column_content()

	/**
	 * Adds the page template column to the columns on the page listings
	 *
	 * @hooked 		manage_page_posts_columns
	 * @param 		array 		$defaults 			The current column names
	 * @return 		array           				The modified column names
	 */
	public function page_template_column_head( $defaults ) {

		$defaults['page_template'] = esc_html( 'Page Template', 'rosh' );

		 return $defaults;

	} // page_template_column_head()

	/**
	 * Removes query strings from static resources
	 * to increase Pingdom and GTMatrix scores.
	 *
	 * Does not remove query strings from Google Font calls.
	 *
	 * @hooked		style_loader_src
	 * @hooked 		script_loader_src
	 * @param 		string 		$src 			The resource URL
	 * @return 		string 						The modifed resource URL
	 */
	public function remove_cssjs_ver( $src ) {

		if ( empty( $src ) ) { return; }
		if ( strpos( $src, 'https://fonts.googleapis.com' ) ) { return; }

		if ( strpos( $src, '?ver=' ) ) {

			$src = remove_query_arg( 'ver', $src );

		}

		return $src;

	} // remove_cssjs_ver()

	/**
	 * Adds the video ID as the ID attribute on the iframe
	 *
	 * @hooked 		embed_oembed_html
	 * @param 		string 		$html 			The current oembed HTML
	 * @param 		string 		$url 			The oembed URL
	 * @param 		array 		$attr 			The oembed attributes
	 * @param 		int 		$post_id 		The post ID
	 * @return 		string 						The modified oembed HTML
	 */
	public function youtube_add_id_attribute( $html, $url, $attr, $post_id ) {

		$check = strpos( $url, 'youtu' );

		if ( ! $check ) { return $html; }

		if ( strpos( $url, 'watch?v=' ) > 0 ) {

			$id = explode( 'watch?v=', $url );

		} else {

			$id = explode( '.be/', $url );

		}

		$html = str_replace( 'allowfullscreen>', 'allowfullscreen id="video-' . $id[1] . '">', $html );

		return $html;

	} // youtube_add_id_attribute

} // class
