<?php
require_once('../connect.php');

if (!isset($_POST['title']) || empty($_POST['title'])) {
	echo "<script>alert('标题不能为空！'); window.location.href = 'article.add.php';</script>";
	return;
}

$title = $_POST['title'];
$author = $_POST['author'];
$description = $_POST['description'];
$content = $_POST['content'];
$dateline = time();

$insertsql = "insert into article(title, author, description, content, dateline) values('$title', '$author', '$description', '$content', '$dateline')";
if (mysqli_query($con, $insertsql)) {
	echo "<script>alert('发布成功'); window.location.href = 'article.manage.php';</script>";
} else {
	echo "<script>alert('发布失败'); window.location.href = 'article.manage.php';</script>";
}