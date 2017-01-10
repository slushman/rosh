<?php

/**
 * A class of methods using hooks in the theme.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Themehooks {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'wp_head', 						array( $this, 'head_content' ), 1 );
		add_action( 'wp_head', 						array( $this, 'head_pingback' ), 2 );

		add_action( 'rosh_header_top', 				array( $this, 'header_wrap_start' ), 10 );
		add_action( 'rosh_header_top', 				array( $this, 'site_branding_begin' ), 15 );

		add_action( 'rosh_header_content', 			array( $this, 'title_site' ), 10 );
		add_action( 'rosh_header_content', 			array( $this, 'site_description' ), 15 );

		add_action( 'rosh_header_bottom', 			array( $this, 'site_branding_end' ), 85 );
		add_action( 'rosh_header_bottom', 			array( $this, 'header_wrap_end' ), 90 );
		add_action( 'rosh_header_bottom', 			array( $this, 'menu_primary' ), 95 );

		add_action( 'rosh_body_top', 				array( $this, 'analytics_code' ), 10 );
		add_action( 'rosh_body_top', 				array( $this, 'skip_link' ), 20 );

		add_action( 'rosh_main_before', 			array( $this, 'sidebar_content' ), 10 );

		add_action( 'rosh_while_before', 			array( $this, 'title_archive' ) );
		add_action( 'rosh_while_before', 			array( $this, 'title_single_post' ) );
		add_action( 'rosh_while_before', 			array( $this, 'title_search' ), 10 );

		add_action( 'rosh_content_top', 			array( $this, 'breadcrumbs' ) );

		add_action( 'rosh_entry_header_content', 	array( $this, 'title_entry' ), 10 );
		add_action( 'rosh_entry_header_content', 	array( $this, 'title_page' ), 10 );
		add_action( 'rosh_entry_header_content', 	array( $this, 'posted_on' ), 20 );

		add_action( 'rosh_entry_footer_content', 	array( $this, 'entry_categories_links' ), 10 );
		add_action( 'rosh_entry_footer_content', 	array( $this, 'entry_tags_links' ), 15 );
		add_action( 'rosh_entry_footer_content', 	array( $this, 'entry_comments_links' ), 20 );
		add_action( 'rosh_entry_footer_content', 	array( $this, 'entry_edit_link' ), 25 );

		add_action( 'rosh_entry_after', 			array( $this, 'authorbox' ), 5 );
		add_action( 'rosh_entry_after', 			array( $this, 'comments' ), 10 );

		add_action( 'rosh_while_after', 			array( $this, 'posts_nav' ) );

		add_action( 'rosh_main_after', 				array( $this, 'content_sidebar' ), 10 );

		add_action( 'rosh_404_header', 				array( $this, 'title_404' ), 10 );

		add_action( 'rosh_404_before', 				array( $this, 'four_04_message' ), 10 );

		add_action( 'rosh_404_content', 			array( $this, 'add_search' ), 10 );
		add_action( 'rosh_404_content', 			array( $this, 'four_04_posts_widget' ), 15 );
		add_action( 'rosh_404_content', 			array( $this, 'four_04_categories' ), 20 );
		add_action( 'rosh_404_content', 			array( $this, 'four_04_archives' ), 25 );
		add_action( 'rosh_404_content', 			array( $this, 'four_04_tag_cloud' ), 30 );

		add_action( 'rosh_footer_top', 				array( $this, 'footer_wrap_begin' ) );

		add_action( 'rosh_footer_content', 			array( $this, 'footer_content' ), 20 );
		add_action( 'rosh_footer_content', 			array( $this, 'menu_social' ), 20 );

		add_action( 'rosh_footer_bottom', 			array( $this, 'footer_wrap_end' ) );

	} // hooks()

	/**
	 * Adds a search form
	 *
	 * @hooked 		rosh_404_content 		15
	 * @return 		mixed 		Search form markup
	 */
	public function add_search() {

		get_search_form();

	} // add_search()

	/**
	 * Inserts Google Tag manager code after body tag.
	 *
	 * @exits 		tag_manager_id field is empty.
	 * @hooked 		rosh_body_top 		10
	 * @return 		mixed 				The Google Tag Manager code
	 */
	public function analytics_code() {

		$tag_id = get_theme_mod( 'tag_manager_id' );

		if ( empty( $tag_id ) ) { return; }

		echo '<!-- Google Tag Manager -->';
		echo '<noscript><iframe src="//www.googletagmanager.com/ns.html?id=' . $tag_id . '?>"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({\'gtm.start\':
new Date().getTime(),event:\'gtm.js\'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!=\'dataLayer\'?\'&l=\'+l:\'\';j.async=true;j.src=
\'//www.googletagmanager.com/gtm.js?id=\'+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,\'script\',\'dataLayer\',\'' . $tag_id . '\');</script>';
		echo '<!-- Google Tag Manager -->';

	} // analytics_code()

	/**
	 * Adds the authorbox action hook.
	 *
	 * @hooked 		rosh_entry_after 		5
	 */
	public function authorbox() {

		global $authordata;

		/**
		 * The rosh_authorbox action hook.
		 * See the class-authorbox.php file for hooked functions.
		 *
		 * @hooked 		wrap_begin 		5
		 * @hooked 		avatar 			15
		 * @hooked 		name 			25
		 * @hooked 		bio 			35
		 * @hooked 		posts_link 		45
		 * @hooked 		social_links 	55
		 * @hooked 		wrap_end 		95
		 * @param 		obj 			$authordata 		The current author's DB object.
		 */
		do_action( 'rosh_authorbox', $authordata );

	} // authorbox()

	/**
	 * Returns the appropriate breadcrumbs.
	 *
	 * @exits 		On the front page.
	 * @hooked		rosh_wrap_content
	 * @return 		mixed 				WooCommerce breadcrumbs, then Yoast breadcrumbs
	 */
	public function breadcrumbs() {

		if ( is_front_page() ) { return; }

		?><div class="breadcrumbs">
			<div class="wrap-crumbs"><?php

				if ( function_exists( 'woocommerce_breadcrumb' ) ) {

					$args['after'] 			= '</span>';
					$args['before'] 		= '<span rel="v:child" typeof="v:Breadcrumb">';
					$args['delimiter'] 		= '&nbsp;>&nbsp;';
					$args['home'] 			= esc_html_x( 'Home', 'breadcrumb', 'rosh' );
					$args['wrap_after'] 	= '</span></span></nav>';
					$args['wrap_before'] 	= '<nav class="woocommerce-breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '><span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';

					woocommerce_breadcrumb( $args );

				} elseif ( function_exists( 'yoast_breadcrumb' ) ) {

					yoast_breadcrumb();

				}

			?></div><!-- .wrap-crumbs -->
		</div><!-- .breadcrumbs --><?php

	} // breadcrumbs()

	/**
	 * The comments markup
	 *
	 * If comments are open or we have at least one comment, load up the comment template.
	 *
	 * @exits 		Comments closed.
	 * @exits 		There are no comments.
	 * @hooked 		rosh_entry_after 		10
	 * @return 		mixed 					The comments markup
	 */
	public function comments() {

		if ( ! comments_open() || get_comments_number() <= 0 ) { return; }

		comments_template();

	} // comments()

	/**
	 * Returns the sidebar markup.
	 *
	 * Hooked at rosh_main_after:
	 *		404.php
	 * 		archive.php
	 * 		index.php
	 * 		page_content-sidebar.php
	 * 		search.php
	 *  	single.php
	 *
	 * @exits 		If its a page.
	 * @hooked 		rosh_main_after 		10
	 * @return 		mixed 					The sidebar markup.
	 */
	public function content_sidebar() {

		if ( is_page() && ! is_page_template( 'templates/page_content-sidebar.php' ) ) { return; }

		get_sidebar();

	} // content_sidebar()

	/**
	 * Displays the entry category links.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @return 		mixed 		Entry categories markup.
	 */
	public function entry_categories_links() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'rosh' ) );
		if ( $categories_list && rosh_categorized_blog() ) {

			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'rosh' ) . '</span>', $categories_list );  // WPCS: XSS OK.

		}

	} // entry_categories_links()

	/**
	 * Displays the entry comments links.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @exits 		If its a single post, its password protected, and either the comments aren't open or there aren't comments.
	 * @return 		mixed 		Entry comments markup.
	 */
	public function entry_comments_links() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }
		if ( ! is_single() ) { return; }
		if ( post_password_required() ) { return; }
		if ( ! comments_open() || ! get_comments_number() ) { return; }

		?><span class="comments-link"><?php

		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'rosh' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) ); // translators: %s: post title

		?></span><?php

	} // entry_comments_links()

	/**
	 * Displays the entry edit link.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @return 		mixed 		Entry comments markup.
	 */
	public function entry_edit_link() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }

		edit_post_link( esc_html__( 'Edit', 'rosh' ), '<span class="edit-link">', '</span>' );

	} // entry_edit_link()

	/**
	 * Displays the entry tags links.
	 *
	 * @exits 		If its a page.
	 * @exits 		If its not the 'post' post type.
	 * @exits 		If the tags list is empty.
	 * @return 		mixed 		Entry tags markup.
	 */
	public function entry_tags_links() {

		if ( is_page() ) { return; }
		if ( 'post' !== get_post_type() ) { return; }

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'rosh' ) );

		if ( empty( $tags_list ) ) { return; }

		printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'rosh' ) . '</span>', $tags_list );  // WPCS: XSS OK.

	} // entry_tags_links()

	/**
	 * Adds the copyright and credits to the footer content.
	 *
	 * @hooked 		rosh_footer_content
	 * @return 		mixed 									The footer markup
	 */
	public function footer_content() {

		?><div class="site-info">
			<div class="copyright">&copy; <?php echo date( 'Y' ); ?> <a href="<?php echo esc_url( get_admin_url() ); ?>"><?php echo get_bloginfo( 'name' ); ?></a></div>
			<div class="credits"><?php printf( esc_html__( 'Site created by %1$s', 'rosh' ), '<a href="https://dccmarketing.com/" rel="nofollow noopener" target="_blank">DCC</a>' ); ?></div>
		</div><!-- .site-info --><?php

	} // footer_content()

	/**
	 * Adds the opening wrapper tag.
	 *
	 * @hooked 		rosh_footer_top
	 * @return 		mixed 		The opening wrapper tag
	 */
	public function footer_wrap_begin() {

		?><div class="wrap-footer"><?php

	} // footer_wrap_begin()

	/**
	 * Adds the closing wrapper tag.
	 *
	 * @hooked 		rosh_footer_bottom
	 * @return 		mixed 		The closing wrapper tag
	 */
	public function footer_wrap_end() {

		?></div><!-- wrap-footer --><?php

	} // footer_wrap_end()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		Not on 404 page.
	 * @hooked 		rosh_404_content		25
	 * @return 		mixed 					Markup for the archives
	 */
	public function four_04_archives() {

		if ( ! is_404() ) { return; }

		/* translators: %1$s: smiley */
		$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'rosh' ), convert_smilies( ':)' ) ) . '</p>';

		the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );

	} // four_04_archives()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		Not on 404 page.
	 * @hooked 		rosh_404_content		20
	 * @return 		mixed 					The categories widget
	 */
	public function four_04_categories() {

		if ( ! is_404() ) { return; }
		if ( ! rosh_categorized_blog() ) { return; }

		?><div class="widget widget_categories">
			<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'rosh' ); ?></h2>
			<ul><?php

				wp_list_categories( array(
					'orderby'    => 'count',
					'order'      => 'DESC',
					'show_count' => 1,
					'title_li'   => '',
					'number'     => 10,
				) );

			?></ul>
		</div><!-- .widget --><?php

	} // four_04_categories()

	/**
	 * Adds the Recent Posts widget to the 404 page.
	 *
	 * @exits 		Not on 404 page.
	 * @hooked 		rosh_404_before 		10
	 * @return 		mixed 					The 404 message markup.
	 */
	public function four_04_message() {

		if ( ! is_404() ) { return; }

		?><p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'rosh' ); ?></p><?php

	} // four_04_message()

	/**
	 * Adds the Recent Posts widget to the 404 page.
	 *
	 * @exits 		Not on 404 page.
	 * @hooked 		rosh_404_content 		15
	 * @return 		mixed 					The Recent Posts widget
	 */
	public function four_04_posts_widget() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Recent_Posts' );

	} // four_04_posts_widget()

	/**
	 * Adds the  to the 404 page content.
	 *
	 * @exits 		Not on 404 page.
	 * @hooked 		rosh_404_content		30
	 * @return 		mixed 					The tag cloud widget
	 */
	public function four_04_tag_cloud() {

		if ( ! is_404() ) { return; }

		the_widget( 'WP_Widget_Tag_Cloud' );

	} // four_04_tag_cloud()

	/**
	 * Adds default meta tags in the head.
	 *
	 * @hooked 		wp_head 			10
	 * @return 		mixed 				The default meta tags markup.
	 */
	public function head_content() {

		?><meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

	} // head_content()
	
	/**
	 * Adds pingback headers.
	 *
	 * @exits 		If not singular
	 * @exits 		If pings are not open.
	 * @hooked 		wp_head 			10
	 * @return 		mixed 				The default meta tags markup.
	 */
	public function head_pingback() {
		
		if ( ! is_singular() || ! pings_open() ) { return; }

		?><link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

	} // head_pingback()

	/**
	 * The header wrap markup
	 *
	 * @hooked  	rosh_header_bottom 		90
	 * @return 		mixed 					The header wrap markup
	 */
	public function header_wrap_end() {

		?></div><!-- .wrap-header --><?php

	} // header_wrap_end()

	/**
	 * The header wrap markup
	 *
	 * @hooked 		rosh_header_top 		10
	 * @return 		mixed 				The header wrap markup
	 */
	public function header_wrap_start() {

		?><div class="wrap-header"><?php

	} // header_wrap_start()

	/**
	 * Adds the primary menu
	 *
	 * @hooked 		rosh_header_bottom 		95
	 * @return 		mixed 					The primary menu markup
	 */
	public function menu_primary() {

		?><nav id="site-navigation" class="nav-1" role="navigation">
			<button class="menu-1-toggle" aria-controls="menu-1" aria-expanded="false"><?php esc_html_e( 'Menu', 'rosh' ); ?></button><?php

				$menu_args['menu_id'] 			= 'menu-1';
				$menu_args['container'] 		= false;
				$menu_args['container_class'] 	= 'menu-1-wrap';
				$menu_args['items_wrap'] 		= '<ul id="%1$s" class="%2$s"><button class="close-tablet-menu-btn"><span class="close-btn-text">Close Menu</span></button>%3$s</ul>';
				$menu_args['menu_class']      	= 'menu-1-items menu-1-items-0';
				$menu_args['theme_location'] 	= 'menu-1';
				$menu_args['walker']  			= new Rosh_Walker();

				wp_nav_menu( $menu_args );

		?></nav><!-- #site-navigation --><?php

	} // menu_primary()

	/**
	 * Adds the primary menu
	 *
	 * @exits 		Menu not active.
	 * @hooked 		rosh_header_bottom 		65
	 * @return 		mixed 					The social links menu markup
	 */
	public function menu_social() {

		if ( ! has_nav_menu( 'social' ) ) { return; }

		$menu_args['theme_location']	= 'social';
		$menu_args['container'] 		= false;
		$menu_args['menu_id']         	= 'social-menu';
		$menu_args['menu_class']      	= 'social-menu-items social-menu-items-0';
		$menu_args['depth']           	= 1;
		$menu_args['walker']  			= new Rosh_Walker();

		wp_nav_menu( $menu_args );

	} // menu_social()

	/**
	 * Adds the posted_on post meta.
	 *
	 * @exits 		Not on post type page.
	 * @exits 		Not on search page.
	 * @hooked 		entry_header_content
	 * @return 		mixed 			The posted_on post meta.
	 */
	public function posted_on() {

		if ( 'post' != get_post_type() ) { return; }
		if ( ! is_search() ) { return; }

		?><div class="entry-meta"><?php

			$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}

			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);

			$posted_on = sprintf(
				esc_html_x( 'Posted on %s', 'post date', 'rosh' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);

			$byline = sprintf(
				esc_html_x( 'by %s', 'post author', 'rosh' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);

			?><span class="posted-on"><?php echo $posted_on; ?></span><span class="byline"> <?php echo $byline; ?></span>
		</div><!-- .entry-meta --><?php

	} // posted_on()

	/**
	 * Adds the post navigation to the archive pages
	 *
	 * @exits 		Not on posts home.
	 * @exits 		Not on archive page.
	 * @hooked 		rosh_while_after
	 * @return 		mixed 							The posts navigation
	 */
	public function posts_nav() {

		if ( ! is_home() || ! is_archive() ) { return; }

		the_posts_navigation();

	} // posts_nav()

	/**
	 * Returns the sidebar markup.
	 *
	 * @exits 		If its not the sidebar-content template.
	 * @hooked 		rosh_main_before 		10
	 * @return 		mixed 					The sidebar markup.
	 */
	public function sidebar_content() {

		if ( ! is_page_template( 'templates/page_sidebar-content.php' ) ) { return; }

		get_sidebar();

	} // sidebar_content()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		rosh_header_top				15
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_begin() {

		?><div class="site-branding"><?php

	} // site_branding_begin()

	/**
	 * Adds the starting site branding markup
	 *
	 * @hooked 		rosh_header_bottom			85
	 * @return 		mixed 						HTML markup
	 */
	public function site_branding_end() {

		?></div><!-- .site-branding --><?php

	} // site_branding_end()

	/**
	 * Adds the site description markup
	 *
	 * @hooked 		rosh_header_content 		15
	 * @return 		mixed 								The site description markup
	 */
	public function site_description() {

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) {

			?><p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p><?php

		}

	} // site_description()

	/**
	 * Adds the a11y skip link markup
	 *
	 * @hooked 		rosh_body_top 		20
	 * @return 		mixed 				Skip link markup
	 */
	public function skip_link() {

		?><a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'rosh' ); ?></a><?php

	} // skip_link()

	/**
	 * Returns the page title
	 *
	 * @exits 		If its not the 404 page.
	 * @hooked 		rosh_404_header 		10
	 * @return 		mixed 					The 404 page title
	 */
	public function title_404() {

		if ( ! is_404() ) { return; }

		?><h1 class="page-title"><?php

			esc_html_e( 'Oops! That page can&rsquo;t be found.', 'rosh' );

		?></h1><?php

	} // title_404()

	/**
	 * Adds the page title to an archive page
	 *
	 * @exits 		Not on archive page.
	 * @hooked 		rosh_while_before
	 * @return 		mixed 							The archive page title
	 */
	public function title_archive() {

		if ( ! is_archive() ) { return; }

		?><header class="page-header"><?php

			the_archive_title( '<h1 class="page-title">', '</h1>' );
			the_archive_description( '<div class="archive-description">', '</div>' );

		?></header><!-- .page-header --><?php

	} // title_archive()

	/**
	 * Returns the entry title
	 *
	 * @exits 		On static front page.
	 * @exits 		On a static page.
	 * @hooked 		entry_header_content 			10
	 * @return 		mixed 							The entry title
	 */
	public function title_entry() {

		if ( is_front_page() && ! is_home() ) { return; }
		if ( is_page() ) { return; }

		if ( is_single() ) {

			the_title( '<h1 class="entry-title">', '</h1>' );

		} else {

			the_title( sprintf( '<h2 class="entry-title"><a class="archive-entry-link" href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );

		}

	} // title_entry()

	/**
	 * Returns the page title
	 *
	 * @exits 		On the front page.
	 * @exits 		On posts home.
	 * @exits 		Not on a page.
	 * @hooked 		rosh_while_before 		10
	 * @return 		mixed 							The entry title
	 */
	public function title_page() {

		if ( is_front_page() || is_home() ) { return; }
		if ( ! is_page() ) { return; }

		the_title( '<h1 class="page-title">', '</h1>' );

	} // title_page()

	/**
	 * The search title markup
	 *
	 * @exits 		Not on a search page.
	 * @hooked 		rosh_while_before
	 * @return 		mixed 							Search title markup
	 */
	public function title_search() {

		if ( ! is_search() ) { return; }

		?><header class="page-header">
			<h1 class="page-title"><?php

				printf( esc_html__( 'Search Results for: %s', 'rosh' ), '<span>' . get_search_query() . '</span>' );

			?></h1>
		</header><!-- .page-header --><?php

	} // title_search()

	/**
	 * Adds the single post title to the index
	 *
	 * @exits 		On static front page
	 * @hooked 		rosh_while_before
	 * @return 		mixed 							The single post title
	 */
	public function title_single_post() {

		if ( ! is_home() && is_front_page() ) { return; }
		if ( ! is_archive() ) { return; }

		?><header>
			<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
		</header><?php

	} // title_single_post()

	/**
	 * Adds the site title markup
	 *
	 * @exits 		get_custom_logo doesn't exist
	 * @exits 		get_custom_logo is empty
	 * @hooked 		rosh_header_content 		10
	 * @return 		mixed 								The site title markup
	 */
	public function title_site() {

		if ( ! function_exists( 'get_custom_logo' ) ) { return; }

		$logo = get_custom_logo();

		if ( is_front_page() || is_home() && ! empty( $logo ) ) {

			?><h1 class="site-title"><?php echo $logo; ?></h1><?php

		} elseif ( ! is_front_page() && ! is_home() && ! empty( $logo ) ) {

			?><p class="site-title"><?php echo $logo; ?></p><?php

		} elseif ( is_front_page() || is_home() ) {

			?><h1 class="site-title">
				<a class="site-title-link" href="<?php

					echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' );

				?></a>
			</h1><?php

		} else {

			?><p class="site-title">
				<a class="site-title-link" href="<?php

					echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' );

				?></a>
			</p><?php

		}

	} // title_site()

} // class
