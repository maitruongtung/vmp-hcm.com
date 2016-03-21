<?php
  // Lay thong tin khach hang
  $makhachhang = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
  if ($makhachhang == '') {
    die('Tham số không tồn tại!');
  }else{
  	$qr = mysql_query("DELETE FROM khachhang WHERE makhachhang={$makhachhang}");
  	header('Location: index.php?act=cus-khachhang');
  }
?>