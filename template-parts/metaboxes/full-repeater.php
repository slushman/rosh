<?php
/**
 * The markup for the Repeater metabox.
 *
 * @package 		Rosh
 */

wp_nonce_field( PARENT_THEME_SLUG, 'nonce_rosh_full_repeater' );

$atts['name'] 							= 'full-repeater';
$props['description'] 					= __( 'This repeating field is used for displaying blah blah. The Text Field above is also the name of the field.', 'rosh' );
$props['labels']['add'] 				= __( 'Add Fields', 'rosh' );
$props['labels']['edit'] 				= __( 'Edit Fields', 'rosh' );
$props['labels']['header'] 				= __( 'Fields', 'rosh' );
$props['labels']['remove'] 				= __( 'Remove Fields', 'rosh' );



$fields[0]['atts']['type'] 			= 'checkbox';
$fields[0]['atts']['name'] 			= 'full-peat-checkbox';
$fields[0]['props']['description'] 	= __( 'This is a checkbox.', 'rosh' );

$fields[1]['atts']['id'] 			= 'full-peat-color';
$fields[1]['atts']['name'] 			= 'full-peat-color';
$fields[1]['atts']['type'] 			= 'color';
$fields[1]['props']['description'] 	= __( 'This is a color field.', 'rosh' );
$fields[1]['props']['label'] 		= __( 'Color', 'rosh' );

$fields[2]['atts']['id'] 			= 'full-peat-date';
$fields[2]['atts']['name'] 			= 'full-peat-date';
$fields[2]['atts']['type'] 			= 'date';
$fields[2]['props']['description'] 	= __( 'This is a date field.', 'rosh' );
$fields[2]['props']['label'] 		= __( 'Date', 'rosh' );

$fields[3]['atts']['id'] 			= 'full-peat-editor';
$fields[3]['atts']['type'] 			= 'editor';
$fields[3]['props']['description'] 	= __( 'This is an editor field.', 'rosh' );
$fields[3]['props']['label'] 		= __( 'Editor', 'rosh' );

$fields[4]['atts']['id'] 			= 'full-peat-file';
$fields[4]['atts']['name'] 			= 'full-peat-file';
$fields[4]['atts']['type'] 			= 'file-upload';
$fields[4]['props']['label'] 		= __( 'File Field', 'rosh' );

$fields[5]['atts']['id'] 			= 'full-peat-image';
$fields[5]['atts']['name'] 			= 'full-peat-image';
$fields[5]['atts']['type'] 			= 'image-upload';
$fields[5]['props']['label'] 		= __( 'Image Field', 'rosh' );

$fields[6]['atts']['id'] 			= 'full-peat-radios';
$fields[6]['atts']['name'] 			= 'full-peat-radios';
$fields[6]['atts']['type'] 			= 'radio';
$fields[6]['props']['description'] 	= __( 'This is a set of radios.', 'rosh' );
$fields[6]['props']['selections'][] 	= array( 'label' => __( 'One', 'rosh' ), 'value' => 'one' );
$fields[6]['props']['selections'][] 	= array( 'label' => __( 'Two', 'rosh' ), 'value' => 'two' );
$fields[6]['props']['selections'][] 	= array( 'label' => __( 'Three', 'rosh' ), 'value' => 'three' );

$fields[7]['atts']['id'] 			= 'full-peat-menu';
$fields[7]['atts']['name'] 			= 'full-peat-menu';
$fields[7]['atts']['type'] 			= 'select-menu';
$fields[7]['props']['description'] 	= __( 'This is a menu selection field.', 'rosh' );
$fields[7]['props']['label'] 		= __( 'Menus', 'rosh' );

$fields[8]['atts']['id'] 			= 'full-peat-page';
$fields[8]['atts']['name'] 			= 'full-peat-page';
$fields[8]['atts']['type'] 			= 'select-page';
$fields[8]['props']['description'] 	= __( 'This is a page selection field.', 'rosh' );
$fields[8]['props']['label'] 		= __( 'Pages', 'rosh' );

$fields[9]['atts']['id'] 			= 'full-peat-select';
$fields[9]['atts']['name'] 			= 'full-peat-select';
$fields[9]['atts']['type'] 			= 'select';
$fields[9]['props']['description'] 	= __( 'Select an option.', 'rosh' );
$fields[9]['props']['label'] 		= __( 'Select Menu', 'rosh' );
$fields[9]['props']['selections'][] 	= array( 'label' => __( 'One', 'rosh' ), 'value' => 'one' );
$fields[9]['props']['selections'][] 	= array( 'label' => __( 'Two', 'rosh' ), 'value' => 'two' );
$fields[9]['props']['selections'][] 	= array( 'label' => __( 'Three', 'rosh' ), 'value' => 'three' );

$fields[10]['atts']['id'] 			= 'full-peat-tax';
$fields[10]['atts']['name'] 		= 'full-peat-tax';
$fields[10]['atts']['type'] 		= 'select-taxonomy';
$fields[10]['props']['description'] = __( 'This is a taxonomy selection field.', 'rosh' );
$fields[10]['props']['label'] 		= __( 'Taxonomies', 'rosh' );

$fields[11]['atts']['class'] 		= 'widefat repeater-title';
$fields[11]['atts']['id'] 			= 'full-peat-text';
$fields[11]['atts']['name'] 		= 'full-peat-text';
$fields[11]['atts']['type'] 		= 'text';
$fields[11]['props']['description'] = __( 'Text Field Description', 'rosh' );
$fields[11]['props']['label'] 		= __( 'Text Field', 'rosh' );

$fields[12]['atts']['id'] 			= 'full-peat-textarea';
$fields[12]['atts']['name'] 		= 'full-peat-textarea';
$fields[12]['atts']['type'] 		= 'textarea';
$fields[12]['props']['description'] = __( 'This is a textarea.', 'rosh' );
$fields[12]['props']['label'] 		= __( 'Textarea', 'rosh' );

$fields[13]['atts']['id'] 			= 'full-peat-time';
$fields[13]['atts']['name'] 		= 'full-peat-time';
$fields[13]['atts']['type'] 		= 'time';
$fields[13]['props']['description'] = __( 'This is a time field.', 'rosh' );
$fields[13]['props']['label'] 		= __( 'Time', 'rosh' );

if ( empty( $this->meta[$atts['name']] ) ) {

	$atts['value'] = array();

} else {

	$atts['value'] = $this->meta[$atts['name']][0];

}


//echo '<pre>'; print_r( $atts['value'] ); echo '</pre>';

$atts 	= apply_filters( 'rosh-field-atts-' . $atts['name'], $atts, $props );
$props 	= apply_filters( 'rosh-field-props-' . $atts['name'], $props, $atts );
$group 	= new Rosh_Field_Group( 'repeater', $atts, $props, $fields );
$group->display_group();

unset( $atts );
unset( $props );
unset( $fields );
unset( $group );
