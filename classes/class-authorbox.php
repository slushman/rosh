<?php

/**
 * A class of methods for displaying an author information.
 *
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Authorbox {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'rosh_authorbox', array( $this, 'wrap_begin' ), 5, 1 );
		add_action( 'rosh_authorbox', array( $this, 'avatar' ), 15, 1 );
		add_action( 'rosh_authorbox', array( $this, 'name' ), 25, 1 );
		add_action( 'rosh_authorbox', array( $this, 'bio' ), 35, 1 );
		add_action( 'rosh_authorbox', array( $this, 'posts_link' ), 45, 1 );
		add_action( 'rosh_authorbox', array( $this, 'social_links' ), 55, 1 );
		add_action( 'rosh_authorbox', array( $this, 'wrap_end' ), 95, 1 );

	} // hooks()

	/**
	 * Displays the author's headshot or avatar.
	 *
	 * @exits 		If $authordata is not an object.
	 * @param 		obj 		$authordata 		The current author's DB object.
	 */
	public function avatar( $authordata ) {

		if ( ! is_object( $authordata ) ) { return FALSE; }

		?><div class="authorbox-avatar"><?php

			/**
			 * The rosh_authorbox_avatar_size filter.
			 * @var 	int 		The avatar size.
			 */
			$size = apply_filters( 'rosh_authorbox_avatar_size', 75 );

			/**
			 * The rosh_authorbox_default_avatar filter.
			 * @var 	string 		The default avatar image.
			 */
			$img = apply_filters( 'rosh_authorbox_default_avatar', '' );

			/**
			 * The rosh_authorbox_avatar_alttext filter.
			 * @var 	string 		The alt text for the avatar.
			 */
			$alt = apply_filters( 'rosh_authorbox_avatar_alttext', $authordata->nickname );

			/**
			 * The rosh_authorbox_avatar_args filter.
			 * @var [type]
			 */
			$avatar_args['class'] 		= 'authorbox-avatar-img';
			 $avatar_args['extra_attr'] 	= 'itemprop="image"';
			$args 						= apply_filters( 'rosh_authorbox_avatar_args', $avatar_args );

			echo get_avatar( $authordata->ID, $size, $img, $alt, $args );

		?></div><!-- .authorbox-avatar --><?php

	} // avatar()

	/**
	 * Displays the author's bio.
	 *
	 * @exits 		If $authordata is not an object.
	 * @param 		obj 		$authordata 		The current author's DB object.
	 */
	public function bio( $authordata ) {

		if ( ! is_object( $authordata ) ) { return FALSE; }

		?><div class="authorbox-bio" itemprop="description"><?php

			echo wp_kses( $authordata->description, null );

		?></div><!-- .authorbox-bio --><?php

	} // bio()

	/**
	 * Returns the list of social network fields from the
	 * user profile.
	 *
	 * @return 		array 		The social network field values.
	 */
	protected function get_socials_list() {

		$socials['facebook'] 	= __( 'Facebook', 'rosh' );
		$socials['twitter'] 	= __( 'Twitter', 'rosh' );
		$socials['googleplus'] 	= __( 'Google Plus', 'rosh' );
		$socials['linkedin'] 	= __( 'LinkedIn', 'rosh' );
		$socials['youtube'] 	= __( 'YouTube', 'rosh' );
		$socials['videmo'] 		= __( 'Vimeo', 'rosh' );
		$socials['wordpress'] 	= __( 'WordPress', 'rosh' );
		$socials['pinterest'] 	= __( 'Pinterest', 'rosh' );
		$socials['instagram'] 	= __( 'Instagram', 'rosh' );

		/**
		 * The rosh_authorbox_socials filter.
		 * @var 		array 		$socials
		 */
		$socials = apply_filters( 'rosh_authorbox_socials', $socials );

		return $socials;

	} // get_socials_list()

	/**
	 * Displays the author's name.
	 *
	 * @exits 		If $authordata is not an object.
	 * @param 		obj 		$authordata 		The current author's DB object.
	 */
	public function name( $authordata ) {

		if ( ! is_object( $authordata ) ) { return FALSE; }

		?><div class="authorbox-name" itemprop="name"><?php

			if ( empty( $authordata->user_url ) ) {

				echo esc_html( $authordata->user_nicename );

			} else {

				?><a href="<?php echo esc_url( $authordata->user_url ); ?>" itemprop="url"><?php

					echo esc_html( $authordata->user_nicename );

				?></a><?php

			}

		?></div><?php

	} // name()

	/**
	 * Displays a link to the author's other posts.
	 *
	 * @exits 		If $authordata is not an object.
	 * @param 		obj 		$authordata 		The current author's DB object.
	 */
	public function posts_link( $authordata ) {

		if ( ! is_object( $authordata ) ) { return FALSE; }

		?><a class="authorbox-postslink" href="<?php echo esc_url( get_author_posts_url( $authordata->ID ) ); ?>" rel="author"><?php

			printf(

				/**
				 * The rosh_authorbox_moreposts_text filter.
				 * @var 		string 			The "more posts by" text for the authorbox.
				 */
				apply_filters( 'rosh_authorbox_moreposts_text', __( 'More posts by %s', 'rosh' ) ),
				$authordata->user_nicename
			);

		?></a><?php

	} // posts_link()

	/**
	 * Displays a social link.
	 *
	 * @exits 		If $authordata is not an object.
	 * @exits 		If the social link field is empty.
	 * @exits 		If $social is empty.
	 * @param 		obj 		$authordata 		The current author's DB object.
	 * @param 		string 		$key	 			The array key for the social link.
	 * @param 		string 		$social 			The social link data.
	 */
	public function social_link( $authordata, $key, $social ) {

		if ( ! is_object( $authordata ) ) { return FALSE; }
		if ( empty( $authordata->$key ) ) { return FALSE; }
		if ( empty( $social ) ) { return FALSE; }

		?><li class="authorbox-social">
			<a class="authorbox-social-link" href="<?php echo esc_url( $authordata->$key ); ?>" itemprop="url"><?php

				rosh_the_svg( $key );

				echo esc_html( $social, 'rosh' );

			?></a>
		</li><?php

	} // social_link()

	/**
	 * Displays the author's social links.
	 *
	 * @exits 		If $authordata is not an object.
	 * @exits 		If the $socials array is empty.
	 * @param 		obj 		$authordata 		The current author's DB object.
	 */
	public function social_links( $authordata ) {

		if ( ! is_object( $authordata ) ) { return FALSE; }

		$socials = $this->get_socials_list();

		if ( empty( $socials ) ) { return FALSE; }

		?><ul class="authorbox-socials"><?php

			foreach ( $socials as $key => $social ) {

				$this->social_link( $authordata, $key, $social );

			}

		?></ul><?php

	} // social_links()

	/**
	 * Displays the beginning wrap markup.
	 */
	public function wrap_begin() {

		?><div class="wrap-authorbox" itemscope itemtype="https://schema.org/Person"><?php

	} // wrap_begin()

	/**
	 * Displays the ending wrap markup.
	 */
	public function wrap_end() {

		?></div><!-- .wrap-authorbox --><?php

	} // wrap_end()

} // class
