<?php

	session_start();
	$table = array(
		'pic0' => '狮',
		'pic1' => '鹅',
		'pic2' => '猫',
		'pic3' => '兔',
		'pic4' => '象'
	);

	$index = rand(0, count($table)-1);

	$value = $table['pic' . $index];
	$_SESSION['authcode'] = $value;

	$filename = dirname(__FILE__) . '\\images\\pic' . $index . '.jpg';
	$contents = file_get_contents($filename);

	header('Content-Type: image/jpg');
	echo $contents;