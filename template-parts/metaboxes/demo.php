<?php
/**
 * The markup for the Subtitle metabox.
 *
 * @package 		Rosh
 */

wp_nonce_field( $this->theme_name, 'nonce_rosh_demo' );



$atts['description'] 	= __( 'This is a checkbox.', 'rosh' );
$atts['id'] 			= 'field-checkbox';
$atts['name'] 			= 'field-checkbox';

/**
 * This check is different from other fields. Only change the value for a checkbox
 * if the key exists in the meta array. Otherwise, leave it at the default value.
 * This handles a checked or unchecked default value.
 *
 * Checking for a not empty meta value while having a checked default value never
 * saves the unchecked state.
 */
if ( array_key_exists( $atts['id'], $this->meta ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/checkbox.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a color field.', 'rosh' );
$atts['id'] 			= 'field-color';
$atts['label'] 			= __( 'Color', 'rosh' );
$atts['name'] 			= 'field-color';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/color.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a date field.', 'rosh' );
$atts['id'] 			= 'field-date';
$atts['label'] 			= __( 'Date', 'rosh' );
$atts['name'] 			= 'field-date';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/date.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is an editor field.', 'rosh' );
$atts['id'] 			= 'field-editor';
$atts['settings'] 		= array( 'class' => '', );

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/editor.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a file uploading field.', 'rosh' );
$atts['id'] 			= 'field-file';
$atts['label'] 			= __( 'File Upload', 'rosh' );
$atts['name'] 			= 'field-file';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/file-upload.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a image uploading field.', 'rosh' );
$atts['id'] 			= 'field-image';
$atts['label'] 			= __( 'Image Upload', 'rosh' );
$atts['name'] 			= 'field-image';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/image-upload.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a menu selection field.', 'rosh' );
$atts['id'] 			= 'field-menu';
$atts['label'] 			= __( 'Menus', 'rosh' );
$atts['name'] 			= 'field-menu';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/select-menu.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a page selection field.', 'rosh' );
$atts['id'] 			= 'field-page';
$atts['label'] 			= __( 'Pages', 'rosh' );
$atts['name'] 			= 'field-page';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/select-page.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a set of radios.', 'rosh' );
$atts['id'] 			= 'field-radios';
$atts['name'] 			= 'field-radios';
$atts['selections'][] 	= array( 'label' => __( 'One', 'rosh' ), 'value' => 'one' );
$atts['selections'][] 	= array( 'label' => __( 'Two', 'rosh' ), 'value' => 'two' );
$atts['selections'][] 	= array( 'label' => __( 'Three', 'rosh' ), 'value' => 'three' );

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/radios.php' );
unset( $atts );

?></p><?php



$atts['aria'] 			= __( 'Select an option.', 'rosh' );
$atts['blank'] 			= __( '- Select -', 'rosh' );
$atts['description'] 	= __( 'This is a select field.', 'rosh' );
$atts['id'] 			= 'field-select';
$atts['label'] 			= __( 'Select', 'rosh' );
$atts['name'] 			= 'field-select';
$atts['selections'][] 	= array( 'label' => __( 'One', 'rosh' ), 'value' => 'one' );
$atts['selections'][] 	= array( 'label' => __( 'Two', 'rosh' ), 'value' => 'two' );
$atts['selections'][] 	= array( 'label' => __( 'Three', 'rosh' ), 'value' => 'three' );

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/select.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a taxonomy selection field.', 'rosh' );
$atts['id'] 			= 'field-tax';
$atts['label'] 			= __( 'Taxonomies', 'rosh' );
$atts['name'] 			= 'field-tax';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/select-taxonomy.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a text field.', 'rosh' );
$atts['id'] 			= 'field-text';
$atts['label'] 			= __( 'Text', 'rosh' );
$atts['name'] 			= 'field-text';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/text.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a textarea field.', 'rosh' );
$atts['id'] 			= 'field-textarea';
$atts['label'] 			= __( 'Textarea', 'rosh' );
$atts['name'] 			= 'field-textarea';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/textarea.php' );
unset( $atts );

?></p><?php



$atts['description'] 	= __( 'This is a time field.', 'rosh' );
$atts['id'] 			= 'field-time';
$atts['label'] 			= __( 'Time', 'rosh' );
$atts['name'] 			= 'field-time';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( 'rosh-field-' . $atts['id'], $atts );

?><p><?php

include( get_stylesheet_directory() . '/template-parts/fields/time.php' );
unset( $atts );

?></p><?php
