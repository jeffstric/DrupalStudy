<?php

class ThearchyImg
{

    private $width;
    private $height;
    private $filetype;
    private $attr;
    private $srcpath;

    public function __construct( $srcpath = null )
    {
	if ( is_null($srcpath) ) {
	    $this->srcpath = null;
	} else {
	    $this->srcpath = $srcpath;
	    list($this->width , $this->height , $this->filetype , $this->attr) = getimagesize($srcpath);
	}
    }

    public function getWidth()
    {
	return $this->width;
    }

    public function getHeight()
    {
	return $this->height;
    }

    /**
     *
     * @return 1:gif; 2:jpg; 3:png
     */
    public function getFileType()
    {
	return $this->filetype;
    }

    public function getAttr()
    {
	return $this->attr;
    }

    public function resize( $savepath , $srcpath = null , $maxwidth , $maxheight )
    {
	if ( is_null($srcpath) ) {
	    if ( is_null($this->srcpath) ) {
		throw new Exception("Img::resize() parameter error!");
	    } else {
		$srcpath = $this->srcpath;
	    }
	}

	if ( function_exists("getimagesize") ) {
	    list($width , $height , $filetype , $attr) = getimagesize($srcpath);
	} else {
	    throw new Exception("function 'getimagesize' can't use");
	    return false;
	}

	if ( $filetype == 2 ) {
	    $im = imagecreatefromjpeg($srcpath);
	} else if ( $filetype == 1 ) {
	    $im = imagecreatefromgif($srcpath);
	} else if ( $filetype == 3 ) {
	    $im = imagecreatefrompng($srcpath);
	} else {
	    return false;
	}

	$width = imagesx($im);
	$height = imagesy($im);
	if ( !isset($RESIZEWidTH) )
	    $RESIZEWidTH = NULL;
	if ( !isset($RESIZEHEIGHT) )
	    $RESIZEHEIGHT = NULL;
	if ( ($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight) ) {
	    if ( $maxwidth && $width > $maxwidth ) {
		$widthratio = $maxwidth / $width;
		$RESIZEWidTH = true;
	    }
	    if ( $maxheight && $height > $maxheight ) {
		$heightratio = $maxheight / $height;
		$RESIZEHEIGHT = true;
	    }
	    if ( $RESIZEWidTH && $RESIZEHEIGHT ) {
		if ( $widthratio < $heightratio ) {
		    $ratio = $widthratio;
		} else {
		    $ratio = $heightratio;
		}
	    } else if ( $RESIZEWidTH ) {
		$ratio = $widthratio;
	    } else if ( $RESIZEHEIGHT ) {
		$ratio = $heightratio;
	    }
	    $newwidth = $width * $ratio;
	    $newheight = $height * $ratio;
	} else {
	    $newwidth = $width;
	    $newheight = $height;
	}

	$newim = imagecreatetruecolor($maxwidth , $maxheight);
	$background = imagecolorallocate($newim , 255 , 255 , 255);
	imagefill($newim , 0 , 0 , $background);

	$newheight = round($newheight);
	$newwidth = round($newwidth);
	$maxheight = round($maxheight);
	$maxwidth = round($maxwidth);

	$y = intval(( $maxheight - $newheight ) / 2);
	$x = intval(( $maxwidth - $newwidth ) / 2);

	imagecopyresampled($newim , $im , $x , $y , 0 , 0 , $newwidth , $newheight , $width , $height);

	if ( imageJpeg($newim , $savepath) === false ) {
	    return false;
	}
	imageDestroy($newim);
	imageDestroy($im);
	return true;
    }

}