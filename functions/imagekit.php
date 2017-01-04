<?php

/**
 * A class of methods related to images.
 *
 * @package Rosh
 * @author Slushman <chris@slushman.com>
 */

/**
 * Returns a path if the file exists, FALSE if not.
 * 
 * @param 		string 		$file 		The file name to check for.
 * @return 		mixed 					File path or FALSE
 */
function rosh_check_for_svg_file( $file ) {
	
	if ( empty( $file ) ) { return FALSE; }
	
	$return 	= FALSE;
	$paths[] 	= '/assets/svgs/dashicons';
	$paths[] 	= '/assets/svgs/fontawesome';
	$paths[] 	= '/assets/svgs/theme';
	
	/**
	 * The rosh_svg_paths filter.
	 */
	$paths = apply_filters( 'rosh_svg_paths', $paths );
	
	if ( empty( $paths ) ) { return FALSE; }
	
	foreach ( $paths as $path ) {
		
		$svgfile 		= $file . '.svg';
		$fullpath 		= get_stylesheet_directory() . $path;
		$pathtocheck 	= trailingslashit( $fullpath ) . $svgfile;
		$check			= file_exists( $pathtocheck );
		
		if ( ! $check ) { continue; }
		
		$uri 	= get_stylesheet_directory_uri() . $path;
		$return = trailingslashit( $uri ) . $svgfile;
		
	} // foreach
	
	return $return;
	
} // rosh_check_for_svg_file()

if ( ! function_exists( 'rosh_get_customizer_image_info' ) ) :
	/**
	 * Returns an array of image info from the image URL
	 *
	 * @param 		string 		$name 				The name of the customizer image field
	 * @return 		array 							The image info array
	 */
	function rosh_get_customizer_image_info( $name ) {

		if ( empty( $name ) ) { return FALSE; }

		$image_url = get_theme_mod( $name );

		if ( empty( $image_url ) ) { return FALSE; }

		$id = rosh_get_image_id( $image_url );

		if ( empty( $id ) ) { return FALSE; }

		$info = wp_prepare_attachment_for_js( $id );

		return $info;

	} // rosh_get_customizer_image_info()
endif;

if ( ! function_exists( 'rosh_get_featured_images' ) ) :
	/**
	 * Returns an array of the featured image details
	 *
	 * @param 		int 	$postID 		The post ID
	 * @return 		array 					Array of info about the featured image
	 */
	function rosh_get_featured_images( $postID ) {

		if ( empty( $postID ) ) { return FALSE; }

		$imageID = get_post_thumbnail_id( $postID );

		if ( empty( $imageID ) ) { return FALSE; }

		return wp_prepare_attachment_for_js( $imageID );

	} // rosh_get_featured_images()
endif;

if ( ! function_exists( 'rosh_get_image_id' ) ) :
	/**
	 * Returns the attachment ID from the file URL
	 *
	 * @link 		https://pippinsplugins.com/retrieve-attachment-id-from-image-url/
	 * @param 		string 		$image_url 			The URL of the image
	 * @return 		int 							The image ID
	 */
	function rosh_get_image_id( $image_url ) {

		if ( empty( $image_url ) ) { return FALSE; }

		global $wpdb;

		$attachment = $wpdb->get_col(
						$wpdb->prepare(
							"SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url
						)
					);

		return $attachment[0];

	} // rosh_get_image_id()
endif;

if ( ! function_exists( 'rosh_get_svg' ) ) :
	/**
	 * Returns the requested SVG
	 *
	 * @param 		string 		$svg 		The name of the icon to return
	 * @return 		mixed 					The SVG code
	 */
	function rosh_get_svg( $svg ) {

		if ( empty( $svg ) ) { return; }
		
		$return 	= '';
		$file 		= apply_filters( 'worknet_change_svg', $svg );
		$filecheck 	= worknet_check_for_svg_file( $file );
		
		if ( empty( $filecheck ) ) { return FALSE; }
		
		$get = wp_remote_get( $filecheck );
		
		if ( is_wp_error( $get ) ) { return FALSE; }
		
		$return = wp_remote_retrieve_body( $get );
		
		return $return;

	} // rosh_get_svg()
endif;

if ( ! function_exists( 'rosh_get_thumbnail_url' ) ) :
	/**
	 * Returns the URL of the featured image
	 *
	 * @param 		int 		$postID 		The post ID
	 * @param 		string 		$size 			The image size to return
	 * @return 		string | bool 				The URL of the featured image, otherwise FALSE
	 */
	function rosh_get_thumbnail_url( $postID, $size = 'thumbnail' ) {

		if ( empty( $postID ) ) { return FALSE; }

		$thumb_id = get_post_thumbnail_id( $postID );

		if ( empty( $thumb_id ) ) { return FALSE; }

		$thumb_array = wp_get_attachment_image_src( $thumb_id, $size );

		if ( empty( $thumb_array ) ) { return FALSE; }

		return $thumb_array[0];

	} // rosh_get_thumbnail_url()
