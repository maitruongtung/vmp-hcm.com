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
	$googlemap	= isset($_POST["googlemap"]) ? $_POST["googlemap"] : $data->googlemap;
	$banla		= isset($_POST["banla"]) ? $_POST["banla"] : $data->banla;
	$didong		= isset($_POST["didong"]) ? $_POST["didong"] : $data->didong;
	$tencuaban	= isset($_POST["tencuaban"]) ? $_POST["tencuaban"] : $data->tencuaban;
	$chunha 	= isset($_POST["chunha"]) ? $_POST["chunha"] : $data->sdtchunha;
	$gioithieu	= isset($_POST["gioithieu"]) ? $_POST["gioithieu"] : $data->gioithieu;
	$duongpho	= isset($_POST["duongpho"]) ? $_POST["duongpho"] : $data->duongpho;
	$tinhthanhpho	= isset($_POST["city"]) ? $_POST["city"] : $data->tinhthanhpho;
	$quanhuyen	= isset($_POST["district"]) ? $_POST["district"] : $data->quanhuyen;
	$phuongxa	= isset($_POST["town"]) ? $_POST["town"] : $data->phuongxa;
	$duong 		= isset($_POST["street"]) ? $_POST["street"] : $data->duong;
	$sonha 		= isset($_POST["sonha"]) ? $_POST["sonha"] : $data->sonha;
	$chungcucanho	= isset($_POST["chungcucanho"]) ? $_POST["chungcucanho"] : $data->chungcucanho;
	$giachothue = isset($_POST["giachothue"]) ? $_POST["giachothue"] : $data->giachothue;
	$chieungang = isset($_POST["dientichtangtret"]) ? $_POST["dientichtangtret"] : $data->dientichtangtret;
	$chieudai	= isset($_POST["chieudai"]) ? $_POST["chieudai"] : $data->chieudai;
	$dientichhuudung	= isset($_POST["dientichhuudung"]) ? $_POST["dientichhuudung"] : $data->dientichhuudung;
	$solau		= isset($_POST["solau"]) ? $_POST["solau"] : $data->solau;
	$tinhtrangtangtret	= isset($_POST["solau"]) ? $_POST["tinhtrangtangtret"] : $data->tinhtrangtangtret;
	$vitri		= isset($_POST["vitri"]) ? $_POST["vitri"] : $data->vitri;
	$ghichu		= isset($_POST['ghichu']) ? $_POST['ghichu'] : $data->ghichu;
	$thoathuangiathue 	= isset($_POST['thoathuangiathue']) ? $_POST['thoathuangiathue'] : $data->thoathuangiathue;
	$nhatiemnang 	= isset($_POST['nhatiemnang']) ? $_POST['nhatiemnang'] : $data->nhatiemnang;
	$danhmuc 	= isset($_POST['danhmuc']) ? $_POST['danhmuc'] : $data->danhmuc;
	$diachichunha 	= isset($_POST['diachichunha']) ? $_POST['diachichunha'] : $data->diachichunha;
	$hoahong 	= isset($_POST['hoahong']) ? $_POST['hoahong'] : $data->hoahong;
	$youtube 	= isset($_POST['youtube']) ? $_POST['youtube'] : $data->youtube;
	

