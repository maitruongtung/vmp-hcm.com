<?php	
	if(!isset($_SESSION['taikhoan']))
		header("location:index.php?action=login");
	else
		$user	=	$_SESSION['taikhoan'];


?>