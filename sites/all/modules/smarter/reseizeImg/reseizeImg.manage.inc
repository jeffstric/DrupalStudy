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


function automobile_dependent_dropdown_callback( $form , $form_state )
{
    return $form[ 'field_type' ];
}

/**
 * Process annotation settings submission.
 */
function reseizeImg_manage_settings_submit( $form , $form_state )
{
    $result = db_query('SELECT count(sir_id) AS result FROM {' . RESEIZEIMG_TABLENAME .
	    '} WHERE sir_node_type = :sir_node_type AND sir_image_fieldname = :sir_image_fieldname' , array(
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
    drupal_goto('admin/config/media/reseizeImg/list'); 
}

function reseizeImg_manage_settings_validate( $form , &$form_state )
{

    if ( !is_numeric($form_state[ 'values' ][ 'width' ]) ) {
	form_set_error('width' , t('You must enter number for width field'));
    }

    if ( !is_numeric($form_state[ 'values' ][ 'height' ]) ) {
	form_set_error('width' , t('You must enter number for height field'));
    }
}