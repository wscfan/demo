<?php
	if (isset($_REQUEST['authcode'])) {
		session_start();

		if (strtolower($_REQUEST['authcode']) == $_SESSION['authcode']) {
			echo '<h1 style="color: #f00;">输入正确</h1>';
		} else {
			echo '<h1 style="color: #666;">输入错误</h1>';
		}
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>验证码实例</title>
</head>
<body>
	<form action="form.php" method="post">
		<p>验证码图片：
			<img id="captcha_img" src="captcha_img.php?r=<?php echo rand();?>" style="border: 1px solid #333; width: 100px;" />
			<a href="javascript:void(0);" onclick="document.getElementById('captcha_img').src='captcha_img.php?r=' + Math.random()">换一个？</a>
		</p>
		<p>请输入图片中的内容：<input type="text" name="authcode" value="" /></p>
		<p><input type="submit" value="提交" style="padding: 6px 20px;"></p>
	</form>
</body>
</html>