<?php
	require_once('../connect.php');
	$id = $_GET['id'];
	$deletesql = "delete from article where id=$id";
	if ($res = mysqli_query($con, $deletesql)) {
		echo "<script>alert('删除文件成功！'); window.location.href='article.manage.php';</script>";
	} else {
		echo "<script>alert('删除文件失败！'); window.location.href='article.manage.php';</script>";
	}
	var_dump($res);
?>