<?php

/**
 *  author  :   jeffstric
 *  email   :   jeffstricg@gmail.com
 *  date    :   Feb 26, 2013
 *  time    :   4:27:46 PM
 * */
function checkGet( $checkParm )
{
    $keys = array_keys($checkParm);
    foreach ( $keys as $k ) {
	if ( checkSet($k) === FALSE ) {
	    throw new Exception('wrong param: ' . $checkParm[ $k ] . '; key: ' . $k);
	}
    }
}

function checkSet( $input )
{
    return isset($_GET[ $input ]) ? $_GET[ $input ] : FALSE;
}

function transferColor( $color )
{
    try {
	if ( strlen($color) == 6 ) {
	    $red = hexdec(substr($color , 0 , 2));
	    $green = hexdec(substr($color , 2 , 2));
	    $blue = hexdec(substr($color , 4 , 2));
	    return array( $red , $green , $blue );
	} else {
	    throw new Exception('color param length illegal');
	}
    } catch ( Exception $e ) {
	throw new Exception('color param illegal; C: ' . $color);
    }
}

$checkParmBasic = array(
    'B' => 'background image' ,
    'N' => 'num of text' ,
);
$checkParmText = array(
    'X' => 'font x postion' ,
    'Y' => 'font y postion' ,
    'S' => 'font size' ,
    'A' => 'font angle' ,
    'C' => 'font color' ,
    'F' => 'font family' ,
    'T' => 'the text to draw'
);
$fonts = array( 'KASNAKE_' );


// test input 
/*
$_GET[ 'N' ] = 3;
$_GET[ 'B' ] = 'C:\wamp\www\DrupalStudy\files\public\imageFactory\tmp\2013\03\05\4365\1362454152.jpg';

$_GET[ 'X0' ] = 30;
$_GET[ 'Y0' ] = 50;
$_GET[ 'S0' ] = 20;
$_GET[ 'A0' ] = 0;
$_GET[ 'C0' ] = 'FFFFFF';
$_GET[ 'F0' ] = 0;
$_GET[ 'T0' ] = 'one';


$_GET[ 'X1' ] = 100;
$_GET[ 'Y1' ] = 100;
$_GET[ 'S1' ] = 20;
$_GET[ 'A1' ] = 0;
$_GET[ 'C1' ] = '00FF00';
$_GET[ 'F1' ] = 0;
$_GET[ 'T1' ] = 'two';

$_GET[ 'X2' ] = 50;
$_GET[ 'Y2' ] = 150;
$_GET[ 'S2' ] = 20;
$_GET[ 'A2' ] = 0;
$_GET[ 'C2' ] = '0000FF';
$_GET[ 'F2' ] = 0;
$_GET[ 'T2' ] = 'three';
 */

try {
//check basic param
    checkGet($checkParmBasic);
//check image exist
    $fileName = $_GET[ 'B' ];
    if ( !file_exists($fileName) ) {
	throw new Exception('image doesn\'t exist');
    }

    /**
     * draw background now 
     */
    list($width , $height , $type) = getimagesize($fileName);
    switch ( $type ) {
	case 1:
	    $im = imagecreatefromgif($fileName);
	    break;
	case 2:
	    $im = imagecreatefromjpeg($fileName);
	    break;
	case 3:
	    $im = imagecreatefrompng($fileName);
	    break;
	default:
	    throw new Exception('illegal image type ');
	    break;
    }
// Create some colors
    $grey = imagecolorallocate($im , 128 , 128 , 128);

//get the number of texts
    $textNum = $_GET[ 'N' ];
    if ( count($textNum) ) {
	for ( $i = 0; $i < $textNum; $i++ ) {
	    //prepare checkParm to check the text param 
	    $checkParms = array( );
	    foreach ( $checkParmText as $key => $value ) {
		$checkParms[ $key . $i ] = $value;
	    }
	    //check text param
	    checkGet($checkParms);
	    //check text font family 
	    if ( $_GET[ 'F' . $i ] > count($fonts) - 1 ) {
		throw new Exception('illegal font param: ' . $checkParms[ 'F' . $i ] . '; key: ' . 'F' . $i);
	    }

	    //get font color
	    $fontColorArray = transferColor($_GET[ 'C' . $i ]);
	    $fontColor = imagecolorallocate($im , $fontColorArray[ 0 ] , $fontColorArray[ 1 ] , $fontColorArray[ 2 ]);

	    // Replace path by your own font path
	    $font = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'font/' . $fonts[ $_GET[ 'F' . $i ] ] . '.ttf';
	    if ( file_exists($font) ) {
		// Add some shadow to the text
		imagettftext($im , $_GET[ 'S' . $i ] , $_GET[ 'A' . $i ] , $_GET[ 'X' . $i ] + 2 , $_GET[ 'Y' . $i ] + 2 , $grey , $font , $_GET[ 'T' . $i ]);
		// Add the text
		imagettftext($im , $_GET[ 'S' . $i ] , $_GET[ 'A' . $i ] , $_GET[ 'X' . $i ] , $_GET[ 'Y' . $i ] , $fontColor , $font , $_GET[ 'T' . $i ]);
	    } else {
		throw new Exception('font dosen\'t exist!');
	    }
	}
    }

    header('Content-Type: image/png');
    imagepng($im);
    imagedestroy($im);
} catch ( Exception $e ) {
    echo $e->getMessage();
}