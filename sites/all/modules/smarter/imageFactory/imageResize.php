<?php

/**
 * author:jeffstric
 * email:jeffstricg@gmail.com
 * blog:jeffsc.info
 * datetime:2012-6-27, 20:28:03
 * */
class imageJeff
{

  private static $c1 = 255;
  private static $c2 = 255;
  private static $c3 = 255;

  public static function reseizeImage( $imageFrom , $imageToPath , $widthTo , $heightTo , $top , $left , &$error = '' ){
    if (!preg_match('|[\\\/]|' , substr($imageToPath , -1 , 0))) {
      $imageToPath .= '/';
    }

    $fileNameSrc = explode('.' , $imageFrom);
    $extName = array_pop($fileNameSrc);
    $fileOutput = $imageToPath . time() . '.' . $extName;

    if (file_exists($imageFrom)) {
      list($width , $height , $type) = getimagesize($imageFrom);

      $imFrom = false;

      switch ($type) {
        case 1:
          $imFrom = @imagecreatefromgif($imageFrom);
          break;
        case 2:
          $imFrom = @imagecreatefromjpeg($imageFrom);
          break;
        case 3:
          $imFrom = @imagecreatefrompng($imageFrom);
          break;
        default:
          throw new Exception('wrong type image');
          break;
      }

      if ($imFrom) {
        $imTo = imagecreatetruecolor($widthTo , $heightTo);
        $color = imagecolorallocate($imTo , self::$c1 , self::$c2 , self::$c3);
        imagefill($imTo , 0 , 0 , $color);

//                 echo 'width:'.$widthTo." height:".$heightTo.' top:'.$top.' left:'.$left;
        $copyResult = imagecopyresampled($imTo , $imFrom , 0 , 0 , $left , $top , $widthTo , $heightTo , $widthTo , $heightTo);

        if ($copyResult) {
          $return = false;
          switch ($type) {
            case 1:
              $return = imagegif($imTo , $fileOutput);
              break;
            case 2:
              $return = imagejpeg($imTo , $fileOutput);
              break;
            case 3:
              $return = imagepng($imTo , $fileOutput);
              break;
            default:
              throw new Exception('wrong type image');
              break;
          }

          imagedestroy($imFrom);
          imagedestroy($imTo);

          if ($return) {
            return $fileOutput;
          } else {
            $error = 'create image fail';
          }
        } else {
          $error = 'copy image fail';
        }
      } else {
        $error = 'create im image fail';
      }
    } else {
      $error = 'Target file dosen\'t exist';
    }

    return FALSE;
  }

  private function getRadio( $widthFrom , $heightFrom , $widthTo , $heightTo , &$whichRadio = '' ){
    $radioWidth = $widthTo / $widthFrom;
    $radioHeigt = $heightTo / $heightFrom;

    $radio = false;
    $whichRadio = false;

    if (($heightFrom > $heightTo) || ($widthFrom > $widthTo)) {

      if ($radioWidth < $radioHeigt) {
        $radio = $radioWidth;
        $whichRadio = 'w';
      } else {
        $radio = $radioHeigt;
        $whichRadio = 'h';
      }
    }

    return $radio;
  }

}
