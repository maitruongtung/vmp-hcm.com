<?php 
// Check permision
$permistionGeneral = "home,logout,cus-booking,cus-capnhatbooking,book-del";
$permistions = array(
	// Dai ly
	0 => $permistionGeneral . "cus-daily,cus-report,searchtenduong,searchtimkiem,formtimkiemnhanh,",
	// Dau vao
	1 => $permistionGeneral . "cus-onsite,cus-report,searchtenduong,searchtimkiem,cus-active,cus-accept,cus-statistic,cus-capnhatbooking-dauvao",
	// Tham dinh
	2 => $permistionGeneral . "cus-xemnha,cus-activeadmin,cus-onsite,cus-report,searchtenduong,searchtimkiem,cus-active,cus-accept-thamdinh,cus-thamdinh,cus-onsite-thamdinh",
	// Dam phan
	3 => $permistionGeneral . "cus-xemnha,cus-activeadmin,cus-onsite,cus-report,searchtenduong,searchtimkiem,cus-active,cus-accept-damphan,cus-damphan,cus-onsite-damphan",
	// Khach hang
	9 => $permistionGeneral . "cus-khachhang,cus-khachhang-insert,cus-khachhang-update,cus-khachhang-delete,",
	// Admin
	10 => $permistionGeneral . "cus-onsite,cus-report,searchtenduong,searchtimkiem,cus-active,cus-accept,cus-statistic,cus-capnhatbooking-dauvao,cus-daily,cus-report,searchtenduong,searchtimkiem,cus-khachhang,cus-khachhang-insert,cus-khachhang-update,cus-khachhang-delete,cus-xemnha,cus-activeadmin,cus-onsite,cus-report,searchtenduong,searchtimkiem,cus-active,cus-accept-thamdinh,cus-thamdinh,cus-onsite-thamdinh,cus-xemnha,cus-activeadmin,cus-onsite,cus-report,searchtenduong,searchtimkiem,cus-active,cus-accept-damphan,cus-damphan,cus-onsite-damphan",
);
$action = isset($_REQUEST['act']) ? $_REQUEST['act'] : '';
$level = isset($_SESSION['level']) ? $_SESSION['level'] : '';
if ($action != '' && $level != ''){
	if (strrpos($permistions[$level], $action) === false){
		echo '<div class="alert alert-danger" role="alert">Bạn không có quyền thao tác tính năng này!</div>';
  		die();
	}
}
?>