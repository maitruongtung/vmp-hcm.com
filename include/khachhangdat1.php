<?php

if (isset($_GET["id"])) {
      //thực hiện việc lấy thông tin user
 $id = $_GET["id"];
 $sql = "SELECT * FROM thuenha WHERE id = $id";
 $query = mysql_query($sql);
 $data = mysql_fetch_object($query);
}

if (isset($_POST["save"])) {
 $id = $_POST["id"];
	 $googlemap = $_POST["googlemap"];
	$dientichhuudung=$_POST["dientichhuudung"];
	$giachothue = $_POST["giachothue"];
	//$didong = $_POST["didong"];
	//$tencuaban = $_POST["tencuaban"];
	//$duong=$_POST["duong"];
 $kiemsoatduong=$_POST["kiemsoatduong"];
 $ketquadauvao = $_POST['ketquadauvao'];
 $loaidat = isset($_POST['loaidat']) ? $_POST['loaidat'] : '';
 $lydo = isset($_POST['lydo']) ? $_POST['lydo'] : '';
 $nhanvienphutrach=$_POST['nhanvien'];
	
	$ngaydatcoc= ($_POST['ngaydatcoc'] != '') ? strtotime($_POST['ngaydatcoc']) : $data->ngaydatcoc;
	$ngaythanhtoantt= ($_POST['ngaythanhtoantt'] != '') ? strtotime($_POST['ngaythanhtoantt']) : $data->ngaythanhtoantt;
 $ngayhethan= ($_POST['hopdong'] != '') ? strtotime($_POST['hopdong']) : $data->hopdong;
 $ngaykyhd= ($_POST['ngaykyhd'] != '') ? strtotime($_POST['ngaykyhd']) : $data->ngaykyhd;
 $ngaygiaonha= ($_POST['ngaygiaonha'] != '') ? strtotime($_POST['ngaygiaonha']) : $data->ngaygiaonha;
	 $ngaykhaitruong= ($_POST['ngaykhaitruong'] != '') ? strtotime($_POST['ngaykhaitruong']) : $data->ngaykhaitruong;
	$ngayhuyhopdong= ($_POST['ngayhuyhopdong'] != '') ? strtotime($_POST['ngayhuyhopdong']) : $data->ngayhuyhopdong;
	$ngaythangnam= ($_POST['ngaythangnam'] != '') ? strtotime($_POST['ngaythangnam']) : $data->ngaythangnam;
 
 // Xu ly upload
 $target_dir = "uploads/";
  if ($_FILES["anhbenngoai"]["name"] != ''){
    $anhbenngoai = $target_dir . basename($_FILES["anhbenngoai"]["name"]);
    $anhbenngoaiFileType = pathinfo($anhbenngoai,PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["anhbenngoai"]["tmp_name"], $anhbenngoai);
  }else{
    $anhbenngoai = $data->anhbenngoai;
  }
  if ($_FILES["anhbentrong"]["name"] != ''){
    $anhbentrong = $target_dir . basename($_FILES["anhbentrong"]["name"]);
    $anhbentrongFileType = pathinfo($anhbentrong,PATHINFO_EXTENSION);
    move_uploaded_file($_FILES["anhbentrong"]["tmp_name"], $anhbentrong);
  }else{
    $anhbentrong = $data->anhbentrong;
  }

 $sql = "UPDATE thuenha SET googlemap = '{$googlemap}',kiemsoatduong = '{$kiemsoatduong}', ketquadauvao = '{$ketquadauvao}', loaidat = '{$loaidat}', lydo = '{$lydo}', nhanvienphutrach = '{$nhanvienphutrach}',ngaydatcoc = '{$ngaydatcoc}',ngaythanhtoantt = '{$ngaythanhtoantt}', ngayhethan = '{$ngayhethan}', anhbentrong = '{$anhbentrong}', anhbenngoai = '{$anhbenngoai}', ngaykyhd = '{$ngaykyhd}', ngaygiaonha = '{$ngaygiaonha}', ngaykhaitruong = '{$ngaykhaitruong}', ngayhuyhopdong = '{$ngayhuyhopdong}', dientichhuudung = '{$dientichhuudung}', ngaythangnam = '{$ngaythangnam}', giachothue = '{$giachothue}' WHERE id = {$id}";
 mysql_query($sql);
 header('Location: index.php?act=cus-xemnha');
}