// Kiem tra trung
	$sql="select * from thuenha where sonha='".$sonha."'&& tinhthanhpho='".$tinh."'&& quanhuyen='".$quan."' && phuongxa='".$phuong."' && duong='".$duong."' && chungcucanho='{$chungcucanho}' && id <> '{$id}'"; 
	$query=mysql_query($sql);
	if(mysql_num_rows($query) != "" )
	{
		echo '<div class="alert alert-danger" role="alert">Nhà này đã tồn tại!</div>';
	}
	else
	{
 
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

		$sql = "UPDATE thuenha SET googlemap = '{$googlemap}', anhbentrong = '{$anhbentrong}', anhbenngoai = '{$anhbenngoai}', banla = '{$banla}', didong = '{$didong}', tencuaban = '{$tencuaban}', sdtchunha = '{$chunha}', gioithieu = '{$gioithieu}', duongpho = '{$duongpho}',tinhthanhpho = '{$tinhthanhpho}',quanhuyen = '{$quanhuyen}', phuongxa = '{$phuongxa}', duong = '{$duong}', sonha = '{$sonha}', chungcucanho = '{$chungcucanho}', giachothue = '{$giachothue}', thoathuangiathue = '{$thoathuangiathue}', dientichtangtret = '{$chieungang}', chieudai = '{$chieudai}', dientichhuudung = '{$dientichhuudung}', solau = '{$solau}', tinhtrangtangtret = '{$tinhtrangtangtret}', vitri = '{$vitri}', ghichu = '{$ghichu}', nhatiemnang = '{$nhatiemnang}', danhmuc = '{$danhmuc}', diachichunha = '{$diachichunha}', hoahong = '{$hoahong}', youtube = '{$youtube}' WHERE id = {$id}";

		mysql_query($sql);

		//
		switch ($act) {
			case 'cus-capnhatbooking-dauvao':
				header('Location: index.php?act=cus-onsite&id=' . $id);
				break;
			
			default:
				header('Location: index.php?act=cus-booking');
				break;
		}
	}
}


	 //Load city
	 $sql_city = "select * from city";
	 
	 $sql_city = mysql_query($sql_city);
	 
	 $city_html = "<option value=''>Chọn</option>";
	 while($city = mysql_fetch_assoc($sql_city))
	 {
	 	$checkedCity = ($city['cityId'] == $data->tinhthanhpho) ? 'selected="selected"' : '';
	 	$city_html .= <<<eof
		<option value="{$city['cityId']}" {$checkedCity}>{$city['cityName']}</option>
eof;
	 }
//Load nhan vien
$sql_users = "select * from users";
$sql_users = mysql_query($sql_users);
$nhanvien = "<option value=''>Chọn</option>";
while($nv = mysql_fetch_assoc($sql_users))
{
  $selected = '';
  if ($nv['fullname'] == $data->nhanvienphutrach){$selected="selected";}
  $nhanvien .= <<<eof
  <option value="{$nv['fullname']}" {$selected}>{$nv['fullname']}</option>
eof;
}

	//Load chung cu can ho
   $sql_chungcucanho = "select * from chungcu_canho";
   $sql_chungcucanho = mysql_query($sql_chungcucanho);
   $chungcu_canho_html = "<option>- Chọn -</option>";
   while($chungcu_canho = mysql_fetch_assoc($sql_chungcucanho))
   {
   		$selectedChungCu = '';
   		if (isset($data->chungcucanho) && $data->chungcucanho == $chungcu_canho['chungcu_canho_id']){
   			$selectedChungCu = 'selected="selected"';
   		}
	    $chungcu_canho_html .= <<<eof
	    <option {$selectedChungCu} value="{$chungcu_canho['chungcu_canho_id']}">{$chungcu_canho['chungcu_canho_name']}</option>
eof;
   }


