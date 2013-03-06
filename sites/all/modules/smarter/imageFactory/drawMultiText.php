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
    return isset($_POST[ $input ]) ? $_POST[ $input ] : FALSE;
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

// test input 
/*
  $_POST[ 'N' ] = 3;
  $_POST[ 'B' ] = 'C:\wamp\www\DrupalStudy\files\public\imageFactory\tmp\2013\03\05\4365\1362454152.jpg';

  $_POST[ 'X0' ] = 30;
  $_POST[ 'Y0' ] = 50;
  $_POST[ 'S0' ] = 20;
  $_POST[ 'A0' ] = 0;
  $_POST[ 'C0' ] = 'FFFFFF';
  $_POST[ 'F0' ] = 0;
  $_POST[ 'T0' ] = 'one';

  $_POST[ 'X1' ] = 100;
  $_POST[ 'Y1' ] = 100;
  $_POST[ 'S1' ] = 20;
  $_POST[ 'A1' ] = 0;
  $_POST[ 'C1' ] = '00FF00';
  $_POST[ 'F1' ] = 0;
  $_POST[ 'T1' ] = 'two';

 */
function drawTextOnPic( $outputPic )
{
    $fonts = array( 'KASNAKE_' );
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
    try {
//check basic param
	checkGet($checkParmBasic);
//check image exist
	$fileName = $_POST[ 'B' ];
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
	$textNum = $_POST[ 'N' ];
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
		if ( $_POST[ 'F' . $i ] > count($fonts) - 1 ) {
		    throw new Exception('illegal font param: ' . $checkParms[ 'F' . $i ] . '; key: ' . 'F' . $i);
		}

		//get font color
		$fontColorArray = transferColor($_POST[ 'C' . $i ]);
		$fontColor = imagecolorallocate($im , $fontColorArray[ 0 ] , $fontColorArray[ 1 ] , $fontColorArray[ 2 ]);

		// Replace path by your own font path
		$font = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'font/' . $fonts[ $_POST[ 'F' . $i ] ] . '.ttf';
		if ( file_exists($font) ) {
		    // Add some shadow to the text
		    imagettftext($im , $_POST[ 'S' . $i ] , $_POST[ 'A' . $i ] , $_POST[ 'X' . $i ] + 2 , $_POST[ 'Y' . $i ] + 2 , $grey , $font , $_POST[ 'T' . $i ]);
		    // Add the text
		    imagettftext($im , $_POST[ 'S' . $i ] , $_POST[ 'A' . $i ] , $_POST[ 'X' . $i ] , $_POST[ 'Y' . $i ] , $fontColor , $font , $_POST[ 'T' . $i ]);
		} else {
		    throw new Exception('font dosen\'t exist!');
		}
	    }
	}

//	header('Content-Type: image/png');
	$result = imagepng($im , $outputPic);
	imagedestroy($im);
	return $result;
    } catch ( Exception $e ) {
	echo $e->getMessage();
    }
}