<?php

/**
 * Rosh Customizer
 *
 * Contains methods for customizing the theme customization screen.
 *
 * @link 			https://developer.wordpress.org/themes/customize-api/
 * @since 			1.0.0
 * @package 		Rosh
 * @subpackage 		Rosh/classes
 */
class Rosh_Customizer {

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Registers all the WordPress hooks and filters for this class.
	 */
	public function hooks() {

		add_action( 'customize_register', 	array( $this, 'register_panels' ) );
		add_action( 'customize_register', 	array( $this, 'register_sections' ) );
		add_action( 'customize_register', 	array( $this, 'register_fields' ) );
		add_action( 'customize_register', 	array( $this, 'selective_refresh' ) );
		add_action( 'wp_head', 				array( $this, 'header_output' ) );
		add_action( 'customize_register', 	array( $this, 'load_customize_controls' ), 0 );

	} // hooks()

	/**
	 * Registers custom panels for the Customizer
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_panels( $wp_customize ) {

		// Register panels here

	} // register_panels()

	/**
	 * Registers custom sections for the Customizer
	 *
	 * Existing sections:
	 *
	 * Slug 				Priority 		Title
	 *
	 * title_tagline 		20 				Site Identity
	 * colors 				40				Colors
	 * header_image 		60				Header Image
	 * background_image 	80				Background Image
	 * nav_menus			100 			Navigation
	 * widgets 				110 			Widgets
	 * static_front_page 	120 			Static Front Page
	 * default 				160 			all others
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_sections( $wp_customize ) {

		// Tablet Menu Section
		$wp_customize->add_section( 'tablet_menu',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'rosh' ),
				'panel' 			=> 'nav_menus',
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Tablet Menu Style', 'rosh' ),
			)
		);

		// Images Section
		$wp_customize->add_section( 'images',
			array(
				'active_callback' 	=> '',
				'capability'  		=> 'edit_theme_options',
				'description'  		=> esc_html__( '', 'rosh' ),
				'panel' 			=> '',
				'priority'  		=> 10,
				'theme_supports'  	=> '',
				'title'  			=> esc_html__( 'Images', 'rosh' ),
			)
		);

	} // register_sections()

	/**
	 * Registers controls/fields for the Customizer
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * Note: To use active_callbacks, don't add these to the selecting control, it apepars these conflict:
	 * 		'transport' => 'postMessage'
	 * 		$wp_customize->get_setting( 'field_name' )->transport = 'postMessage';
	 *
	 * @hooked 		customize_register
	 * @see			add_action( 'customize_register', $func )
	 * @link 		http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
	 * @since 		1.0.0
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function register_fields( $wp_customize ) {

		// Enable live preview JS for default fields
		$wp_customize->get_setting( 'blogname' )->transport 		= 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport 	= 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';



		// Site Identity Section Fields

		// Google Tag Manager ID Field
		$wp_customize->add_setting(
			'tag_manager_id',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'tag_manager_id',
			array(
				'active_callback' 	=> '',
				'description' 		=> esc_html__( 'Enter the Google Tag Manager container ID.', 'rosh' ),
				'label'  			=> esc_html__( 'Google Tag Manager ID', 'rosh' ),
				'priority' 			=> 10,
				'section'  			=> 'title_tagline',
				'settings' 			=> 'tag_manager_id',
				'type' 				=> 'text'
			)
		);
		$wp_customize->get_setting( 'tag_manager_id' )->transport = 'postMessage';


		// Tablet Menu Field
		$wp_customize->add_setting(
			'tablet_menu',
			array(
				'capability' 		=> 'edit_theme_options',
				'default'  			=> '',
				'sanitize_callback' => 'sanitize_text_field',
				'transport' 		=> 'postMessage',
				'type' 				=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			'tablet_menu',
			array(
				'active_callback' 	=> '',
				'choices' 			=> array(
					'tablet-slide-ontop-from-left' 		=> esc_html__( 'Slide On Top from Left', 'rosh' ),
					'tablet-slide-ontop-from-right' 	=> esc_html__( 'Slide On Top from Right', 'rosh' ),
					'tablet-slide-ontop-from-top' 		=> esc_html__( 'Slide On Top from Top', 'rosh' ),
					'tablet-slide-ontop-from-bottom' 	=> esc_html__( 'Slide On Top from Bottom', 'rosh' ),
					'tablet-push-from-left' 			=> esc_html__( 'Push In from Left', 'rosh' ),
					'tablet-push-from-right' 			=> esc_html__( 'Push In from Right', 'rosh' ),
				),
				'description' 		=> esc_html__( 'Select how the tablet menu appears.', 'rosh' ),
				'label'  			=> esc_html__( 'Tablet Menu', 'rosh' ),
				'priority' 			=> 10,
				'section'  			=> 'tablet_menu',
				'settings' 			=> 'tablet_menu',
				'type' 				=> 'select'
			)
		);
		$wp_customize->get_setting( 'tablet_menu' )->transport = 'postMessage';



		// Images Fields

		// Default Featured Image Field
		$wp_customize->add_setting(
			'default_featured_image' ,
			array(
				'capability' 			=> 'edit_theme_options',
				'default'  				=> '',
				'sanitize_callback' 	=> 'esc_url_raw',
				'transport' 			=> 'postMessage',
				'type' 					=> 'theme_mod'
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				'default_featured_image',
				array(
					'active_callback' 	=> '',
					'description' 		=> esc_html__( '', 'rosh' ),
					'label' 			=> esc_html__( 'Default Featured Image', 'rosh' ),
					'priority' 			=> 10,
					'section' 			=> 'images',
					'settings' 			=> 'default_featured_image'
				)
			)
		);





		// Register more fields here.

	} // register_fields()

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @access 		public
	 * @since 		1.0.0
	 * @see 		header_output()
	 * @param 		string 		$selector 		CSS selector
	 * @param 		string 		$style 			The name of the CSS *property* to modify
	 * @param 		string 		$mod_name 		The name of the 'theme_mod' option to fetch
	 * @param 		string 		$prefix 		Optional. Anything that needs to be output before the CSS property
	 * @param 		string 		$postfix 		Optional. Anything that needs to be output after the CSS property
	 * @param 		bool 		$echo 			Optional. Whether to print directly to the page (default: true).
	 * @return 		string 						Returns a single line of CSS with selectors and a property.
	 */
	public function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {

		$return = '';
		$mod 	= get_theme_mod( $mod_name );

		if ( empty( $mod ) ) { return; }

		$return = sprintf('%s { %s:%s; }',
			$selector,
			$style,
			$prefix . $mod . $postfix
		);

		if ( $echo ) {

			echo $return;
			return;

		}

		return $return;

	} // generate_css()

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * @hooked 		wp_head
	 * @access 		public
	 * @see 		add_action( 'wp_head', $func )
	 * @since 		1.0.0
	 */
	public function header_output() {

		?><!-- Customizer CSS -->
		<style type="text/css"><?php

			// pattern:
			// $this->generate_css( 'selector', 'style', 'mod_name', 'prefix', 'postfix', true );
			//
			// background-image example:
			// $this->generate_css( '.class', 'background-image', 'background_image_example', 'url(', ')' );

		?></style><!-- Customizer CSS --><?php

		/**
		 * Hides all but the first Soliloquy slide while using Customizer previewer.
		 */
		if ( is_customize_preview() ) {

			?><style type="text/css">

				li.soliloquy-item:not(:first-child) {
					display: none !important;
				}

			</style><!-- Customizer CSS --><?php

		}

	} // header_output()

