<?php

/**
 *  author  :   jeffstric
 *  email   :   jeffstricg@gmail.com
 *  date    :   Oct 23, 2012
 *  time    :   10:06:32 AM
 * */
/**
 * @file
 * Administration page callbacks for the image reseize module.
 */

/**
 * Form builder. Configure annotations.
 *
 * @ingroup forms
 * @see system_settings_form().
 */
function reseizeImg_add_settings( $form , &$form_state )
{
// get node type
    $query = db_select('node_type' , 'nt');
    $result = $query->fields('nt' , array( 'type' , 'name' ))
	    ->execute();

    $options = array( );
    foreach ( $result as $type ) {
	$options[ $type->type ] = $type->name;
    }

    $form[ 'node_type' ] = array(
	'#type' => 'select' ,
	'#title' => t('which node type should reseize') ,
	'#options' => $options ,
	'#default_value' => array( ) ,
	'#required' => TRUE ,
	'#description' => t('select the node type to resize') ,
	'#ajax' => array(
	    'callback' => 'automobile_dependent_dropdown_callback' ,
	    'wrapper' => 'dropdown_model_replace' ,
	)
    );

    // if ajax precess , we can get $nodeType , so we can use this to distinguish ajax or the normal
    $nodeType = (isset($form_state[ 'values' ][ 'node_type' ]) ) ? $form_state[ 'values' ][ 'node_type' ] : key($options);
    $options = array( );

    $query = db_select('field_config_instance' , 'fci');
    $result = $query->fields('fci' , array( 'field_name' ))
	    ->condition('bundle' , $nodeType)
	    ->execute();

    foreach ( $result as $value ) {
	$options[ $value->field_name ] = $value->field_name;
    }


    $form[ 'field_type' ] = array(
	'#type' => 'select' ,
	'#title' => t('which field type should reseize') ,
	'#options' => $options ,
	'#default_value' => key($options) ,
	'#required' => TRUE ,
	'#description' => t('select the node type to resize') ,
	'#prefix' => '<div id="dropdown_model_replace">' ,
	'#suffix' => '</div>' ,
    );

    $form[ 'width' ] = array(
	'#title' => t('width') ,
	'#type' => 'textfield' ,
	'#description' => t('Enter the width of resize image.') ,
	'#default_value' => '' ,
	'#required' => TRUE ,
	'#size' => 15 ,
    );
    $form[ 'height' ] = array(
	'#title' => t('height') ,
	'#type' => 'textfield' ,
	'#description' => t('Enter the height of resize image.') ,
	'#default_value' => '' ,
	'#required' => TRUE ,
	'#size' => 15 ,
    );
    $form[ '#submit' ][ ] = 'reseizeImg_add_settings_submit';

    return system_settings_form($form);
}

function automobile_dependent_dropdown_callback( $form , $form_state )
{
    return $form[ 'field_type' ];
}

/**
 * Process annotation settings submission.
 */
function reseizeImg_add_settings_submit( $form , $form_state )
{
    $result = db_query('SELECT count(sir_id) AS result FROM `' . RESEIZEIMG_TABLENAME .
	    '` WHERE sir_node_type = :sir_node_type AND sir_image_fieldname = :sir_image_fieldname' , array(
	':sir_node_type' => $form_state[ 'values' ][ 'node_type' ] ,
	':sir_image_fieldname' => $form_state[ 'values' ][ 'field_type' ]
	    ))->fetch();

    if ( !$result->result ) {
	$sid = db_insert(RESEIZEIMG_TABLENAME)
		->fields(array(
		    'sir_node_type' => $form_state[ 'values' ][ 'node_type' ] ,
		    'sir_image_fieldname' => $form_state[ 'values' ][ 'field_type' ] ,
		    'sir_thumb_width' => $form_state[ 'values' ][ 'width' ] ,
		    'sir_thumb_height' => $form_state[ 'values' ][ 'height' ] ,
		))
		->execute();
    }
}

function reseizeImg_add_settings_validate( $form , &$form_state )
{

    if ( !is_numeric($form_state[ 'values' ][ 'width' ]) ) {
	form_set_error('width' , t('You must enter number for width field'));
    }

    if ( !is_numeric($form_state[ 'values' ][ 'height' ]) ) {
	form_set_error('width' , t('You must enter number for height field'));
    }
}