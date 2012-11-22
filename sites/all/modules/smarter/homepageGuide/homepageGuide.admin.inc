<?php

/**
 *  author  :   jeffstric
 *  email   :   jeffstricg@gmail.com
 *  date    :   Oct 23, 2012
 *  time    :   10:06:32 AM
 * */
/**
 * @file
 * Administration page callbacks for the annotate module.
 */

/**
 * Form builder. Configure annotations.
 *
 * @ingroup forms
 * @see system_settings_form().
 */
function homepageGuide_admin_settings()
{
// Get an array of node types with internal names as keys and
    $nodes = node_load_multiple(array( ) , array( 'type' => TOPIC_ARTICLE_TYPE ));
    foreach ( $nodes as $node ) {
	$options[ $node->nid ] = l($node->title , 'node/' . $node->nid , array( 'attributes' => array( 'target' => '_blank' ) ));
    }
    $form[ 'guide_selected' ] = array(
	'#type' => 'checkboxes' ,
	'#title' => t('which article to show in homepage') ,
	'#options' => $options ,
	'#default_value' => variable_get(VARIABLE_GUIDE_NAME , array( )) ,
	'#description' => t('select guide show in homepage') ,
    );
    $form[ '#submit' ][ ] = 'homepageGuide_admin_settings_submit';
    return system_settings_form($form);
}

/**
 * Process annotation settings submission.
 */
function homepageGuide_admin_settings_submit( $form , $form_state )
{
    if(isset($form_state['guideSelected'])){
	variable_set(VARIABLE_GUIDE_NAME , $form_state['guideSelected']);
    }
}

function homepageGuide_admin_settings_validate( $form , &$form_state )
{
    $guide = $form_state[ 'values' ][ 'guide_selected' ];
    $selectGuide = array( );
    foreach ( $guide as $value ) {
	if ( $value )
	    array_push($selectGuide , $value);
    }
    if ( count($selectGuide) != 6 ) {
	form_set_error('guide_selected' , t('You must selct six articles'));
    }
    $form_state['guideSelected'] = $selectGuide;
}