//Load nhan vien
$sql_users = "select * from users";
$sql_users = mysql_query($sql_users);
$nhanvien = "<option value='0'>Chọn</option>";
while($nv = mysql_fetch_assoc($sql_users))
{
  $selected = '';
  if ($nv['fullname'] == $data->nhanvienphutrach){$selected="selected";}
  $nhanvien .= <<<eof
  <option value="{$nv['fullname']}" {$selected}>{$nv['fullname']}</option>
eof;
}


?><style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<div class="container">
 <div class="row">
  <h3>Xác nhận thông tin</h3>
  <form method="POST" name="fr_update" enctype="multipart/form-data">
    <table class="table">
     <input type="hidden" name="id" value="<?php echo $data->id; ?>">
    
     
     <tr>
          <td>Đường này là đường ưu tiên ? : </td>
          <td>
           <div class="radio">
            <label>
              <input 	 name="kiemsoatduong" type="radio" checked="checked" value="Đường ưu tiên"> Đường ưu tiên
            </label>
            <label>
              <input name="kiemsoatduong" type="radio" value="Bình thường"> Bình thường
            </label>
          </div>
        </td>
      </tr>
     <tr>
      <td>Thẩm định : </td>
      <td>
       <div class="radio">
        <label>
          <input name="ketquadauvao" type="radio"  value="Đạt sơ bộ"> Đạt sơ bộ
        </label>&nbsp;&nbsp;&nbsp;
		   <label>
          <input name="ketquadauvao" type="radio"   value="Cân nhắc"> Cân nhắc
        </label>&nbsp;&nbsp;&nbsp;
		<label>
          <input name="ketquadauvao" type="radio"   value="Chưa thực hiện"> Chưa thực hiện
        </label>&nbsp;&nbsp;&nbsp;
		<label>
          <input name="ketquadauvao" type="radio"   value="Loại"> Loại
        </label>&nbsp;&nbsp;&nbsp;
        <label>
          <input name="ketquadauvao" type="radio" value="Không đạt"> Không đạt
        </label><br /><font color="#FF0033">&nbsp; * Vui lòng phải chọn </font>
      </div>
    </td>
  </tr>
  <tr class="loaidat">
    <td>Loại đạt HS : </td>
    <td>
     <select name="loaidat" class="form-control">
		 <option value="---">--Chọn--</option>
      <option value="Đã hủy HĐ">Đã hủy HĐ</option>
		 <option value="Đã bàn giao">Đã bàn giao</option>
		 <option value="Tiền cọc">Tiền cọc</option>
		 <option value="Chưa thanh toán">Chưa thanh toán</option>
		 <option value="Đã hoạt động">Đã hoạt động</option>
		 <option value="Đã hoàn tất">Đã hoàn tất</option>
      <option value="Cân nhắc">Cân nhắc</option>
      <option value="Chuyển đàm phán">Chuyển đàm phán</option>
      <option value="Đã ký HĐ">Ký hợp đồng</option>
      <option value="Mời ký HĐ">Mời ký HĐ</option>
      <option value="Đã thanh toán tiền thuê">Đã thanh toán tiền thuê</option>
      <option value="Đã ký thành công">Đã ký thành công</option>
      <option value="Đã đặt cọc thuê nhà">Đã đặt cọc thuê nhà</option>
    </select>
  </td>
</tr>
<tr class="lydo"><td>Lý do : </td><td><input type="textarea" value="<?php echo $data->lydo; ?>" class="form-control" name="lydo"/></td></tr>
<tr>
  <td>Nhân viên phụ trách: </td>
  <td>
    <select name='nhanvien' class="form-control" id="nhanvien">
      <?php echo $nhanvien; ?>
    </select>
  </td>
