<?php

/**
 *  author  :   jeffstric
 *  email   :   jeffstricg@gmail.com
 *  date    :   2013-3-11
 *  time    :   23:46:10
 * */
function imageFactory_fileUploadForm_validate( $form , &$form_state )
{
  if ( !imageFactory_checkFileName($_FILES[ 'files' ][ 'name' ][ IMAGEFACTORY_FORMKEY ]) )
    form_set_error(IMAGEFACTORY_FORMKEY , t('File name should only allow character or \'_\''));
}

function imageFactory_fileUploadForm_submit( $form , &$form_state )
{
  $validators = array(
      'file_validate_extensions' => array( 'jpg png gif' ) ,
  );
  $destinationPath = imageFactory_getDir('upload');

  $file = file_save_upload(IMAGEFACTORY_FORMKEY , $validators , $destinationPath);
  if ( $file ) {
    $file->status = 1;
    try {
      file_save($file);
      drupal_set_message(t('upload file success!'));
    } catch ( Exception $e ) {
      drupal_set_message($e->getMessage());
    }
  }

  drupal_goto('admin/imageFactory/list');
}

function imageFactory_fontsUploadForm_validate( $form , &$form_state )
{
  if ( !imageFactory_checkFileName($_FILES[ 'files' ][ 'name' ][ IMAGEFACTORY_FORMKEY ]) )
    form_set_error(IMAGEFACTORY_FORMKEY , t('File name should only allow character or \'_\''));
}

function imageFactory_fontsUploadForm_submit( $form , &$form_state )
{
  $validators = array(
      'file_validate_extensions' => array( 'ttf' ) ,
  );
  $destinationPath = imageFactory_getDir('fonts' , FALSE , FALSE);

  $file = file_save_upload(IMAGEFACTORY_FORMKEY , $validators , $destinationPath);
  if ( $file ) {
    try {
      file_save($file);
      drupal_set_message(t('upload fonts success!'));
    } catch ( Exception $e ) {
      drupal_set_message($e->getMessage());
    }
  }

  //create fonts picture
  if ( imageFacory_fontsImageCreate() ) {
    drupal_set_message('fonts pic create success');
  }

  drupal_goto('admin/imageFactory/fonts');
}

function imageFactory_checkFileName( $fileName )
{
  return !preg_match('{[^\w\_]\.(?:jpg|jpeg|png|gif)$}i' , $fileName);
}