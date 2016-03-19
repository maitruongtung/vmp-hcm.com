<?php
ob_start();
	session_start();
	// Neu chua dang nhap
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
	}
	require_once("connect/connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>VMP & HCM</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="style/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="style/bootstrap-combobox-master/css/bootstrap-combobox.css">
	<link rel="stylesheet" href="style/bootstrap-multiselect-master/dist/css/bootstrap-multiselect.css">
	<link rel="stylesheet" href="style/css.css">

	<script src="bootstrap/js/jquery-2.1.4.min.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="style/bootstrap-combobox-master/js/bootstrap-combobox.js"></script>
	<script src="style/bootstrap-multiselect-master/dist/js/bootstrap-multiselect.js"></script>
	<script src="style/jquery-ui/jquery-ui.min.js"></script>
	<script src="bootstrap/js/jquery.validate.js"></script>
	<script src="style/jquery-number/jquery.number.js"></script>
	<script src="style/script.js"></script>
</head>

<body>
	<div class="container" >
		<div class="footer">
		
		</div>
		<div class="header clearfix">
			<div class="row">
		        <nav class="col-sm-12">
		          <ul class="nav nav-pills">
		            <li role="presentation"><a class="link-3" href="index.php" style="padding-left:0;">BOOKING</a></li>
		            <li role="presentation"><a class="link-3" href="index.php?act=cus-daily">ĐẠI LÝ</a></li>
		            <li role="presentation" class="dropdown">
			          <a href="#" class="dropdown-toggle link-3" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">SMB <span class="caret"></span></a>
			          <ul class="dropdown-menu">
			            <?php 
			            	if(isset($_SESSION['username'])){
								echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-statistic">ĐẦU VÀO</a></li>';
			            		echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-thamdinh">THẨM ĐỊNH</a></li>';
			            		echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-damphan">ĐÀM PHÁN</a></li>';
								echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-damphan">ĐỀ XUẤT GIÁ</a></li>';
								echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-damphan">KÝ HỢP ĐỒNG</a></li>';
								echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-damphan">KẾ TOÁN</a></li>';
								echo '<li role="presentation"><a class="link-3" href="index.php?act=cus-xemnha">ADMIN</a></li>';
								
			            	}
			            ?>
			          </ul>
			        </li>
				<li role="presentation"><a class="link-3" href="index.php?act=cus-khachhang">KHÁCH HÀNG</a></li>
			        <?php 
		            	if(isset($_SESSION['username'])){
		            		echo '<li role="presentation"><a class="link-3" href="index.php?act=logout">ĐĂNG XUẤT</a></li>';
		            	}else{
		            		echo '<li role="presentation"><a href="index.php?act=login">Đăng nhập</a></li>';
		            	}
		            ?>
		          </ul>
		        </nav>
		        <div class="col-sm-5">
		        	
		        </div>
	        </div>
		</div>

		<div class="row marketing">
			<?php 
				// CHECK PERMISSION
				include_once("include/check-permission.php");

				//
				if (!isset($_REQUEST['act'])) {
					$act = 'home';
				}else{
					$act = $_REQUEST['act'];
				}
				//
				switch ($act) {
					case 'search':
						include_once("include/timkiem.php");
						break;
					case 'searchtenduong':
						include_once("include/timtenduong.php");
						break;
					case 'searchtimkiem':
						include_once("include/formtimkiem.php");
						break;
					case 'searchngaythang':
						include_once("include/timkiemngaythang.php");
						break;
					case 'searchquan':
						include_once("include/timkiemquan.php");
						break;
					case 'searchphuong':
						include_once("include/timtheophuong.php");
						break;
					case 'searchduong':
						include_once("include/timtheoduong.php");
						break;
					case 'searchketquatimkiem':
						include_once("include/ketquatimkiem.php");
						break;

					case 'login':
						include_once("include/dangnhap.php");
						break;

					case 'cus-manage':
						include_once("include/quanlykhachhang.php");
						break;
					case 'cus-booking':
						include_once("include/hienthinhabooking.php");
						break;
					case 'cus-report':
						include_once("include/formtimkiem.php");
						break;
					case 'cus-xemnha':
						include_once("include/baocao.php");
						break;
					



					
					case 'cus-daily':
					case 'cus-onsite':
					case 'cus-onsite-thamdinh':
					case 'cus-onsite-damphan':
						include_once("include/daily.php");
						break;
					case 'cus-statistic':
						include_once("include/booking-statistic.php");
						break;
					case 'cus-damphan':
					case 'cus-thamdinh':
						include_once("include/booking-statistic-by-customer.php");
						break;

					case 'cus-khachhang':
						include_once("include/khachhang-list.php");
						break;

					case 'cus-khachhang-insert':
						include_once("include/khachhang-insert.php");
						break;

					case 'cus-khachhang-update':
						include_once("include/khachhang-update.php");
						break;

					case 'cus-khachhang-delete':
						include_once("include/khachhang-delete.php");
						break;

					case 'cus-active':
						include_once("include/khachhangdat.php");
						break;
					case 'cus-capnhatbooking':
					case 'cus-capnhatbooking-dauvao':
						include_once("include/capnhatbooking.php");
						break;
					case 'cus-accept':
					case 'cus-accept-thamdinh':
					case 'cus-accept-damphan':
						include_once("include/booking-accept.php");
						break;
					case 'cus-activeadmin':
						include_once("include/khachhangdat1.php");
						break;
					case 'book-del':
						include_once("include/booking-delete.php");
						break;

					case 'logout':
						session_destroy();
						header("Location: index.php");
						break;
					
					case 'home':
					default:
						include_once("include/thuenha.php");
						break;
				}
			?>
		</div>

      <footer class="footer">
        <p>&copy; <?php echo date('Y'); ?> VMP-HCM</p>
      </footer>

    </div> <!-- /container -->
</body>
</html>