	/**
	 * Returns TRUE based on which link type is selected, otherwise FALSE
	 *
	 * @param 	object 		$control 			The control object
	 * @return 	bool 							TRUE if conditions are met, otherwise FALSE
	 */
	public function states_of_country_callback( $control ) {

		$country_setting = $control->manager->get_setting('country')->value();

		if ( 'us_state' === $control->id && 'US' === $country_setting ) { return true; }
		if ( 'canada_state' === $control->id && 'CA' === $country_setting ) { return true; }
		if ( 'australia_state' === $control->id && 'AU' === $country_setting ) { return true; }
		if ( 'default_state' === $control->id && ! $this->custom_countries( $country_setting ) ) { return true; }

		return false;

	} // states_of_country_callback()

	/**
	 * Returns true if a country has a custom select menu
	 *
	 * @param 		string 		$country 			The country code to check
	 * @return 		bool 							TRUE if the code is in the array, FALSE otherwise
	 */
	public function custom_countries( $country ) {

		$countries = array( 'US', 'CA', 'AU' );

		return in_array( $country, $countries );

	} // custom_countries()

	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 * @return 		array|string 				Array of countries or a single country name
	 */
	public function country_list( $country = '' ) {

		$countries = array();

		$countries['AF'] = esc_html__( 'Afghanistan (‫افغانستان‬‎)', 'rosh' );
		$countries['AX'] = esc_html__( 'Åland Islands (Åland)', 'rosh' );
		$countries['AL'] = esc_html__( 'Albania (Shqipëri)', 'rosh' );
		$countries['DZ'] = esc_html__( 'Algeria (‫الجزائر‬‎)', 'rosh' );
		$countries['AS'] = esc_html__( 'American Samoa', 'rosh' );
		$countries['AD'] = esc_html__( 'Andorra', 'rosh' );
		$countries['AO'] = esc_html__( 'Angola', 'rosh' );
		$countries['AI'] = esc_html__( 'Anguilla', 'rosh' );
		$countries['AQ'] = esc_html__( 'Antarctica', 'rosh' );
		$countries['AG'] = esc_html__( 'Antigua and Barbuda', 'rosh' );
		$countries['AR'] = esc_html__( 'Argentina', 'rosh' );
		$countries['AM'] = esc_html__( 'Armenia (Հայաստան)', 'rosh' );
		$countries['AW'] = esc_html__( 'Aruba', 'rosh' );
		$countries['AC'] = esc_html__( 'Ascension Island', 'rosh' );
		$countries['AU'] = esc_html__( 'Australia', 'rosh' );
		$countries['AT'] = esc_html__( 'Austria (Österreich)', 'rosh' );
		$countries['AZ'] = esc_html__( 'Azerbaijan (Azərbaycan)', 'rosh' );
		$countries['BS'] = esc_html__( 'Bahamas', 'rosh' );
		$countries['BH'] = esc_html__( 'Bahrain (‫البحرين‬‎)', 'rosh' );
		$countries['BD'] = esc_html__( 'Bangladesh (বাংলাদেশ)', 'rosh' );
		$countries['BB'] = esc_html__( 'Barbados', 'rosh' );
		$countries['BY'] = esc_html__( 'Belarus (Беларусь)', 'rosh' );
		$countries['BE'] = esc_html__( 'Belgium (België)', 'rosh' );
		$countries['BZ'] = esc_html__( 'Belize', 'rosh' );
		$countries['BJ'] = esc_html__( 'Benin (Bénin)', 'rosh' );
		$countries['BM'] = esc_html__( 'Bermuda', 'rosh' );
		$countries['BT'] = esc_html__( 'Bhutan (འབྲུག)', 'rosh' );
		$countries['BO'] = esc_html__( 'Bolivia', 'rosh' );
		$countries['BA'] = esc_html__( 'Bosnia and Herzegovina (Босна и Херцеговина)', 'rosh' );
		$countries['BW'] = esc_html__( 'Botswana', 'rosh' );
		$countries['BV'] = esc_html__( 'Bouvet Island', 'rosh' );
		$countries['BR'] = esc_html__( 'Brazil (Brasil)', 'rosh' );
		$countries['IO'] = esc_html__( 'British Indian Ocean Territory', 'rosh' );
		$countries['VG'] = esc_html__( 'British Virgin Islands', 'rosh' );
		$countries['BN'] = esc_html__( 'Brunei', 'rosh' );
		$countries['BG'] = esc_html__( 'Bulgaria (България)', 'rosh' );
		$countries['BF'] = esc_html__( 'Burkina Faso', 'rosh' );
		$countries['BI'] = esc_html__( 'Burundi (Uburundi)', 'rosh' );
		$countries['KH'] = esc_html__( 'Cambodia (កម្ពុជា)', 'rosh' );
		$countries['CM'] = esc_html__( 'Cameroon (Cameroun)', 'rosh' );
		$countries['CA'] = esc_html__( 'Canada', 'rosh' );
		$countries['IC'] = esc_html__( 'Canary Islands (islas Canarias)', 'rosh' );
		$countries['CV'] = esc_html__( 'Cape Verde (Kabu Verdi)', 'rosh' );
		$countries['BQ'] = esc_html__( 'Caribbean Netherlands', 'rosh' );
		$countries['KY'] = esc_html__( 'Cayman Islands', 'rosh' );
		$countries['CF'] = esc_html__( 'Central African Republic (République centrafricaine)', 'rosh' );
		$countries['EA'] = esc_html__( 'Ceuta and Melilla (Ceuta y Melilla)', 'rosh' );
		$countries['TD'] = esc_html__( 'Chad (Tchad)', 'rosh' );
		$countries['CL'] = esc_html__( 'Chile', 'rosh' );
		$countries['CN'] = esc_html__( 'China (中国)', 'rosh' );
		$countries['CX'] = esc_html__( 'Christmas Island', 'rosh' );
		$countries['CP'] = esc_html__( 'Clipperton Island', 'rosh' );
		$countries['CC'] = esc_html__( 'Cocos (Keeling) Islands (Kepulauan Cocos (Keeling))', 'rosh' );
		$countries['CO'] = esc_html__( 'Colombia', 'rosh' );
		$countries['KM'] = esc_html__( 'Comoros (‫جزر القمر‬‎)', 'rosh' );
		$countries['CD'] = esc_html__( 'Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)', 'rosh' );
		$countries['CG'] = esc_html__( 'Congo (Republic) (Congo-Brazzaville)', 'rosh' );
		$countries['CK'] = esc_html__( 'Cook Islands', 'rosh' );
		$countries['CR'] = esc_html__( 'Costa Rica', 'rosh' );
		$countries['CI'] = esc_html__( 'Côte d’Ivoire', 'rosh' );
		$countries['HR'] = esc_html__( 'Croatia (Hrvatska)', 'rosh' );
		$countries['CU'] = esc_html__( 'Cuba', 'rosh' );
		$countries['CW'] = esc_html__( 'Curaçao', 'rosh' );
		$countries['CY'] = esc_html__( 'Cyprus (Κύπρος)', 'rosh' );
		$countries['CZ'] = esc_html__( 'Czech Republic (Česká republika)', 'rosh' );
		$countries['DK'] = esc_html__( 'Denmark (Danmark)', 'rosh' );
		$countries['DG'] = esc_html__( 'Diego Garcia', 'rosh' );
		$countries['DJ'] = esc_html__( 'Djibouti', 'rosh' );
		$countries['DM'] = esc_html__( 'Dominica', 'rosh' );
		$countries['DO'] = esc_html__( 'Dominican Republic (República Dominicana)', 'rosh' );
		$countries['EC'] = esc_html__( 'Ecuador', 'rosh' );
		$countries['EG'] = esc_html__( 'Egypt (‫مصر‬‎)', 'rosh' );
		$countries['SV'] = esc_html__( 'El Salvador', 'rosh' );
		$countries['GQ'] = esc_html__( 'Equatorial Guinea (Guinea Ecuatorial)', 'rosh' );
		$countries['ER'] = esc_html__( 'Eritrea', 'rosh' );
		$countries['EE'] = esc_html__( 'Estonia (Eesti)', 'rosh' );
		$countries['ET'] = esc_html__( 'Ethiopia', 'rosh' );
		$countries['FK'] = esc_html__( 'Falkland Islands (Islas Malvinas)', 'rosh' );
		$countries['FO'] = esc_html__( 'Faroe Islands (Føroyar)', 'rosh' );
		$countries['FJ'] = esc_html__( 'Fiji', 'rosh' );
		$countries['FI'] = esc_html__( 'Finland (Suomi)', 'rosh' );
		$countries['FR'] = esc_html__( 'France', 'rosh' );
		$countries['GF'] = esc_html__( 'French Guiana (Guyane française)', 'rosh' );
		$countries['PF'] = esc_html__( 'French Polynesia (Polynésie française)', 'rosh' );
		$countries['TF'] = esc_html__( 'French Southern Territories (Terres australes françaises)', 'rosh' );
		$countries['GA'] = esc_html__( 'Gabon', 'rosh' );
		$countries['GM'] = esc_html__( 'Gambia', 'rosh' );
		$countries['GE'] = esc_html__( 'Georgia (საქართველო)', 'rosh' );
		$countries['DE'] = esc_html__( 'Germany (Deutschland)', 'rosh' );
		$countries['GH'] = esc_html__( 'Ghana (Gaana)', 'rosh' );
		$countries['GI'] = esc_html__( 'Gibraltar', 'rosh' );
		$countries['GR'] = esc_html__( 'Greece (Ελλάδα)', 'rosh' );
		$countries['GL'] = esc_html__( 'Greenland (Kalaallit Nunaat)', 'rosh' );
		$countries['GD'] = esc_html__( 'Grenada', 'rosh' );
		$countries['GP'] = esc_html__( 'Guadeloupe', 'rosh' );
		$countries['GU'] = esc_html__( 'Guam', 'rosh' );
		$countries['GT'] = esc_html__( 'Guatemala', 'rosh' );
		$countries['GG'] = esc_html__( 'Guernsey', 'rosh' );
		$countries['GN'] = esc_html__( 'Guinea (Guinée)', 'rosh' );
		$countries['GW'] = esc_html__( 'Guinea-Bissau (Guiné Bissau)', 'rosh' );
		$countries['GY'] = esc_html__( 'Guyana', 'rosh' );
		$countries['HT'] = esc_html__( 'Haiti', 'rosh' );
		$countries['HM'] = esc_html__( 'Heard & McDonald Islands', 'rosh' );
		$countries['HN'] = esc_html__( 'Honduras', 'rosh' );
		$countries['HK'] = esc_html__( 'Hong Kong (香港)', 'rosh' );
		$countries['HU'] = esc_html__( 'Hungary (Magyarország)', 'rosh' );
		$countries['IS'] = esc_html__( 'Iceland (Ísland)', 'rosh' );
		$countries['IN'] = esc_html__( 'India (भारत)', 'rosh' );
		$countries['ID'] = esc_html__( 'Indonesia', 'rosh' );
		$countries['IR'] = esc_html__( 'Iran (‫ایران‬‎)', 'rosh' );
		$countries['IQ'] = esc_html__( 'Iraq (‫العراق‬‎)', 'rosh' );
		$countries['IE'] = esc_html__( 'Ireland', 'rosh' );
		$countries['IM'] = esc_html__( 'Isle of Man', 'rosh' );
		$countries['IL'] = esc_html__( 'Israel (‫ישראל‬‎)', 'rosh' );
		$countries['IT'] = esc_html__( 'Italy (Italia)', 'rosh' );
		$countries['JM'] = esc_html__( 'Jamaica', 'rosh' );
		$countries['JP'] = esc_html__( 'Japan (日本)', 'rosh' );
		$countries['JE'] = esc_html__( 'Jersey', 'rosh' );
		$countries['JO'] = esc_html__( 'Jordan (‫الأردن‬‎)', 'rosh' );
		$countries['KZ'] = esc_html__( 'Kazakhstan (Казахстан)', 'rosh' );
		$countries['KE'] = esc_html__( 'Kenya', 'rosh' );
		$countries['KI'] = esc_html__( 'Kiribati', 'rosh' );
		$countries['XK'] = esc_html__( 'Kosovo (Kosovë)', 'rosh' );
		$countries['KW'] = esc_html__( 'Kuwait (‫الكويت‬‎)', 'rosh' );
		$countries['KG'] = esc_html__( 'Kyrgyzstan (Кыргызстан)', 'rosh' );
		$countries['LA'] = esc_html__( 'Laos (ລາວ)', 'rosh' );
		$countries['LV'] = esc_html__( 'Latvia (Latvija)', 'rosh' );
		$countries['LB'] = esc_html__( 'Lebanon (‫لبنان‬‎)', 'rosh' );
		$countries['LS'] = esc_html__( 'Lesotho', 'rosh' );
		$countries['LR'] = esc_html__( 'Liberia', 'rosh' );
		$countries['LY'] = esc_html__( 'Libya (‫ليبيا‬‎)', 'rosh' );
		$countries['LI'] = esc_html__( 'Liechtenstein', 'rosh' );
		$countries['LT'] = esc_html__( 'Lithuania (Lietuva)', 'rosh' );
		$countries['LU'] = esc_html__( 'Luxembourg', 'rosh' );
		$countries['MO'] = esc_html__( 'Macau (澳門)', 'rosh' );
		$countries['MK'] = esc_html__( 'Macedonia (FYROM) (Македонија)', 'rosh' );
		$countries['MG'] = esc_html__( 'Madagascar (Madagasikara)', 'rosh' );
		$countries['MW'] = esc_html__( 'Malawi', 'rosh' );
		$countries['MY'] = esc_html__( 'Malaysia', 'rosh' );
		$countries['MV'] = esc_html__( 'Maldives', 'rosh' );
		$countries['ML'] = esc_html__( 'Mali', 'rosh' );
		$countries['MT'] = esc_html__( 'Malta', 'rosh' );
		$countries['MH'] = esc_html__( 'Marshall Islands', 'rosh' );
		$countries['MQ'] = esc_html__( 'Martinique', 'rosh' );
		$countries['MR'] = esc_html__( 'Mauritania (‫موريتانيا‬‎)', 'rosh' );
		$countries['MU'] = esc_html__( 'Mauritius (Moris)', 'rosh' );
		$countries['YT'] = esc_html__( 'Mayotte', 'rosh' );
		$countries['MX'] = esc_html__( 'Mexico (México)', 'rosh' );
		$countries['FM'] = esc_html__( 'Micronesia', 'rosh' );
		$countries['MD'] = esc_html__( 'Moldova (Republica Moldova)', 'rosh' );
		$countries['MC'] = esc_html__( 'Monaco', 'rosh' );
		$countries['MN'] = esc_html__( 'Mongolia (Монгол)', 'rosh' );
		$countries['ME'] = esc_html__( 'Montenegro (Crna Gora)', 'rosh' );
		$countries['MS'] = esc_html__( 'Montserrat', 'rosh' );
		$countries['MA'] = esc_html__( 'Morocco (‫المغرب‬‎)', 'rosh' );
		$countries['MZ'] = esc_html__( 'Mozambique (Moçambique)', 'rosh' );
		$countries['MM'] = esc_html__( 'Myanmar (Burma) (မြန်မာ)', 'rosh' );
		$countries['NA'] = esc_html__( 'Namibia (Namibië)', 'rosh' );
		$countries['NR'] = esc_html__( 'Nauru', 'rosh' );
		$countries['NP'] = esc_html__( 'Nepal (नेपाल)', 'rosh' );
		$countries['NL'] = esc_html__( 'Netherlands (Nederland)', 'rosh' );
		$countries['NC'] = esc_html__( 'New Caledonia (Nouvelle-Calédonie)', 'rosh' );
		$countries['NZ'] = esc_html__( 'New Zealand', 'rosh' );
		$countries['NI'] = esc_html__( 'Nicaragua', 'rosh' );
		$countries['NE'] = esc_html__( 'Niger (Nijar)', 'rosh' );
		$countries['NG'] = esc_html__( 'Nigeria', 'rosh' );
		$countries['NU'] = esc_html__( 'Niue', 'rosh' );
		$countries['NF'] = esc_html__( 'Norfolk Island', 'rosh' );
		$countries['MP'] = esc_html__( 'Northern Mariana Islands', 'rosh' );
		$countries['KP'] = esc_html__( 'North Korea (조선 민주주의 인민 공화국)', 'rosh' );
		$countries['NO'] = esc_html__( 'Norway (Norge)', 'rosh' );
		$countries['OM'] = esc_html__( 'Oman (‫عُمان‬‎)', 'rosh' );
		$countries['PK'] = esc_html__( 'Pakistan (‫پاکستان‬‎)', 'rosh' );
		$countries['PW'] = esc_html__( 'Palau', 'rosh' );
		$countries['PS'] = esc_html__( 'Palestine (‫فلسطين‬‎)', 'rosh' );
		$countries['PA'] = esc_html__( 'Panama (Panamá)', 'rosh' );
		$countries['PG'] = esc_html__( 'Papua New Guinea', 'rosh' );
		$countries['PY'] = esc_html__( 'Paraguay', 'rosh' );
		$countries['PE'] = esc_html__( 'Peru (Perú)', 'rosh' );
		$countries['PH'] = esc_html__( 'Philippines', 'rosh' );
		$countries['PN'] = esc_html__( 'Pitcairn Islands', 'rosh' );
		$countries['PL'] = esc_html__( 'Poland (Polska)', 'rosh' );
		$countries['PT'] = esc_html__( 'Portugal', 'rosh' );
		$countries['PR'] = esc_html__( 'Puerto Rico', 'rosh' );
		$countries['QA'] = esc_html__( 'Qatar (‫قطر‬‎)', 'rosh' );
		$countries['RE'] = esc_html__( 'Réunion (La Réunion)', 'rosh' );
		$countries['RO'] = esc_html__( 'Romania (România)', 'rosh' );
		$countries['RU'] = esc_html__( 'Russia (Россия)', 'rosh' );
		$countries['RW'] = esc_html__( 'Rwanda', 'rosh' );
		$countries['BL'] = esc_html__( 'Saint Barthélemy (Saint-Barthélemy)', 'rosh' );
		$countries['SH'] = esc_html__( 'Saint Helena', 'rosh' );
		$countries['KN'] = esc_html__( 'Saint Kitts and Nevis', 'rosh' );
		$countries['LC'] = esc_html__( 'Saint Lucia', 'rosh' );
		$countries['MF'] = esc_html__( 'Saint Martin (Saint-Martin (partie française))', 'rosh' );
		$countries['PM'] = esc_html__( 'Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)', 'rosh' );
		$countries['WS'] = esc_html__( 'Samoa', 'rosh' );
		$countries['SM'] = esc_html__( 'San Marino', 'rosh' );
		$countries['ST'] = esc_html__( 'São Tomé and Príncipe (São Tomé e Príncipe)', 'rosh' );
		$countries['SA'] = esc_html__( 'Saudi Arabia (‫المملكة العربية السعودية‬‎)', 'rosh' );
		$countries['SN'] = esc_html__( 'Senegal (Sénégal)', 'rosh' );
		$countries['RS'] = esc_html__( 'Serbia (Србија)', 'rosh' );
		$countries['SC'] = esc_html__( 'Seychelles', 'rosh' );
		$countries['SL'] = esc_html__( 'Sierra Leone', 'rosh' );
		$countries['SG'] = esc_html__( 'Singapore', 'rosh' );
		$countries['SX'] = esc_html__( 'Sint Maarten', 'rosh' );
		$countries['SK'] = esc_html__( 'Slovakia (Slovensko)', 'rosh' );
		$countries['SI'] = esc_html__( 'Slovenia (Slovenija)', 'rosh' );
		$countries['SB'] = esc_html__( 'Solomon Islands', 'rosh' );
		$countries['SO'] = esc_html__( 'Somalia (Soomaaliya)', 'rosh' );
		$countries['ZA'] = esc_html__( 'South Africa', 'rosh' );
		$countries['GS'] = esc_html__( 'South Georgia & South Sandwich Islands', 'rosh' );
		$countries['KR'] = esc_html__( 'South Korea (대한민국)', 'rosh' );
		$countries['SS'] = esc_html__( 'South Sudan (‫جنوب السودان‬‎)', 'rosh' );
		$countries['ES'] = esc_html__( 'Spain (España)', 'rosh' );
		$countries['LK'] = esc_html__( 'Sri Lanka (ශ්‍රී ලංකාව)', 'rosh' );
		$countries['VC'] = esc_html__( 'St. Vincent & Grenadines', 'rosh' );
		$countries['SD'] = esc_html__( 'Sudan (‫السودان‬‎)', 'rosh' );
		$countries['SR'] = esc_html__( 'Suriname', 'rosh' );
		$countries['SJ'] = esc_html__( 'Svalbard and Jan Mayen (Svalbard og Jan Mayen)', 'rosh' );
		$countries['SZ'] = esc_html__( 'Swaziland', 'rosh' );
		$countries['SE'] = esc_html__( 'Sweden (Sverige)', 'rosh' );
		$countries['CH'] = esc_html__( 'Switzerland (Schweiz)', 'rosh' );
		$countries['SY'] = esc_html__( 'Syria (‫سوريا‬‎)', 'rosh' );
		$countries['TW'] = esc_html__( 'Taiwan (台灣)', 'rosh' );
		$countries['TJ'] = esc_html__( 'Tajikistan', 'rosh' );
		$countries['TZ'] = esc_html__( 'Tanzania', 'rosh' );
		$countries['TH'] = esc_html__( 'Thailand (ไทย)', 'rosh' );
		$countries['TL'] = esc_html__( 'Timor-Leste', 'rosh' );
		$countries['TG'] = esc_html__( 'Togo', 'rosh' );
		$countries['TK'] = esc_html__( 'Tokelau', 'rosh' );
		$countries['TO'] = esc_html__( 'Tonga', 'rosh' );
		$countries['TT'] = esc_html__( 'Trinidad and Tobago', 'rosh' );
		$countries['TA'] = esc_html__( 'Tristan da Cunha', 'rosh' );
		$countries['TN'] = esc_html__( 'Tunisia (‫تونس‬‎)', 'rosh' );
		$countries['TR'] = esc_html__( 'Turkey (Türkiye)', 'rosh' );
		$countries['TM'] = esc_html__( 'Turkmenistan', 'rosh' );
		$countries['TC'] = esc_html__( 'Turks and Caicos Islands', 'rosh' );
		$countries['TV'] = esc_html__( 'Tuvalu', 'rosh' );
		$countries['UM'] = esc_html__( 'U.S. Outlying Islands', 'rosh' );
		$countries['VI'] = esc_html__( 'U.S. Virgin Islands', 'rosh' );
		$countries['UG'] = esc_html__( 'Uganda', 'rosh' );
		$countries['UA'] = esc_html__( 'Ukraine (Україна)', 'rosh' );
		$countries['AE'] = esc_html__( 'United Arab Emirates (‫الإمارات العربية المتحدة‬‎)', 'rosh' );
		$countries['GB'] = esc_html__( 'United Kingdom', 'rosh' );
		$countries['US'] = esc_html__( 'United States', 'rosh' );
		$countries['UY'] = esc_html__( 'Uruguay', 'rosh' );
		$countries['UZ'] = esc_html__( 'Uzbekistan (Oʻzbekiston)', 'rosh' );
		$countries['VU'] = esc_html__( 'Vanuatu', 'rosh' );
		$countries['VA'] = esc_html__( 'Vatican City (Città del Vaticano)', 'rosh' );
		$countries['VE'] = esc_html__( 'Venezuela', 'rosh' );
		$countries['VN'] = esc_html__( 'Vietnam (Việt Nam)', 'rosh' );
		$countries['WF'] = esc_html__( 'Wallis and Futuna', 'rosh' );
		$countries['EH'] = esc_html__( 'Western Sahara (‫الصحراء الغربية‬‎)', 'rosh' );
		$countries['YE'] = esc_html__( 'Yemen (‫اليمن‬‎)', 'rosh' );
		$countries['ZM'] = esc_html__( 'Zambia', 'rosh' );
		$countries['ZW'] = esc_html__( 'Zimbabwe', 'rosh' );

		if ( ! empty( $country ) ) {

			return $countries[$country];

		}

		return $countries;

	} // country_list()

