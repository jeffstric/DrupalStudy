<?php

/**
 *  author  :   jeffstric
 *  email   :   jeffstricg@gmail.com
 *  date    :   2013-3-11
 *  time    :   23:46:10
 * */
function imageFactory_fileUploadForm_validate( $form , &$form_state )
{
  if ( preg_match('|[^\w\_\-\.]|i' , $_FILES[ 'files' ][ 'name' ][ 'picture' ]) ) {
    form_set_error('picture' , t('File name should only allow character , \' -\' and \'_\''));
  }
}

function imageFactory_fileUploadForm_submit( $form , &$form_state )
{
  $validators = array(
      'file_validate_extensions' => array( 'jpg png gif' ) ,
  );
  $destinationPath = imageFactory_getDir('upload');

  $file = file_save_upload('picture' , $validators , $destinationPath);
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
  if ( preg_match('|[^\w\_\-\.]|i' , $_FILES[ 'files' ][ 'name' ][ 'fonts' ]) ) {
    form_set_error('fonts' , t('File name should only allow character \'-\' and \'_\''));
  }
  $_FILES[ 'files' ][ 'name' ][ 'fonts' ] = strtolower($_FILES[ 'files' ][ 'name' ][ 'fonts' ]);
}

function imageFactory_fontsUploadForm_submit( $form , &$form_state )
{
  $validators = array(
      'file_validate_extensions' => array( 'ttf' ) ,
  );
  $destinationPath = imageFactory_getDir('fonts' , FALSE , FALSE);

  $file = file_save_upload('fonts' , $validators , $destinationPath);
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
