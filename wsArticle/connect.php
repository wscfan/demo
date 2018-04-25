<?php
	require_once('config.php');
	// 连库
	if (!($con = mysqli_connect(HOST, USERNAME, PASSWORD))) {
		echo mysqli_error();
	}

	// 选库
	if (!mysqli_select_db($con, 'info')) {
		echo mysqli_error();
	}

	// 字符集
	if (!mysqli_query($con, 'set names utf8')) {
		echo mysqli_error();
	}

?>