	/**
	 * Loads files for Custom Controls.
	 *
	 * @hooked
	 */
	public function load_customize_controls() {

		$files[] = 'control-editor.php';
		$files[] = 'control-layout-picker.php';
		$files[] = 'control-multiple-checkboxes.php';
		$files[] = 'control-select-category.php';
		$files[] = 'control-select-menu.php';
		$files[] = 'control-select-post.php';
		$files[] = 'control-select-post-type.php';
		//$files[] = 'control-select-recent-post.php';
		$files[] = 'control-select-tag.php';
		$files[] = 'control-select-taxonomy.php';
		$files[] = 'control-select-user.php';

		foreach ( $files as $file ) {

			require_once( trailingslashit( get_stylesheet_directory() ) . 'classes/customizer/' . $file );

		}

	} // load_customize_controls()

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @since 		1.0.4
	 */
	public function refresh_partial_blogname() {

		bloginfo( 'name' );

	} // refresh_partial_blogname()

	/**
	 * Render the site description for the selective refresh partial.
	 *
	 * @since 		1.0.4
	 */
	public function refresh_partial_blogdescription() {

		bloginfo( 'description' );

	} // refresh_partial_blogdescription()

	/**
	 * Registers selective refresh for site title and description.
	 *
	 * @hooked 		customize_register
	 * @since 		1.0.4
	 * @param 		WP_Customize_Manager 		$wp_customize 		Theme Customizer object.
	 */
	public function selective_refresh( $wp_customize ) {

		if ( ! isset( $wp_customize->selective_refresh ) ) { return; }

		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => [ $this, 'refresh_partial_blogname' ],
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => [ $this, 'refresh_partial_blogdescription' ],
		) );

	} // selective_refresh()

	/**
	 * Returns an array of the Australian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_australia( $state = '' ) {

		$states = array();

		$states['ACT'] = esc_html__( 'Australian Capital Territory', 'rosh' );
		$states['NSW'] = esc_html__( 'New South Wales', 'rosh' );
		$states['NT' ] = esc_html__( 'Northern Territory', 'rosh' );
		$states['QLD'] = esc_html__( 'Queensland', 'rosh' );
		$states['SA' ] = esc_html__( 'South Australia', 'rosh' );
		$states['TAS'] = esc_html__( 'Tasmania', 'rosh' );
		$states['VIC'] = esc_html__( 'Victoria', 'rosh' );
		$states['WA' ] = esc_html__( 'Western Australia', 'rosh' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_australia()



	/**
	 * Returns an array of the Canadian states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_canada( $state = '' ) {

		$states = array();

		$states['AB'] = esc_html__( 'Alberta', 'rosh' );
		$states['BC'] = esc_html__( 'British Columbia', 'rosh' );
		$states['MB'] = esc_html__( 'Manitoba', 'rosh' );
		$states['NB'] = esc_html__( 'New Brunswick', 'rosh' );
		$states['NL'] = esc_html__( 'Newfoundland and Labrador', 'rosh' );
		$states['NT'] = esc_html__( 'Northwest Territories', 'rosh' );
		$states['NS'] = esc_html__( 'Nova Scotia', 'rosh' );
		$states['NU'] = esc_html__( 'Nunavut', 'rosh' );
		$states['ON'] = esc_html__( 'Ontario', 'rosh' );
		$states['PE'] = esc_html__( 'Prince Edward Island', 'rosh' );
		$states['QC'] = esc_html__( 'Quebec', 'rosh' );
		$states['SK'] = esc_html__( 'Saskatchewan', 'rosh' );
		$states['YT'] = esc_html__( 'Yukon', 'rosh' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_canada()

	/**
	 * Returns an array of the US states and Territories.
	 * The optional parameters allows for returning just one state.
	 *
	 * @param 		string 		$state 		The state to return.
	 * @return 		array 					An array containing states.
	 */
	private function states_list_unitedstates( $state = '' ) {

		$states = array();

		$states['AL'] = esc_html__( 'Alabama', 'rosh' );
		$states['AK'] = esc_html__( 'Alaska', 'rosh' );
		$states['AZ'] = esc_html__( 'Arizona', 'rosh' );
		$states['AR'] = esc_html__( 'Arkansas', 'rosh' );
		$states['CA'] = esc_html__( 'California', 'rosh' );
		$states['CO'] = esc_html__( 'Colorado', 'rosh' );
		$states['CT'] = esc_html__( 'Connecticut', 'rosh' );
		$states['DE'] = esc_html__( 'Delaware', 'rosh' );
		$states['DC'] = esc_html__( 'District of Columbia', 'rosh' );
		$states['FL'] = esc_html__( 'Florida', 'rosh' );
		$states['GA'] = esc_html__( 'Georgia', 'rosh' );
		$states['HI'] = esc_html__( 'Hawaii', 'rosh' );
		$states['ID'] = esc_html__( 'Idaho', 'rosh' );
		$states['IL'] = esc_html__( 'Illinois', 'rosh' );
		$states['IN'] = esc_html__( 'Indiana', 'rosh' );
		$states['IA'] = esc_html__( 'Iowa', 'rosh' );
		$states['KS'] = esc_html__( 'Kansas', 'rosh' );
		$states['KY'] = esc_html__( 'Kentucky', 'rosh' );
		$states['LA'] = esc_html__( 'Louisiana', 'rosh' );
		$states['ME'] = esc_html__( 'Maine', 'rosh' );
		$states['MD'] = esc_html__( 'Maryland', 'rosh' );
		$states['MA'] = esc_html__( 'Massachusetts', 'rosh' );
		$states['MI'] = esc_html__( 'Michigan', 'rosh' );
		$states['MN'] = esc_html__( 'Minnesota', 'rosh' );
		$states['MS'] = esc_html__( 'Mississippi', 'rosh' );
		$states['MO'] = esc_html__( 'Missouri', 'rosh' );
		$states['MT'] = esc_html__( 'Montana', 'rosh' );
		$states['NE'] = esc_html__( 'Nebraska', 'rosh' );
		$states['NV'] = esc_html__( 'Nevada', 'rosh' );
		$states['NH'] = esc_html__( 'New Hampshire', 'rosh' );
		$states['NJ'] = esc_html__( 'New Jersey', 'rosh' );
		$states['NM'] = esc_html__( 'New Mexico', 'rosh' );
		$states['NY'] = esc_html__( 'New York', 'rosh' );
		$states['NC'] = esc_html__( 'North Carolina', 'rosh' );
		$states['ND'] = esc_html__( 'North Dakota', 'rosh' );
		$states['OH'] = esc_html__( 'Ohio', 'rosh' );
		$states['OK'] = esc_html__( 'Oklahoma', 'rosh' );
		$states['OR'] = esc_html__( 'Oregon', 'rosh' );
		$states['PA'] = esc_html__( 'Pennsylvania', 'rosh' );
		$states['RI'] = esc_html__( 'Rhode Island', 'rosh' );
		$states['SC'] = esc_html__( 'South Carolina', 'rosh' );
		$states['SD'] = esc_html__( 'South Dakota', 'rosh' );
		$states['TN'] = esc_html__( 'Tennessee', 'rosh' );
		$states['TX'] = esc_html__( 'Texas', 'rosh' );
		$states['UT'] = esc_html__( 'Utah', 'rosh' );
		$states['VT'] = esc_html__( 'Vermont', 'rosh' );
		$states['VA'] = esc_html__( 'Virginia', 'rosh' );
		$states['WA'] = esc_html__( 'Washington', 'rosh' );
		$states['WV'] = esc_html__( 'West Virginia', 'rosh' );
		$states['WI'] = esc_html__( 'Wisconsin', 'rosh' );
		$states['WY'] = esc_html__( 'Wyoming', 'rosh' );
		$states['AS'] = esc_html__( 'American Samoa', 'rosh' );
		$states['AA'] = esc_html__( 'Armed Forces America (except Canada)', 'rosh' );
		$states['AE'] = esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'rosh' );
		$states['AP'] = esc_html__( 'Armed Forces Pacific', 'rosh' );
		$states['FM'] = esc_html__( 'Federated States of Micronesia', 'rosh' );
		$states['GU'] = esc_html__( 'Guam', 'rosh' );
		$states['MH'] = esc_html__( 'Marshall Islands', 'rosh' );
		$states['MP'] = esc_html__( 'Northern Mariana Islands', 'rosh' );
		$states['PR'] = esc_html__( 'Puerto Rico', 'rosh' );
		$states['PW'] = esc_html__( 'Palau', 'rosh' );
		$states['VI'] = esc_html__( 'Virgin Islands', 'rosh' );

		if ( ! empty( $state ) ) {

			return $states[$state];

		}

		return $states;

	} // states_list_unitedstates()

} // class

/**
 * Sanitizes the input for the Google Analytics code field.
 *
 * @param 		mixed 		$input 		The field input.
 * @return 		mixed 					The sanitized input.
 */
function rosh_sanitize_analytics_code( $input ) {

	return stripslashes( wp_filter_post_kses( $input ) );

} // rosh_sanitize_analytics_code()
