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
	    array( 400 , 400 ) ,
	    array( 195 , 217 ) , //shop guide denim
	    array( 293 , 506 ) , //shop guide slide show
	    array( 143 , 150 ) , //shop guide get look
	    array( 237 , 307 ) , //shop guide get look
	    /* shop guide fall fashion start */
	    array( 215 , 353 ) ,
	    array( 250 , 275 ) ,
	    array( 325 , 654 ) ,
	    array( 160 , 160 ) ,
	    array( 170 , 170 ) ,
	    /* shop guide fall fashion end */
	    /* shop guide eco friendly start */
	    array( 420 , 420 ) ,
	    array( 340 , 340 ) ,
	    array( 380 , 380 ) ,
	    /* shop guide eco friendly end */
	    /* shop guide women essential start */
	    array( 113 , 184 ) ,
	    array( 338 , 600 ) ,
	    array( 200 , 150 ) ,
	    array( 116 , 165 ) ,
	    array( 125 , 166 ) ,
	    array( 231 , 264 ) ,
	/* shop guide women essential end */
);