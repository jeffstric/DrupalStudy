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
function reseizeImg_admin_settings( $form , &$form_state )
{
// get node type
    $query = db_select('node_type' , 'nt');
    $result = $query->fields('nt' , array( 'type' , 'name' ))
	    ->execute();

    $options = array( );
    foreach ( $result as $type ) {
	$options[ $type->type ] = $type->name;
    }

// get default value
// if ajax precess , we can get $nodeType , so we can use this to distinguish ajax or the normal
    $nodeType = (isset($form_state[ 'values' ][ 'node_type' ]) ) ? $form_state[ 'values' ][ 'node_type' ] : FALSE;

    $defaultValue = array( );

    if ( !$nodeType ) {
	$query = db_select('node_type' , 'nt');
	$query->join(RESEIZEIMG_TABLENAME , 'ir' , 'nt.type = ir.sir_node_type');
	$query->fields('nt' , array( 'type' , 'name' ))
		->execute();

	if ( count($result) )
	    foreach ( $result as $type ) {
		$defaultValue[ $type->type ] = $type->name;
	    }
    }

    $form[ 'node_type' ] = array(
	'#type' => 'select' ,
	'#title' => t('which node type should reseize') ,
	'#options' => $options ,
	'#default_value' => $defaultValue ,
	'#description' => t('select the node type to resize') ,
	'#ajax' => array(
	    'callback' => 'automobile_dependent_dropdown_callback' ,
	    'wrapper' => 'dropdown_model_replace' ,
	)
    );

    $options = array( );
    if ( $nodeType ) {
	$query = db_select('field_config_instance' , 'fci');
	$result = $query->fields('fci' , array( 'field_name' ))
		->condition('bundle' , $nodeType)
		->execute();

	foreach ( $result as $value ) {
	    $options[ $value->field_name ] = $value->field_name;
	}
    }

    $form[ 'field_type' ] = array(
	'#type' => 'select' ,
	'#title' => t('which field type should reseize') ,
	'#options' => $options ,
	'#default_value' => key($options) ,
	'#description' => t('select the node type to resize') ,
	'#prefix' => '<div id="dropdown_model_replace">' ,
	'#suffix' => '</div>' ,
    );
    $form[ '#submit' ][ ] = 'reseizeImg_admin_settings_submit';

    return system_settings_form($form);
}

function automobile_dependent_dropdown_callback( $form , $form_state )
{
    return $form[ 'field_type' ];
}

/**
 * Process annotation settings submission.
 */
function reseizeImg_admin_settings_submit( $form , $form_state )
{
    $result = db_query('SELECT count(sir_id) AS result FROM `' . RESEIZEIMG_TABLENAME .
	    '` WHERE sir_node_type = :sir_node_type AND sir_image_fieldname = :sir_image_fieldname' , 
	    array(
	':sir_node_type' => $form_state[ 'values' ][ 'node_type' ] ,
	':sir_image_fieldname' => $form_state[ 'values' ][ 'field_type' ]
	    ))->fetch();

    if ( !$result->result ) {
//	$sid = db_insert(RESEIZEIMG_TABLENAME)
//		->fields(array(
//		    'vid' => 1 ,
//		    'punchline' => 'And the pig said oink!' ,
//		))
//		->execute();
    }
}

function reseizeImg_admin_settings_validate( $form , &$form_state )
{
    if ( !isset($form_state[ 'values' ][ 'node_type' ]) ) {
	form_set_error('node_type' , t('You must selct node type'));
    }

    if ( !isset($form_state[ 'values' ][ 'field_type' ]) ) {
	form_set_error('field_type' , t('You must selct field type'));
    }
}