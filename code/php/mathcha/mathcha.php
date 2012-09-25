<?php

	$font_face = 'arialbd.ttf';

	$width='80';
	$height='25';
	$font_size = $height * 0.65;

	$image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
	$background_color = imagecolorallocate($image, 0, 0, 0);
    $text_color = imagecolorallocate($image, 255, 255, 255);
    $noise_color = imagecolorallocate($image, 150, 255, 150);


	//create dots
	for( $i=0; $i<($width*$height)/3; $i++ ) {
        imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
	}

	//print text
	$n1 = mt_rand(1,20);
	$n2 = mt_rand(1,20);
	$string = "$n1 + $n2";
	$textbox = imagettfbbox($font_size, 0, $font_face, $string) or die('Error in imagettfbbox function');
    $x = ($width - $textbox[4])/2;
    $y = ($height - $textbox[5])/2;
    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font_face , $string) or die('Error in imagettftext function');


	/* output captcha image to browser */
    header('Content-Type: image/jpeg');
    imagejpeg($image);
    imagedestroy($image);

	$_SESSION['mathcha'] = $n1 + $n2;

?>
