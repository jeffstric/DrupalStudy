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

	    /* shop guide get look start */
	    array( 143 , 150 ) ,
	    array( 237 , 307 ) ,
	    /* shop guide get look end */

	    /* shop guide fall fashion start */
	    array( 215 , 353 ) ,
	    array( 250 , 275 ) ,
	    array( 325 , 654 ) ,
	    array( 170 , 170 ) ,
//	    array( 200 , 200 ) ,
	    array( 160 , 160 ) ,
	    /* shop guide fall fashion end */

	    /* shop guide eco friendly start */
	    array( 420 , 420 ) ,
	    array( 340 , 340 ) ,
	    array( 380 , 380 ) ,
	    /* shop guide eco friendly end */

	    /* shop guide women essential start */
	    array( 113 , 184 ) ,
//	    array( 200 , 200 ) ,
	    array( 338 , 600 ) ,
	    array( 198 , 142 ) ,
	    array( 116 , 165 ) ,
	    array( 125 , 166 ) ,
	    array( 231 , 264 ) ,
	    /* shop guide women essential end */

	    /* shop guide Chic Geek start */
	    array( 280 , 280 ) , //*2
	    array( 361 , 292 ) ,
	    array( 250 , 250 ) ,
	    array( 260 , 260 ) ,
	    array( 220 , 220 ) ,
	    /* shop guide Chic Geek end */

	    /* shop guide man_tripping start */
	    array( 290 , 290 ) ,
	    array( 250 , 250 ) ,
	    array( 265 , 265 ) ,
	    array( 260 , 630 ) ,
	    array( 140 , 140 ) ,
	    array( 205 , 205 ) ,
	    array( 315 , 315 ) ,
	    /* shop guide man_tripping end */

	    /* shop guide thanksgiving  end */
	    array( 221 , 164 ) ,
	    array( 134 , 130 ) ,
	    array( 177 , 184 ) ,
	    array( 150 , 158 ) ,
	    array( 147 , 155 ) ,
	    array( 150 , 150 ) ,
	    /* shop guide thanksgiving  end */

	    /* shop guide ten stuffer   start */
	    array( 190 , 172 ) ,
	    array( 237 , 213 ) ,
	    array( 368 , 352 ) ,
	    array( 173 , 400 ) ,
	    array( 171 , 155 ) ,
	    array( 273 , 194 ) ,
	    array( 114 , 118 ) ,
	    array( 143 , 90 ) ,
	    array( 237 , 195 ) ,
	    array( 247 , 271 ) ,
	    /* shop guide ten stuffer  end */

	    /* shop guide want it now start */
	    array( 215 , 190 ) , //*3
	    array( 270 , 469 ) ,
	    /* shop guide want it now end */
	    /* shop guide sale module b  start */
	    array( 206 , 210 ) , //*3
	    array( 317 , 737 ) ,
	/* shopguide sale module b start */
);