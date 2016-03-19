<?php
ob_start();
	session_start();
	require_once("connect/connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>VMP HCM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="bootstrap/js/jquery-2.1.4.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="bootstrap/js/jquery.validate.js"></script>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/css.css">
</head>

<body id="body-login">
	<div class="container" id="container-login">
		<p class="welcome-login">Chào mừng bạn đến với hệ thống nội bộ của chuỗi cửa hiệu VMP Hồ Chí Minh.<br>Bạn cần đăng nhập vào hệ thống.</p>
		<?php require_once("include/dangnhap.php"); ?>
		
    </div> <!-- /container -->
    <footer id="footer-login"></footer>
</body>
</html>