endif;

if ( ! function_exists( 'rosh_get_video_thumb' ) ) :
	/**
	 * Return the thumbnail src for Youtube videos
	 *
	 * @param 		string 		$video_url 			The YouTube video URL
	 * @return 		string 							The video thumbnail URL
	 */
	function rosh_get_video_thumb( $embed_code ) {

		$return = '';

		$service = rosh_get_video_service( $embed_code );
		$videoID = rosh_get_video_id( $service, $embed_code );

		if ( FALSE !== strpos( $embed_code, 'youtu' ) ) {

			if ( preg_match( '~iframe~', $embed_code ) ) {

				preg_match( '~src="[^"]*(embed/)([^\?&"]*)~', $embed_code, $video_id );

			} else {

				preg_match( '~(v/|v=)(.*?)(\?|&|\z)~', $embed_code, $video_id );

			}

		}

		if ( preg_match( '~youtu~', $embed_code ) ) {

			if ( preg_match( '~iframe~', $embed_code ) ) {

				preg_match( '~src="[^"]*(embed/)([^\?&"]*)~', $embed_code, $video_id );

			} else {

				preg_match( '~(v/|v=)(.*?)(\?|&|\z)~', $embed_code, $video_id );

			}

			$return = "http://img.youtube.com/vi/" . $video_id[2] . "/0.jpg";

		} elseif ( preg_match( '~vimeo~', $embed_code ) ) {

			if ( preg_match( '~iframe~', $embed_code ) ) {

				preg_match( '~src="[^"]*video/([^?&]*)[^"]*"~', $embed_code, $video_id );

			} else {

				preg_match( '~clip_id=(.*?)&~', $embed_code, $video_id );

			}

			$thumb 	= rosh_get_vimeo_thumb( $video_id[1] );
			$return = $thumb[0]['thumbnail_medium'];

		}

		return $return;

	} // rosh_get_video_thumb()
endif;

if ( ! function_exists( 'rosh_get_video_service' ) ) :
	function rosh_get_video_service( $string ) {

		if ( empty( $string ) ) { return FALSE; }

		$checks = array( 'ustream', 'veoh', 'viddler', 'vimeo', 'vine', 'youtu', 'youtube' );

		/**
		 * rosh_video-services filter
		 */
		$checks 	= apply_filters( 'rosh_video-services', $checks, $string );
		$service 	= FALSE;

		foreach ( $checks as $check ) {

			$pos = stripos( $string, $check );

			if ( FALSE !== $pos ) { $service = $check; break; }

		} // foreach

		return $service;

	} // rosh_get_video_service()
endif;

if ( ! function_exists( 'rosh_get_video_id' ) ) :
	/**
	 * Returns the video ID
	 *
	 * @param 		string 		$url 			The video URL
	 * @param 		string 		$service 		Name of the service
	 * @return 		string 						The video ID
	 */
	function rosh_get_video_id( $service, $string ) {

		if ( empty( $service ) ) { return; }
		if ( empty( $string ) ) { return; }

		$trigger 	= '';
		$string 	= rtrim( $string, '/' );
		$trigger 	= '/';

		if ( 'ustream' === $service ) {

			$trigger = '.tv/';

		}

		$explode = explode( $trigger, $string );
		$videoID = end( $explode );

		return $videoID;

	} // get_video_id()
endif;

if ( ! function_exists( 'rosh_get_vimeo_thumb' ) ) :
	/**
	 * Return the thumbnail src for Vimeo videos
	 *
	 * @param 		string 		$video_id 			The video ID.
	 * @return 		url 							The URL for the video thumbnail.
	 */
	function rosh_get_vimeo_thumb( $videoid ) {

		$url 			= "http://vimeo.com/api/v2/video/" . $videoid . ".php";
		$cache_id 		= 'vimeocache::' . md5( $url );
		$cache_lifetime = 300;
		$cached 		= get_option( $cache_id, -1 );
		$has_cache 		= $cached !== -1;
		$is_expired 	= isset( $cached['expires'] ) && time() > $cached['expires'];

		if ( ! $has_cache || $is_expired ) {

			$data = wp_remote_get( $url );
			$data = $data['body'];

			$video_cache = array(
				'data' => $data,
				'expires' => time() + $cache_lifetime,
			);

			update_option( $cache_id, $video_cache );

		} else {

			$data = $cached['data'];

		}

		$finaldata = unserialize($data);

		return $finaldata;

	} // rosh_get_vimeo_thumb()
endif;

if ( ! function_exists( 'rosh_the_svg' ) ) :
	/**
	 * Echos the requested SVG
	 *
	 * @param 		string 		$svg 		The name of the icon to return
	 * @return 		mixed 					The SVG code
	 */
	function rosh_the_svg( $svg ) {

		echo rosh_get_svg( $svg );

	} // rosh_the_svg()
endif;
