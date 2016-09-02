<?php
/**
 * Template part for displaying a metabox.
 *
 * @package Rosh
 */

wp_nonce_field( $this->theme_name, 'nonce_rosh_post_format' );

$format = get_post_format();



$atts['class'] 			= 'widefat';
$atts['id'] 			= 'post-audio';
$atts['label'] 			= __( 'Post Audio URL', 'rosh' );
$atts['name'] 			= 'post-audio';
$atts['type'] 			= 'url';

if ( FALSE === strpos( $atts['id'], $format ) ) {

	$class = 'hide';

}

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><div class="post-format-field <?php echo esc_attr( $class ); ?>" id="post_format_audio"><?php

include( get_stylesheet_directory() . '/template-parts/fields/text.php' );
unset( $class );
unset( $atts );

?></div><?php




$atts['class'] 			= 'widefat';
$atts['id'] 			= 'post-image';
$atts['label'] 			= __( 'Post Image URL', 'rosh' );
$atts['name'] 			= 'post-image';

if ( FALSE === strpos( $atts['id'], $format ) ) {

	$class = 'hide';

}

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><div class="post-format-field <?php echo esc_attr( $class ); ?>" id="post_format_image"><?php

include( get_stylesheet_directory() . '/template-parts/fields/image-upload.php' );
unset( $class );
unset( $atts );

?></div><?php



$atts['class'] 			= 'widefat';
$atts['id'] 			= 'post-link';
$atts['label'] 			= __( 'Post Link URL', 'rosh' );
$atts['name'] 			= 'post-link';
$atts['type'] 			= 'url';

if ( FALSE === strpos( $atts['id'], $format ) ) {

	$class = 'hide';

}

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><div class="post-format-field <?php echo esc_attr( $class ); ?>" id="post_format_link"><?php

include( get_stylesheet_directory() . '/template-parts/fields/text.php' );
unset( $class );
unset( $atts );

?></div><?php



$atts['class'] 			= 'widefat';
$atts['id'] 			= 'post-video';
$atts['label'] 			= __( 'Post Video URL', 'rosh' );
$atts['name'] 			= 'post-video';
$atts['type'] 			= 'url';

if ( FALSE === strpos( $atts['id'], $format ) ) {

	$class = 'hide';

}

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><div class="post-format-field <?php echo esc_attr( $class ); ?>" id="post_format_video"><?php

include( get_stylesheet_directory() . '/template-parts/fields/text.php' );
unset( $class );
unset( $atts );

?></div>
