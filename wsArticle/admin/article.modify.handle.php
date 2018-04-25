<?php
require_once('../connect.php');

$id = $_POST['id'];

if (!isset($_POST['title']) || empty($_POST['title'])) {
	echo "<script>alert('标题不能为空！'); window.location.href = 'article.modify.php?id=$id';</script>";
	return;
}

$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];
$content = $_POST['content'];
$dateline = time();

$updatesql = "update article set title='$title',author='$author',description='$description',content='$content',dateline='$dateline' where id=$id";
if (mysqli_query($con, $updatesql)) {
	echo "<script>alert('修改成功'); window.location.href = 'article.manage.php';</script>";
} else {
	echo "<script>alert('修改失败'); window.location.href = 'article.manage.php';</script>";
}