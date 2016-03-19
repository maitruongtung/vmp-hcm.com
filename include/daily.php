<?php

$qbCity = mysql_query("SELECT * FROM city");
$rsCity = array();
while ($fetchCity = mysql_fetch_assoc($qbCity)) {
  $rsCity[$fetchCity['cityId']] = $fetchCity['cityName'];
}

$qbDistrict = mysql_query("SELECT * FROM district");
$rsDistrict = array();
while ($fetchDistrict = mysql_fetch_assoc($qbDistrict)) {
  $rsDistrict[$fetchDistrict['districtId']] = $fetchDistrict['districtName'];
}

$qbTown = mysql_query("SELECT * FROM town");
$rsTown = array();
while ($fetchTown = mysql_fetch_assoc($qbTown)) {
  $rsTown[$fetchTown['townId']] = $fetchTown['townName'];
}

$qbStreet = mysql_query("SELECT * FROM street");
$rsStreet = array();
while ($fetchStreet = mysql_fetch_assoc($qbStreet)) {
  $rsStreet[$fetchStreet['streetId']] = $fetchStreet['streetName'];
}

// Khach hang
$qbKhachhang = mysql_query("SELECT * FROM khachhang");
$rsKhachhang = array();
while ($fetchKhachhang = mysql_fetch_assoc($qbKhachhang)) {
  $rsKhachhang[$fetchKhachhang['makhachhang']] = $fetchKhachhang['ten'];
}
//
$ngaythangnam=date('d-m-Y', time());
$ngaythangnam1=strtotime($ngaythangnam);
// Khach hang
$makhachhang = isset($_REQUEST['makhachhang']) ? $_REQUEST['makhachhang'] : '';
// id
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
// Neu act=daily thi lay username theo dai ly
if ($act == 'cus-daily') {
  $username = $_SESSION["username"];
}
//
$stt = 1 ;
$sql = "SELECT T.*, KHTN.makhachhang FROM thuenha AS T LEFT JOIN khachhang_thuenha AS KHTN ON T.id = KHTN.id WHERE ngaythangnam >= {$ngaythangnam1}";
// Username
if ($username != '') {
  $sql .= " AND username = '{$username}'";
}
// Khach hang
if ($makhachhang != '') {
  $sql .= " AND KHTN.makhachhang = '{$makhachhang}'";
}
// Id 
if ($id != '') {
  $sql .= " AND T.id = '{$id}'";
}
//
$sql .= " GROUP BY T.id ORDER BY T.id DESC";
//die($sql);

// Phan trang
$maxItem = mysql_num_rows(mysql_query($sql)); // Tong so dong
$itemOnPage = 10; // So dong tren 1 trang
$pageNum = ceil($maxItem/$itemOnPage);
if (isset($_REQUEST['page'])){
  $page = $_REQUEST['page'];
  $limit = ($page-1) * $itemOnPage;
  $sql .= " LIMIT {$limit}, $itemOnPage";
}


//load fullname
	
	$sql_fullname = mysql_query("select fullname from users where  username ='".$_SESSION['username']."'");
	if (mysql_num_rows($sql_fullname)) {
    $fullname = mysql_fetch_assoc($sql_fullname);
     $fullname['fullname'];
	}
	else {
    echo 1;
	}
?>
<font size="+1" >Xin chào : <?php echo $_SESSION['username']; ?>&nbsp;/ Họ Tên : &nbsp;<?php echo  $fullname['fullname']; ?>  </font>

