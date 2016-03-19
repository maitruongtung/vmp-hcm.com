<style type="text/css">
  <!--
  body,td,th {
   font-family: Arial, Helvetica, sans-serif;
 }
-->
</style>
<body>
  <?php
  if (!isset($_SESSION['username']) || $_SESSION['level'] != 2 ) {
    echo '<div class="alert alert-danger" role="alert">Bạn không có quyền thao tác tính năng này!</div>';
    die();
  }


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

  ?>

  
<div class="container">
  <div class="row">
    <h3 align="center"><font color="#FF3300"> Quản lý nhà thuê</font></h3>

    <table class="table table-bordered table-striped" >
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
			<th>Offsite</th>
			 <th>Lý do</th>
       <th>Quản lý</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stt = 1 ;
        $sql = "SELECT * FROM thuenha ORDER BY id DESC";
        // Phan trang
        $maxItem = mysql_num_rows(mysql_query($sql)); // Tong so dong
        $itemOnPage = 10; // So dong tren 1 trang
        $pageNum = ceil($maxItem/$itemOnPage);
        if (isset($_REQUEST['page'])){
          $page = $_REQUEST['page'];
          $limit = ($page-1) * $itemOnPage;
          $sql .= " LIMIT {$limit}, $itemOnPage";
        }
        // END.Phan trang
        // thực thi câu $sql với biến conn lấy từ file connection.php
        $query = mysql_query($sql);
        while ($data = mysql_fetch_array($query)) {
          $address = implode(', ', array($data['sonha'], $rsStreet[$data['duong']], $rsTown[$data['phuongxa']], $rsDistrict[$data['quanhuyen']], $rsCity[$data['tinhthanhpho']],$data['kiemsoatduong']))
          ?>
          <tr>
            <th scope="row"><?php echo $stt++ ?></th>
            <td><?php echo date('d-m-Y', $data["ngaythangnam"]); ?></p><small><b>Giờ:</b> <?php echo date('H:m:i', $data["ngaythangnam"]); ?></small></td>
            <td><?php echo $address; ?>&nbsp;<a href="<?php echo $data["googlemap"]; ?>" target="_blank">xem Map</a></td>
	  <td>Ngang:<?php echo $data["dientichtangtret"]; ?><br/>Dài:<?php echo $data["chieudai"]; ?><br/>Số lầu:<?php echo $data["solau"]; ?><br/>Dthd:<?php echo $data["dientichhuudung"]; ?></td>
	 		 <td><?php echo $data["giachothue"]; ?></td>
	  
            <td><?php echo $data["gioithieu"]; ?></td>

			 <td><?php echo $data["vitri"]; ?></td>
	  
	  		
            <td>
              Trong: <a target="_blank" href="<?php echo ($data['anhbentrong']) ? $data['anhbentrong'] : 'javascript:void(0);' ?>"><span class="glyphicon glyphicon-film"></span></a><br>
              Ngoài: <a target="_blank" href="<?php echo ($data['anhbenngoai']) ? $data['anhbenngoai'] : 'javascript:void(0);' ?>"><span class="glyphicon glyphicon-film"></span></a>
            </td>
           
	  <td><p><?php echo $data["tencuaban"]; ?></p><small><b>DD:</b> <?php echo $data["didong"]; ?></small><br>SDT chủ nhà:<?php echo $data["sdtchunha"]; ?></td>

			  <td align="center"><?php echo $data["ketquadauvao"]; ?></td>
           
            <td align="center"><?php echo $data["loaidat"]; ?></td>
            
          
            
            <td><?php echo $data["lydo"]; ?></td>
            <td><a href="index.php?act=cus-activeadmin&id=<?php echo $data["id"]; ?>"><u>Cập nhật</u></a></td>
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
<a href="#" data-value="<?php echo $_SERVER['REQUEST_URI']; ?>" class="export-excel" style="margin-left:10px;">Xuất excel</a>
<iframe id="ifm-export-excel" src="" style="display:none; width:100%; "></iframe>
<script type="text/javascript">
  jQuery(function($){
    $('.export-excel').on('click', function(){
      $('#ifm-export-excel').attr('src', 'include/export-excel.php' + $(this).data('value') + "&search=search");
      return false;
    })
  });
</script>
