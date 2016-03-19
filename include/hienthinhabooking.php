
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

?>
<div class="alert alert-success" role="alert">Anh/Chị đã thêm thành công ! xin mời chọn tiếp.</div>
<div class="container">
  <div class="row">
    <h3 align="center"> Quản lý nhà cho thuê</h3>
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
          <th>Offsite</th>
			<th>Lý do</th>
          
          
          <th>Quản lý</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $stt = 1 ;
        $sql = "SELECT * FROM thuenha ORDER BY id DESC";
       
        $query = mysql_query($sql);
         $data = mysql_fetch_array($query);
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
	  
	  
	  
	  		 <td align="center"><?php echo $data["loaidat"]; ?></td>
            

           <td><?php echo $data["lydo"]; ?></td>
            
            <td>
              <a href="index.php?act=cus-capnhatbooking&id=<?php echo $data["id"]; ?>" title="Cập nhật">
                <span class="glyphicon glyphicon-edit"></span>
              </a>
            </td>
          </tr>
          
      </tbody>
     
    </table>
  </div>
</div><!-- /.container -->
