<?php

class Rosh_Geography {
	
	var $country;
	
	var $state;
	
	public function __construct() {}
		
	public function hooks() {
		
		
		
	} // hooks()
	
	/**
	 * Returns an array of countries or a country name.
	 *
	 * @param 		string 		$country 		Country code to return (optional)
	 * @return 		array|string 				Array of countries or a single country name
	 */
	protected function country_list( $country = '' ) {

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
	 * Returns either a single country name or an array of countries.
	 * 
	 * @param 		string 			$country 		Optional country abbreviation.
	 * @return 		string|array 					Country name or array of countries.
	 */
	public function get_countries( $country = '' ) {
		
		return $this->country_list( $country );
		
	} // get_countries()
	
	/**
	 * Returns either a single state name or an array of states.
	 * 
	 * @param 		string 			$country 		Country abbreviation or name.
	 * @param 		string 			$state 			State abbreviation or name.
	 * @return 		string|array 					State name, abbreviation, or array of states.
	 */
	public function get_state( $country, $state, $return = '' ) {
		
		if ( empty( $country ) ) { return FALSE; }
		if ( empty( $state ) ) { return FALSE; }
		
		switch( $country ) {
			
			case 'Australia'	: 
			case 'AUS' 			: return $this->get_states_australia( $state, $return ); break;
			case 'Canada' 		: 
			case 'CAN' 			: return $this->get_states_canada( $state, $return ); break;
			case 'US' 			: 
			case 'United States': return $this->get_states_us( $state, $return ); break;
			
		}
		
	} // get_state()
	
	/**
	 * Returns an array of the Australian states and Territories.
	 * 
	 * The optional $state parameter can be either the abbreviation or the name of
	 * a state. The abbreviation will return the states full name. The name will
	 * return the state's abbreviation.
	 *
	 * The optional $return parameters allows for returning either an array 
	 * of state names or an array of state abbreviations. Names is the default.
	 * To return the array of abbreviations, make $return either "abbreviations"
	 * or "abbrs".
	 *
	 * @param 		string 				$state 			The state to return.
	 * @param 		string 				$return 		Optional value to specify returning
	 * 														either the array or state name or
	 * 														state abbreviations.
	 * @return 		array/string 						An array of states, state name,
	 *														or state abbreviation.
	 */
	protected function get_states_australia( $state = '', $return = '' ) {

		$names = array();
		$names['ACT'] = esc_html__( 'Australian Capital Territory', 'rosh' );
		$names['NSW'] = esc_html__( 'New South Wales', 'rosh' );
		$names['NT' ] = esc_html__( 'Northern Territory', 'rosh' );
		$names['QLD'] = esc_html__( 'Queensland', 'rosh' );
		$names['SA' ] = esc_html__( 'South Australia', 'rosh' );
		$names['TAS'] = esc_html__( 'Tasmania', 'rosh' );
		$names['VIC'] = esc_html__( 'Victoria', 'rosh' );
		$names['WA' ] = esc_html__( 'Western Australia', 'rosh' );
		
		$abbrs = array();
		$abbrs['Australian Capital Territory'] 	= esc_html__( 'ACT', 'rosh' );
		$abbrs['New South Wales'] 				= esc_html__( 'NSW', 'rosh' );
		$abbrs['Northern Territory' ] 			= esc_html__( 'NT', 'rosh' );
		$abbrs['Queensland'] 					= esc_html__( 'QLD', 'rosh' );
		$abbrs['South Australia' ] 				= esc_html__( 'SA', 'rosh' );
		$abbrs['Tasmania'] 						= esc_html__( 'TAS', 'rosh' );
		$abbrs['Victoria'] 						= esc_html__( 'VIC', 'rosh' );
		$abbrs['Western Australia' ] 			= esc_html__( 'WA', 'rosh' );
		
		if ( empty( $state ) ) {
			
			if ( 'abbreviations' === $return || 'abbrs' === $return ) {
				
				return $abbrs;
				
			} else {
			
				return $names;
				
			}
			
		}
		
		if ( 3 < count( $state ) ) {
			
			return $abbrs[$state];
			
		} else {
			
			return $names[$state];
			
		}

	} // get_states_australia()
	
	/**
	 * Returns an array of the Canadian states and Territories.
	 * 
	 * The optional $state parameter can be either the abbreviation or the name of
	 * a state. The abbreviation will return the states full name. The name will
	 * return the state's abbreviation.
	 *
	 * The optional $return parameters allows for returning either an array 
	 * of state names or an array of state abbreviations. Names is the default.
	 * To return the array of abbreviations, make $return either "abbreviations"
	 * or "abbrs".
	 *
	 * @param 		string 				$state 			The state to return.
	 * @param 		string 				$return 		Optional value to specify returning
	 * 														either the array or state name or
	 * 														state abbreviations.
	 * @return 		array/string 						An array of states, state name,
	 *														or state abbreviation.
	 */
	protected function get_states_canada( $state = '', $return = '' ) {

		$names = array();
		$names['AB'] = esc_html__( 'Alberta', 'rosh' );
		$names['BC'] = esc_html__( 'British Columbia', 'rosh' );
		$names['MB'] = esc_html__( 'Manitoba', 'rosh' );
		$names['NB'] = esc_html__( 'New Brunswick', 'rosh' );
		$names['NL'] = esc_html__( 'Newfoundland and Labrador', 'rosh' );
		$names['NT'] = esc_html__( 'Northwest Territories', 'rosh' );
		$names['NS'] = esc_html__( 'Nova Scotia', 'rosh' );
		$names['NU'] = esc_html__( 'Nunavut', 'rosh' );
		$names['ON'] = esc_html__( 'Ontario', 'rosh' );
		$names['PE'] = esc_html__( 'Prince Edward Island', 'rosh' );
		$names['QC'] = esc_html__( 'Quebec', 'rosh' );
		$names['SK'] = esc_html__( 'Saskatchewan', 'rosh' );
		$names['YT'] = esc_html__( 'Yukon', 'rosh' );
		
		$abbrs = array();
		$abbrs['Alberta'] 					= esc_html__( 'AB', 'rosh' );
		$abbrs['British Columbia'] 			= esc_html__( 'BC', 'rosh' );
		$abbrs['Manitoba'] 					= esc_html__( 'MB', 'rosh' );
		$abbrs['New Brunswick'] 			= esc_html__( 'NB', 'rosh' );
		$abbrs['Newfoundland and Labrador'] = esc_html__( 'NL', 'rosh' );
		$abbrs['Newfoundland'] 				= esc_html__( 'NL', 'rosh' );
		$abbrs['Labrador'] 					= esc_html__( 'NL', 'rosh' );
		$abbrs['Northwest Territories'] 	= esc_html__( 'NT', 'rosh' );
		$abbrs['Nova Scotia'] 				= esc_html__( 'NS', 'rosh' );
		$abbrs['Nunavut'] 					= esc_html__( 'NU', 'rosh' );
		$abbrs['Ontario'] 					= esc_html__( 'ON', 'rosh' );
		$abbrs['Prince Edward Island'] 		= esc_html__( 'PE', 'rosh' );
		$abbrs['Quebec'] 					= esc_html__( 'QE', 'rosh' );
		$abbrs['Saskatchewan'] 				= esc_html__( 'SK', 'rosh' );
		$abbrs['Yukon'] 					= esc_html__( 'YT', 'rosh' );

		if ( empty( $state ) ) {
			
			if ( 'abbreviations' === $return || 'abbrs' === $return ) {
				
				return $abbrs;
				
			} else {
			
				return $names;
				
			}
			
		}
		
		if ( 2 < count( $state ) ) {
			
			return $abbrs[$state];
			
		} else {
			
			return $names[$state];
			
		}

	} // get_states_canada()
	
	/**
	 * Returns the abbreviation for a state or an array of states.
	 *
	 * The optional $state parameter can be either the abbreviation or the name of
	 * a state. The abbreviation will return the states full name. The name will
	 * return the state's abbreviation.
	 *
	 * The optional $return parameters allows for returning either an array 
	 * of state names or an array of state abbreviations. Names is the default.
	 * To return the array of abbreviations, make $return either "abbreviations"
	 * or "abbrs".
	 *
	 * @param 		string 				$state 			The state abbreviation.
	 * @param 		string 				$return 		Optional value to specify returning
	 * 														either the array or state name or
	 * 														state abbreviations.
	 * @return 		string|srray 		$states 		Either the name of a state
	 *                                    					or an array of state names.
	 */
	protected function get_states_us( $state = '', $return = '' ) {

		$names 			= array();
		$names['AL'] 	= esc_html__( 'Alabama', 'rosh' );
		$names['AK'] 	= esc_html__( 'Alaska', 'rosh' );
		$names['AZ'] 	= esc_html__( 'Arizona', 'rosh' );
		$names['AR'] 	= esc_html__( 'Arkansas', 'rosh' );
		$names['CA'] 	= esc_html__( 'California', 'rosh' );
		$names['CO'] 	= esc_html__( 'Colorado', 'rosh' );
		$names['CT'] 	= esc_html__( 'Connecticut', 'rosh' );
		$names['DE'] 	= esc_html__( 'Delaware', 'rosh' );
		$names['DC'] 	= esc_html__( 'District of Columbia', 'rosh' );
		$names['FL'] 	= esc_html__( 'Florida', 'rosh' );
		$names['GA'] 	= esc_html__( 'Georgia', 'rosh' );
		$names['HI'] 	= esc_html__( 'Hawaii', 'rosh' );
		$names['ID'] 	= esc_html__( 'Idaho', 'rosh' );
		$names['IL'] 	= esc_html__( 'Illinois', 'rosh' );
		$names['IN'] 	= esc_html__( 'Indiana', 'rosh' );
		$names['IA'] 	= esc_html__( 'Iowa', 'rosh' );
		$names['KS'] 	= esc_html__( 'Kansas', 'rosh' );
		$names['KY'] 	= esc_html__( 'Kentucky', 'rosh' );
		$names['LA'] 	= esc_html__( 'Louisiana', 'rosh' );
		$names['ME'] 	= esc_html__( 'Maine', 'rosh' );
		$names['MD'] 	= esc_html__( 'Maryland', 'rosh' );
		$names['MA'] 	= esc_html__( 'Massachusetts', 'rosh' );
		$names['MI'] 	= esc_html__( 'Michigan', 'rosh' );
		$names['MN'] 	= esc_html__( 'Minnesota', 'rosh' );
		$names['MS'] 	= esc_html__( 'Mississippi', 'rosh' );
		$names['MO'] 	= esc_html__( 'Missouri', 'rosh' );
		$names['MT'] 	= esc_html__( 'Montana', 'rosh' );
		$names['NE'] 	= esc_html__( 'Nebraska', 'rosh' );
		$names['NV'] 	= esc_html__( 'Nevada', 'rosh' );
		$names['NH'] 	= esc_html__( 'New Hampshire', 'rosh' );
		$names['NJ'] 	= esc_html__( 'New Jersey', 'rosh' );
		$names['NM'] 	= esc_html__( 'New Mexico', 'rosh' );
		$names['NY'] 	= esc_html__( 'New York', 'rosh' );
		$names['NC'] 	= esc_html__( 'North Carolina', 'rosh' );
		$names['ND'] 	= esc_html__( 'North Dakota', 'rosh' );
		$names['OH'] 	= esc_html__( 'Ohio', 'rosh' );
		$names['OK'] 	= esc_html__( 'Oklahoma', 'rosh' );
		$names['OR'] 	= esc_html__( 'Oregon', 'rosh' );
		$names['PA'] 	= esc_html__( 'Pennsylvania', 'rosh' );
		$names['RI'] 	= esc_html__( 'Rhode Island', 'rosh' );
		$names['SC'] 	= esc_html__( 'South Carolina', 'rosh' );
		$names['SD'] 	= esc_html__( 'South Dakota', 'rosh' );
		$names['TN'] 	= esc_html__( 'Tennessee', 'rosh' );
		$names['TX'] 	= esc_html__( 'Texas', 'rosh' );
		$names['UT'] 	= esc_html__( 'Utah', 'rosh' );
		$names['VT'] 	= esc_html__( 'Vermont', 'rosh' );
		$names['VA'] 	= esc_html__( 'Virginia', 'rosh' );
		$names['WA'] 	= esc_html__( 'Washington', 'rosh' );
		$names['WV'] 	= esc_html__( 'West Virginia', 'rosh' );
		$names['WI'] 	= esc_html__( 'Wisconsin', 'rosh' );
		$names['WY'] 	= esc_html__( 'Wyoming', 'rosh' );
		$names['AS'] 	= esc_html__( 'American Samoa', 'rosh' );
		$names['AA'] 	= esc_html__( 'Armed Forces America (except Canada)', 'rosh' );
		$names['AE'] 	= esc_html__( 'Armed Forces Africa/Canada/Europe/Middle East', 'rosh' );
		$names['AP'] 	= esc_html__( 'Armed Forces Pacific', 'rosh' );
		$names['FM'] 	= esc_html__( 'Federated States of Micronesia', 'rosh' );
		$names['GU'] 	= esc_html__( 'Guam', 'rosh' );
		$names['MH'] 	= esc_html__( 'Marshall Islands', 'rosh' );
		$names['MP'] 	= esc_html__( 'Northern Mariana Islands', 'rosh' );
		$names['PR'] 	= esc_html__( 'Puerto Rico', 'rosh' );
		$names['PW'] 	= esc_html__( 'Palau', 'rosh' );
		$names['VI'] 	= esc_html__( 'Virgin Islands', 'rosh' );
		
		$abbrs 										= array();
		$abbrs['Alabama'] 							= esc_html__( 'AL', 'rosh' );
		$abbrs['Alaska'] 							= esc_html__( 'AK', 'rosh' );
		$abbrs['Arizona'] 							= esc_html__( 'AZ', 'rosh' );
		$abbrs['Arkansas'] 							= esc_html__( 'AR', 'rosh' );
		$abbrs['California'] 						= esc_html__( 'CA', 'rosh' );
		$abbrs['Colorado'] 							= esc_html__( 'CO', 'rosh' );
		$abbrs['Connecticut'] 						= esc_html__( 'CT', 'rosh' );
		$abbrs['Delaware'] 							= esc_html__( 'DE', 'rosh' );
		$abbrs['Florida'] 							= esc_html__( 'FL', 'rosh' );
		$abbrs['Georgia'] 							= esc_html__( 'GA', 'rosh' );
		$abbrs['Hawaii'] 							= esc_html__( 'HI', 'rosh' );
		$abbrs['Idaho'] 							= esc_html__( 'ID', 'rosh' );
		$abbrs['Illinois'] 							= esc_html__( 'IL', 'rosh' );
		$abbrs['Indiana'] 							= esc_html__( 'IN', 'rosh' );
		$abbrs['Iowa'] 								= esc_html__( 'IA', 'rosh' );
		$abbrs['Kansas'] 							= esc_html__( 'KS', 'rosh' );
		$abbrs['Kentucky'] 							= esc_html__( 'KY', 'rosh' );
		$abbrs['Louisiana'] 						= esc_html__( 'LA', 'rosh' );
		$abbrs['Maine'] 							= esc_html__( 'ME', 'rosh' );
		$abbrs['Maryland'] 							= esc_html__( 'MD', 'rosh' );
		$abbrs['Massachusetts'] 					= esc_html__( 'MA', 'rosh' );
		$abbrs['Michigan'] 							= esc_html__( 'MI', 'rosh' );
		$abbrs['Minnesota'] 						= esc_html__( 'MN', 'rosh' );
		$abbrs['Mississippi'] 						= esc_html__( 'MS', 'rosh' );
		$abbrs['Missouri'] 							= esc_html__( 'MO', 'rosh' );
		$abbrs['Montana'] 							= esc_html__( 'MT', 'rosh' );
		$abbrs['Nebraska'] 							= esc_html__( 'NE', 'rosh' );
		$abbrs['Nevada'] 							= esc_html__( 'NV', 'rosh' );
		$abbrs['New Hampshire'] 					= esc_html__( 'NH', 'rosh' );
		$abbrs['New Jersey'] 						= esc_html__( 'NJ', 'rosh' );
		$abbrs['New Mexico'] 						= esc_html__( 'NM', 'rosh' );
		$abbrs['New York'] 							= esc_html__( 'NY', 'rosh' );
		$abbrs['North Carolina'] 					= esc_html__( 'NC', 'rosh' );
		$abbrs['North Dakota'] 						= esc_html__( 'ND', 'rosh' );
		$abbrs['Ohio'] 								= esc_html__( 'OH', 'rosh' );
		$abbrs['Oklahoma'] 							= esc_html__( 'OK', 'rosh' );
		$abbrs['Oregon'] 							= esc_html__( 'OR', 'rosh' );
		$abbrs['Pennsylvania'] 						= esc_html__( 'PA', 'rosh' );
		$abbrs['Rhode Island'] 						= esc_html__( 'RI', 'rosh' );
		$abbrs['South Carolina'] 					= esc_html__( 'SC', 'rosh' );
		$abbrs['South Dakota'] 						= esc_html__( 'SD', 'rosh' );
		$abbrs['Tennessee'] 						= esc_html__( 'TN', 'rosh' );
		$abbrs['Texas'] 							= esc_html__( 'TX', 'rosh' );
		$abbrs['Utah'] 								= esc_html__( 'UT', 'rosh' );
		$abbrs['Vermont'] 							= esc_html__( 'VT', 'rosh' );
		$abbrs['Virginia'] 							= esc_html__( 'VA', 'rosh' );
		$abbrs['Washington'] 						= esc_html__( 'WA', 'rosh' );
		$abbrs['West Virginia'] 					= esc_html__( 'WV', 'rosh' );
		$abbrs['Wisconsin'] 						= esc_html__( 'WI', 'rosh' );
		$abbrs['Wyoming'] 							= esc_html__( 'WY', 'rosh' );
		
		$abbrs['American Samoa'] 					= esc_html__( 'AS', 'rosh' );
		$abbrs['Armed Forces America'] 				= esc_html__( 'AA', 'rosh' );
		$abbrs['Armed Forces Africa'] 				= esc_html__( 'AE', 'rosh' );
		$abbrs['Armed Forces Canada'] 				= esc_html__( 'AE', 'rosh' );
		$abbrs['Armed Forces Europe'] 				= esc_html__( 'AE', 'rosh' );
		$abbrs['Armed Forces Middle East'] 			= esc_html__( 'AE', 'rosh' );
		$abbrs['Armed Forces Pacific'] 				= esc_html__( 'AP', 'rosh' );
		$abbrs['Federated States of Micronesia'] 	= esc_html__( 'FM', 'rosh' );
		$abbrs['Micronesia'] 						= esc_html__( 'FM', 'rosh' );
		$abbrs['Guam'] 								= esc_html__( 'GU', 'rosh' );
		$abbrs['Marshall Islands'] 					= esc_html__( 'MH', 'rosh' );
		$abbrs['Northern Mariana Islands'] 			= esc_html__( 'MP', 'rosh' );
		$abbrs['Puerto Rico'] 						= esc_html__( 'PR', 'rosh' );
		$abbrs['Palau'] 							= esc_html__( 'PW', 'rosh' );
		$abbrs['Virgin Islands'] 					= esc_html__( 'VI', 'rosh' );

		if ( empty( $state ) ) {
			
			if ( 'abbreviations' === $return || 'abbrs' === $return ) {
				
				return $abbrs;
				
			} else {
			
				return $names;
				
			}
			
		}
		
		if ( 2 < count( $state ) ) {
			
			return $abbrs[$state];
			
		} else {
			
			return $names[$state];
			
		}

	} // get_states_us()
	
} // class