<?php
include "connect/connect.php";
$getdidong = $_GET['didong'];
if($getdidong=="")
	echo "di động không được phép rỗng!!!";
else
{	
	if(strlen($getdidong)<8)
		echo "Chiều dài của tên đăng nhập phải lớn hơn 8";
	
		else
		{
			$sql= "select * From thuenha where didong='$getdidong'";
		
			$result = mysql_query($sql);
			
			if (mysql_num_rows($result)!=0) 
				echo "Số di động: <strong>$gettendangnhap</strong> này đã có người sử dụng.";
			else 
			{
				echo "good";
			}
		}
	}

?>