<div class="container">
  <div class="row">
    <div class="col-xs-3">
      
	  </div>
    <div class="col-xs-9 text-right">
       <h3 align="center"><font size="+1" >
        Danh sách booking hôm nay ngày: 
        <span style="color: red;"><?php echo  $ngaythangnam; ?></span> 
        Tổng cộng: <span style="color: red;"><?php echo $maxItem;?></span>
      </font> </h3>
    </div>
	  
    <table class="table table-bordered table-striped">
      <caption> </caption>
      <thead>
        <tr>
          <th>Mã số</th>
          <th>Ngày </th>
          <th>Địa chỉ</th>
          <th>Diện Tích</th>
			   <th>Giá thuê</th>
          <th>Mặt bằng</th>
			   <th>Vị trí</th>
			   <th width="80">Ảnh</th>
          <th>Liên hệ</th>
          <th>Onsite</th>
          <th>Khách hàng</th>
          <th>Thẩm định</th>
          <th>Đàm phán</th>
          <th>Người<br>thẩm định</th>
          <th>Offsite</th>
	<th>Lý Do</th>
			
          <th>Quản lý</th>
		

        </tr>
      </thead>
      <tbody>
        <?php
        // END.Phan trang
        // thực thi câu $sql với biến conn lấy từ file connection.php
        $query = mysql_query($sql);
        while ($data = mysql_fetch_array($query)) {

          $address = implode(', ', array($data['sonha'], $rsStreet[$data['duong']], $rsTown[$data['phuongxa']], $rsDistrict[$data['quanhuyen']], $rsCity[$data['tinhthanhpho']],$data['kiemsoatduong'],$data['nhatiemnang']))
          ?>
          <tr>
            <th scope="row"><?php echo $stt++ ?></th>
            <td><?php echo date('d-m-Y', $data["ngaythangnam"]); ?></p><small><b>Giờ:</b> <?php echo date('H:i:s', $data["ngaythangnam"]); ?></small></td>
            <td><?php echo $address; ?>&nbsp;/sử dụng cho:<?php echo $data["danhmuc"]; ?>&nbsp; /<a href="<?php echo $data["googlemap"]; ?>" target="_blank">xem Map</a>&nbsp; /<a href="<?php echo $data["youtube"]; ?>" target="_blank">xem link youtube</a><br>Địa chỉ chủ nhà:<?php echo $data["diachichunha"]; ?></td>
	  <td>Ngang:<?php echo $data["dientichtangtret"]; ?><br>Dài:<?php echo $data["chieudai"]; ?><br>Số lầu:<?php echo $data["solau"]; ?><br>Dthd:<?php echo $data["dientichhuudung"]; ?></td>
	   		<td><?php echo $data["giachothue"]; ?>/<br>Hoa hồng:<?php echo $data["hoahong"]; ?></td>
	 
            <td><?php echo $data["gioithieu"]; ?></td>
	  		<td><?php echo $data["vitri"]; ?></td>
	  		
            <td>
              Trong: <a target="_blank" href="<?php echo ($data['anhbentrong']) ? $data['anhbentrong'] : 'javascript:void(0);' ?>"><span class="glyphicon glyphicon-film"></span></a><br>
              Ngoài: <a target="_blank" href="<?php echo ($data['anhbenngoai']) ? $data['anhbenngoai'] : 'javascript:void(0);' ?>"><span class="glyphicon glyphicon-film"></span></a>
            </td>
	  
            <td><p><?php echo $data["tencuaban"]; ?></p><small><b>DD:</b> <?php echo $data["didong"]; ?></small><br>SDT chủ nhà:<?php echo $data["sdtchunha"]; ?></td>

            <td align="center"><?php echo $data["ketquadauvao"]; ?></td>

            <td>
              <?php 
                // Lay danh sach khach hang cua thue nha
                $qrListKhachhangThuenha = mysql_query("SELECT GROUP_CONCAT(makhachhang) AS makhachhang FROM khachhang_thuenha WHERE id={$data['id']}");
                $rsKhachhangThuenha = mysql_fetch_assoc($qrListKhachhangThuenha);
                if ($rsKhachhangThuenha["makhachhang"]){
                  $makhachhangArr = array_filter(explode(',', $rsKhachhangThuenha['makhachhang']));
                  foreach ($makhachhangArr as $mkh) {
                    echo $rsKhachhang[$mkh] . '<br>';
                  }
                }
              ?>
            </td>

            <td align="center"><?php echo $data["ketquathamdinh"]; ?></td>

            <td align="center"><?php echo $data["ketquadamphan"]; ?></td>

            <td align="center"><?php echo $data["onsite_update"]; ?></td>
	  
	  
	  
	  		 <td align="center"><?php echo $data["loaidat"]; ?></td>
            

           <td><?php echo $data["lydo"]; ?></td>
	  
            
	         <td align="center">
            <?php
              $linkUpdate = $linkDelete = $linkUpdatedauvao = '';
              switch ($act) {
                case 'cus-daily': // Dai ly
                  if (is_null($data['onsite_update'])) {
                    $linkUpdate = '<a href="index.php?act=cus-capnhatbooking&id='.$data["id"].'" title="Cập nhật">
              <span class="glyphicon glyphicon-edit"></span>
            </a>';
                    $linkDelete = '<a class="booking-delete" href="index.php?act=book-del&id='.$data["id"].'" title="Xóa" class=""><span class="glyphicon glyphicon-minus-sign"></span>
            </a>';
                  }
                  break;

                case 'cus-onsite': // Dau vao
                  if (is_null($data['ketquathamdinh']) || $data['ketquathamdinh'] == ''){
                    $linkUpdate = '<a href="index.php?act=cus-accept&id='.$data["id"].'" title="Book">
                <span class="glyphicon glyphicon-edit"></span>
              </a>';
                    $linkUpdatedauvao  = '<a class="booking-update" href="index.php?act=cus-capnhatbooking-dauvao&id='.$data["id"].'" title="Edit full" class=""><span class="glyphicon glyphicon-pencil"></span>
            </a>';
                  }
                  break;

                case 'cus-onsite-thamdinh': // Tham dinh
                  if (is_null($data['ketquadamphan']) || $data['ketquadamphan'] == ''){
                    $linkUpdate = '<a href="index.php?act=cus-accept-thamdinh&id='.$data["id"].'" title="Cập nhật">
                <span class="glyphicon glyphicon-edit"></span>
              </a>';
                  }
                  break;

                case 'cus-onsite-damphan': // Dam phan
                  $linkUpdate = '<a href="index.php?act=cus-accept-damphan&id='.$data["id"].'" title="Cập nhật">
              <span class="glyphicon glyphicon-edit"></span>
            </a>';
                  break;
                
                default:
                  # code...
                  break;
              }
            ?>
            
            <?php
              echo $linkUpdate;
              echo $linkDelete;
		          echo $linkUpdatedauvao;
            ?>
           </td>
          </tr>
          <?php
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="100" align="right">
            <?php include('include/pagination.php'); ?>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</div><!-- /.container -->
<a href="index.php?act=cus-report&username=<?php echo $username; ?>" class="search" style="margin-left:10px;">Tìm kiếm</a>
<a href="#" data-value="<?php echo $_SERVER['REQUEST_URI']; ?>" class="export-excel" style="margin-left:10px;">Tải về</a>
<iframe id="ifm-export-excel" src="" style="display:none; width:100%; "></iframe>
<script type="text/javascript">
  jQuery(function($){
    $('.export-excel').on('click', function(){
      $('#ifm-export-excel').attr('src', 'include/export-excel.php' + $(this).data('value') + "&search=search&ngay_tu=<?php echo $ngaythangnam; ?>&username=<?php echo $username; ?>");
      return false;
    })
  });
</script>