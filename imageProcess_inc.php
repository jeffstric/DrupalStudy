<?php

define('IMAGES_IMPROVE_DIR_NAME' , 'imagesi');
/* example
 *   /sites 
 *   '/../ dirname' to upper directory
 * 
 *  attention: make sure writable of directory
 */
define('IMG_DIR_RELATIVE' , '');
//NEED NOT CONFIGURATE BELOW
$DEFAULT_IMAGE = 'files/public/system/default.png';
$ERROR_IMAGE = 'files/public/system/error.jpg';
define('IMG_DIR_ABSOLUTE' , realpath(dirname(__FILE__) . IMG_DIR_RELATIVE));
define('DEFAULT_IMAGE' , IMG_DIR_ABSOLUTE . DIRECTORY_SEPARATOR . $DEFAULT_IMAGE);
define('ERROR_IMAGE' , IMG_DIR_ABSOLUTE . DIRECTORY_SEPARATOR . $ERROR_IMAGE);

if ( !is_dir(IMG_DIR_ABSOLUTE) ) {
    throw new Exception('image directory is not illegal directory');
}

$illegalSize =
	array(
	    //EXAMPLE: array(10,20)  mean width 10px, height 20px
	    //NOTE: if the size is not match , first array will  be the default size
	    array( 50 , 50 ) ,
	    array( 100 , 100 ) ,
	    array( 200 , 200 ) ,
	    array( 195 , 217 ) ,//shop guide denim
	    array( 293 , 506 ) ,//shop guide slide show
	    array( 400 , 400 ) ,
);