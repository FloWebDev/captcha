<?php

session_start();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// https://www.php.net/manual/fr/function.imagettftext.php#48938
// Put center-rotated ttf-text into image
// Same signature as imagettftext();

function imagettftext_cr($img, $size, $angle, $x, $y, $color, $fontfile, $text)
{
    // retrieve boundingbox
    $bbox = imagettfbbox($size, $angle, $fontfile, $text);
    
    // calculate deviation
    $dx = ($bbox[2]-$bbox[0])/2.0 - ($bbox[2]-$bbox[4])/2.0;         // deviation left-right
    $dy = ($bbox[3]-$bbox[1])/2.0 + ($bbox[7]-$bbox[1])/2.0;        // deviation top-bottom
    
    // new pivotpoint
    $px = $x-$dx;
    $py = $y-$dy;
    
    return imagettftext($img, $size, $angle, $px, $py, $color, $fontfile, $text);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$_SESSION['captcha'] = mt_rand(1000,9999);
$img = imagecreate(100, 30);
$font = 'fonts/destroy.ttf';

// RGB colors
$bg = imagecolorallocate($img, 220, 220, 220); // automatiquement la couleur de fond car 1ère couleur déclarée
$textcolor = imagecolorallocate($img, 0, 0, 0);

imagettftext_cr($img, 10, 0, 50, 12, $textcolor, $font, $_SESSION['captcha']);

header('Content-type:image/jpeg');
imagejpeg($img);
imagedestroy($img);