</tr>
<tr>
  <td>Ngày booking: </td>
  <td>
    <div class="input-group">
      <input name="ngaythangnam" class="form-control datepicker" value="<?php echo ($data->ngaythangnam) ? date('d-m-Y', $data->ngaythangnam) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
<tr>
  <td>Ngày ký hợp đồng: </td>
  <td>
    <div class="input-group">
      <input name="ngaykyhd" class="form-control datepicker" value="<?php echo ($data->ngaykyhd) ? date('d-m-Y', $data->ngaykyhd) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>		
		
<tr>
  <td>Ngày đặt cọc: </td>
  <td>
    <div class="input-group">
      <input name="ngaydatcoc" class="form-control datepicker" value="<?php echo ($data->ngaydatcoc) ? date('d-m-Y', $data->ngaydatcoc) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
	
<tr>
  <td>Ngày giao nhà: </td>
  <td>
    <div class="input-group">
      <input name="ngaygiaonha" class="form-control datepicker" value="<?php echo ($data->ngaygiaonha) ? date('d-m-Y', $data->ngaygiaonha) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
		
<tr>
  <td>Ngày thanh toán tiền thuê: </td>
  <td>
    <div class="input-group">
      <input name="ngaythanhtoantt" class="form-control datepicker" value="<?php echo ($data->ngaythanhtoantt) ? date('d-m-Y', $data->ngaythanhtoantt) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
		
	
<tr>
  <td>Ngày hết hạn hợp đồng: </td>
  <td>
    <div class="input-group">
      <input name="hopdong" class="form-control datepicker" value="<?php echo ($data->ngayhethan) ? date('d-m-Y', $data->ngayhethan) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
<tr>
  <td>Ngày huỷ hợp đồng: </td>
  <td>
    <div class="input-group">
      <input name="ngayhuyhopdong" class="form-control datepicker" value="<?php echo ($data->ngayhuyhopdong) ? date('d-m-Y', $data->ngayhuyhopdong) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
		



<tr>
  <td>Ngày khai trương: </td>
  <td>
    <div class="input-group">
      <input name="ngaykhaitruong" class="form-control datepicker" value="<?php echo ($data->ngaykhaitruong) ? date('d-m-Y', $data->ngaykhaitruong) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
	
<tr>
  <td>Ảnh bên trong: </td>
  <td>

   <input name="anhbentrong" class="form-control"  type="file">

 </td>
</tr>

<tr>
  <td>Ảnh bên ngoài: </td>
  <td>

   <input name="anhbenngoai" class="form-control"  type="file">

 </td>
</tr>
		
<tr><td>Diện tích hữu dụng : </td><td><input type="text" class="form-control" name="dientichhuudung" value="<?php echo $data->dientichhuudung; ?>" /></td></tr>
		<tr><td>Giá cho thuê : </td><td><input type="text" class="form-control" name="giachothue" value="<?php echo $data->giachothue; ?>" /></td></tr>

<tr><td>Địa chỉ google Map : </td><td><input type="text" class="form-control" name="googlemap" value="<?php echo $data->googlemap; ?>" /></td></tr>
<tr><td colspan="2"><input type="submit" name="save" class="btn btn-success" value="Lưu thông tin"></td></tr>
</table>
	  <iframe align="middle" width="990" src="https://www.google.com/maps/d/edit?mid=zcWikVGM1Gmk.ka-O-O_SK32A&usp=sharing"  frameborder="0" style="border:0" allowfullscreen></iframe>
</form>
</div>
</div><!-- /.container -->
<script type="text/javascript">
	jQuery(function(){
		$('input[name="ketquadauvao"]').change(function(){
			if ($('input[name="ketquadauvao"]:checked').val() == "Đạt sơ bộ") {
				$('tr.lydo').show();
				$('tr.loaidat').show();
			}else{
				$('tr.lydo').show();
				$('tr.loaidat').hide();
			};
		});
    $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});

    $('input[name="ketquadauvao"]:checked').trigger('change');
  });
    
</script>