?>
<div class="container">
 <div class="row">
	 <h3>Xác nhận thông tin</h3><br/>
  <form method="POST" name="fr_update" enctype="multipart/form-data">
    <table class="table">
     <input type="hidden" name="id" value="<?php echo $data->id; ?>">
    	
		<tr><td>Bạn là : </td><td><input type="text" class="form-control" name="banla" value="<?php echo $data->banla; ?>" /></td></tr>
		
		<tr><td>Di động : </td><td><input type="text" class="form-control" name="didong" value="<?php echo $data->didong; ?>" /></td></tr>
		<tr><td>Tên của bạn : </td><td><input type="text" class="form-control" name="tencuaban" value="<?php echo $data->tencuaban; ?>" /></td></tr>
		<tr><td>Chủ nhà : </td><td><input type="text" class="form-control" name="chunha" value="<?php echo $data->sdtchunha; ?>" /></td></tr>
		<tr><td>Địa chỉ chủ nhà : </td><td><input type="text" class="form-control" name="diachichunha" value="<?php echo $data->diachichunha; ?>" /></td></tr>

		<tr><td>Giới thiệu : </td><td><input type="text" class="form-control" name="gioithieu" value="<?php echo $data->gioithieu; ?>" /></td></tr>
		<tr><td>Đường phố : </td><td><input type="text" class="form-control" name="duongpho" value="<?php echo $data->duongpho; ?>" /></td></tr>
		<tr><td>Tỉnh / Thành phố : </td><td><select name='city' class="form-control" id="city" onchange="loadDistrict($(this).val())">
			<?php echo $city_html; ?>

			</select></td></tr>
		
		
		<tr><td>Quận / Huyện : </td><td><select name='district' class="form-control" id="district" onchange="loadTown($(this).val())">
			<?php echo $district_html; ?>
		</select></td></tr>
		
		<tr><td>Phường / xã : </td><td><select name='town' class="form-control" id="town" onchange="loadStreet($(this).val())">
			<?php echo $town_html; ?>
		</select></td></tr>
		<tr><td>Đường : </td><td><select name='street' class="form-control" id="street">
			<?php echo $street_html; ?>
		</select></td></tr>
		
		<tr><td>Số nhà : </td><td><input type="text" class="form-control" name="sonha" value="<?php echo $data->sonha; ?>" /></td></tr>
		
		<tr><td>Nhà tiềm năng : </td><td><input type="text" class="form-control" name="nhatiemnang" value="<?php echo $data->nhatiemnang; ?>" /></td></tr>

		<tr>
			<td>Chung cư / căn hộ : </td>
			<td>
				<select name='chungcucanho' class="form-control" id="chungcucanho">
			        <?php echo $chungcu_canho_html; ?>
			    </select>
			</td>
		</tr>
		<tr><td>Danh mục : </td><td><input type="text" class="form-control" name="danhmuc" value="<?php echo $data->danhmuc; ?>" autocomplete="off" /></td></tr>

		
		<tr><td>Giá cho thuê : </td><td><input type="text" class="form-control" name="giachothue" value="<?php echo $data->giachothue; ?>" autocomplete="off" /></td></tr>
		<tr><td>Hoa hồng : </td><td><input type="text" class="form-control" name="hoahong" value="<?php echo $data->hoahong; ?>" autocomplete="off" /></td></tr>
		<tr><td>Thoả thuận giá thuê : </td><td><input type="text" class="form-control" name="thoathuangiathue" value="<?php echo $data->thoathuangiathue; ?>" /></td></tr>
		<tr><td>Chiều ngang : </td><td><input type="text" class="form-control" name="dientichtangtret" value="<?php echo $data->dientichtangtret; ?>" /></td></tr>
		<tr><td>Chiều dài : </td><td><input type="text" class="form-control" name="chieudai" value="<?php echo $data->chieudai; ?>" /></td></tr>
		<tr><td>Diện tích hữu dụng : </td><td><input type="text" class="form-control" name="dientichhuudung" value="<?php echo $data->dientichhuudung; ?>" /></td></tr>
		<tr><td>Số lầu : </td><td><input type="text" class="form-control" name="solau" value="<?php echo $data->solau; ?>" /></td></tr>
		<tr><td>Tình trạng tầng trệt : </td><td><input type="text" class="form-control" name="tinhtrangtangtret" value="<?php echo $data->tinhtrangtangtret; ?>" /></td></tr>
		<tr><td>Vị trí : </td><td><input type="text" class="form-control" name="vitri" value="<?php echo $data->vitri; ?>" /></td></tr>
		<tr><td>Ghi chú : </td><td><input type="textarea" value="<?php echo $data->ghichu; ?>" class="form-control" name="ghichu"/></td></tr>


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
		
<tr><td>Địa chỉ google Map : </td><td><input type="text" class="form-control" name="googlemap" value="<?php echo $data->googlemap; ?>" /></td></tr>
<tr><td>Link video Youtube : </td><td><input type="text" class="form-control" name="youtube" value="<?php echo $data->youtube; ?>" /></td></tr>

<tr><td colspan="2"><input type="submit" name="save" class="btn btn-success" value="Lưu thông tin"></td></tr>
</table>
	  
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
	
	function loadDistrict(cityId)
	{
		//reset
		$("#district, #town, #street").html("<option>Chọn</option>");
		
		if(!cityId) return false;
		
		$.ajax({
			url: "include/ajax-get-address.php?act=loadDistrictAjax&id="+cityId,
			success: function(result){
				$("#district").html(result);
			}
		})
	}
    function loadTown(districtId)
	{
		//reset
		$("#town, #street").html("<option>Chọn</option>");
		
		if(!districtId) return false;
		
		$.ajax({
			url: "include/ajax-get-address.php?act=loadTownAjax&id="+districtId,
			success: function(result){
				$("#town").html(result);
			}
		})
	}
	
	function loadStreet(townId)
	{
		//reset
		$("#street").html("<option>Chọn</option>");
		
		if(!townId) return false;
		
		$.ajax({
			url: "include/ajax-get-address.php?act=loadStreetAjax&id="+townId,
			success: function(result){
				$("#street").html(result);
			}
		})
	}
	
</script>