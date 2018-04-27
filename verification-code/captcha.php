<?php
	session_start();

	$image = imagecreatetruecolor(100, 30);
	$bgcolor = imagecolorallocate($image, 255, 255, 255);
	imagefill($image, 0, 0, $bgcolor);

/*	for ($i=0; $i<4; $i++) {
		$fontsize = 6;
		$fontcolor = imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));
		$fontcontent = rand(0, 9);
		$x = ($i*100/4) + rand(0, 10);
		$y = rand(0, 20);
		imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
	}*/
	$captch_code = '';
	for ($i=0; $i<4; $i++) {
		$fontsize = 6;
		$fontcolor = imagecolorallocate($image, rand(0, 150), rand(0, 150), rand(0, 150));
		$data = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$fontcontent = substr($data, rand(0, strlen($data)-1), 1);
		$captch_code .= $fontcontent;

		$x = ($i*100/4) + rand(0, 10);
		$y = rand(0, 18);
		imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
	}
	$_SESSION['authcode'] = $captch_code;

	for ($i=0; $i<200; $i++) {
		$pointcolor = imagecolorallocate($image, rand(100, 250), rand(100, 250), rand(100, 250));
		imagesetpixel($image, rand(1, 100), rand(1, 30), $pointcolor);
	}

	for ($i=0; $i<3; $i++) {
		$linecolor = imagecolorallocate($image, rand(80, 220), rand(80, 220), rand(80, 220));
		imageline($image, rand(1, 100), rand(1, 30), rand(1, 100), rand(1, 30), $linecolor);
	}
	header('content-type: image/png');
	imagepng($image);

	imagedestory($image); 