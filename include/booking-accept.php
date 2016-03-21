<?php

	$acceptStatus = $actRedirect = '';
	switch ($act) {

    case 'cus-accept': // Dau vao
        $acceptStatus = <<<acceptStatus
        	<label>
	          	<input name="ketquadauvao" type="radio" value="Đã book"> Đã book
	        </label>&nbsp;&nbsp;&nbsp;
	        <label>
					<input name="ketquadauvao" type="radio" value="Chưa book"> Chưa book
			</label>
acceptStatus;
		$actRedirect = 'cus-onsite';
      break;

    case 'cus-accept-thamdinh': // Tham dinh
      	$acceptStatus = <<<acceptStatus
      		<label>
					<input name="ketquathamdinh" type="radio" value="Đạt"> Đạt
			</label>&nbsp;&nbsp;&nbsp;
			<label>
					<input name="ketquathamdinh" type="radio" value="Loại"> Loại
			</label>&nbsp;&nbsp;&nbsp;
acceptStatus;
		$actRedirect = 'cus-onsite-thamdinh';
      break;

    case 'cus-accept-damphan': // Dam phan
      	$acceptStatus = <<<acceptStatus
        	<label>
	          	<input name="ketquadamphan" type="radio" value="Đạt đàm phán"> Đạt đàm phán
	        </label>&nbsp;&nbsp;&nbsp;
	        <label>
					<input name="ketquadamphan" type="radio" value="Cân nhắc"> Cân nhắc
			</label>&nbsp;&nbsp;&nbsp;
			<label>
					<input name="ketquadamphan" type="radio" value="Loại"> Loại
			</label>
acceptStatus;
		$actRedirect = 'cus-onsite-damphan';
      break;
    
    default:
      # code...
      break;
  }

	// Lay du lieu can cap nhat
	if (isset($_GET["id"])) {
 		$id = $_GET["id"];
 		$sql = "SELECT * FROM thuenha WHERE id = $id";
 		$query = mysql_query($sql);
 		$data = mysql_fetch_object($query);
	}

	if (isset($_POST["save"])) {
	 	$id 		= $_POST["id"];
		$googlemap	= isset($_POST["googlemap"]) ? $_POST["googlemap"] : $data->googlemap;
		$vitri		= isset($_POST["vitri"]) ? $_POST["vitri"] : $data->vitri;
		$ghichu		= isset($_POST['ghichu']) ? $_POST['ghichu'] : $data->ghichu;
		$loaidat	= isset($_POST['loaidat']) ? $_POST['loaidat'] : $data->loaidat;
		$lydo		= isset($_POST['lydo']) ? $_POST['lydo'] : $data->lydo;
		$ketquadauvao	= isset($_POST['ketquadauvao']) ? $_POST['ketquadauvao'] : $data->ketquadauvao;
		$ketquathamdinh	= isset($_POST['ketquathamdinh']) ? $_POST['ketquathamdinh'] : $data->ketquathamdinh;
		$ketquadamphan	= isset($_POST['ketquadamphan']) ? $_POST['ketquadamphan'] : $data->ketquadamphan;
		$username	= isset($_SESSION['username']) ? $_SESSION['username'] : '';
		$makhachhang	= isset($_POST['makhachhang']) ? $_POST['makhachhang'] : array();
		$ngaybook = (isset($_POST['ngaybook']) && $_POST['ngaybook'] != '') ? strtotime($_POST['ngaybook']) : 'NULL';

		// Xoa du lieu khach hang cu cua thue nha
		$qrDelThuenhaKhachhang = mysql_query("DELETE FROM khachhang_thuenha WHERE id={$id}");

		// Them du lieu khach hang moi cho thue nha vao bang khachhang_thuenha
		foreach ($makhachhang as $mkh) {
			$qrInsThuenhaKhachhang = mysql_query("INSERT INTO khachhang_thuenha (makhachhang,id) VALUES ({$mkh},{$id})");
		}

 		$sql = "UPDATE thuenha SET googlemap = '{$googlemap}', vitri = '{$vitri}', ghichu = '{$ghichu}', loaidat = '{$loaidat}', lydo = '{$lydo}',ngaybook = '{$ngaybook}', ketquadauvao = '{$ketquadauvao}', ketquathamdinh = '{$ketquathamdinh}', ketquadamphan = '{$ketquadamphan}', onsite_update = '{$username}' WHERE id = {$id}";
 		//die($sql);
 		//
	 	mysql_query($sql);
	 	header('Location: index.php?act=' . $actRedirect);
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

// Lay danh sach khach hang cua thue nha
	$qrListKhachhangThuenha = mysql_query("SELECT GROUP_CONCAT(makhachhang) AS makhachhang FROM khachhang_thuenha WHERE id={$id}");
	$rsKhachhangThuenha = mysql_fetch_assoc($qrListKhachhangThuenha);

//Load khách hang
   $sql_khachhang = "select * from khachhang";
   $sql_khachhang = mysql_query($sql_khachhang);
   $khachhang_html = "";
   while($khachhang = mysql_fetch_assoc($sql_khachhang))
   {
   	$checkedKhachhang = (strrpos($rsKhachhangThuenha['makhachhang'], $khachhang['makhachhang']) !== false) ? 'selected="selected"' : '';
    $khachhang_html .= <<<eof
    <option value="{$khachhang['makhachhang']}" {$checkedKhachhang}>{$khachhang['ten']}</option>
eof;
   }

?>
<div class="container">
	<div class="row">
		<h3>Xác nhận thông tin</h3><br/>
  		<form method="POST" name="fr_update">
		    <table class="table">
		    	<input type="hidden" name="id" value="<?php echo $data->id; ?>">
		    	
		    	<?php if($act != 'cus-accept'){ ?>
					<tr><td>Vị trí : </td><td><input type="text" class="form-control" name="vitri" value="<?php echo $data->vitri; ?>" /></td>
					</tr>

					<tr><td>Ghi chú : </td><td><input type="textarea" value="<?php echo $data->ghichu; ?>" class="form-control" name="ghichu"/></td>
					</tr>

					<tr><td>Địa chỉ google Map : </td><td><input type="text" class="form-control" name="googlemap" value="<?php echo $data->googlemap; ?>" /></td>
					</tr>
				<?php } ?>

				<tr><td>Thẩm định : </td>
					<td>
       					<div class="radio">
					        <?php 
					        	echo $acceptStatus;
					        ?>
    						<br />
    						<font color="#FF0033">&nbsp; * Vui lòng phải chọn </font>
      					</div>
					</td>
  				</tr>

  				<tr class="makhachhang">
				    <td>Khách Hàng : </td>
				    <td>
				     	<select name="makhachhang[]" id="makhachhang" class="form-control" multiple>
						 	 <?php echo $khachhang_html; ?>
				    	</select>
				    	<script type="text/javascript">
						    $(document).ready(function() {
						        $('#makhachhang').multiselect({
						            includeSelectAllOption: true,
						            enableFiltering: true,
						            enableCaseInsensitiveFiltering: true
						        });
						    });
						</script>
				  	</td>
				</tr>

				<tr class="lydo"><td>Lý do : </td><td><input type="textarea" value="<?php echo $data->lydo; ?>" class="form-control" name="lydo"/></td>
				</tr>
				<tr>

				<tr>
  <td>Ngày booking: </td>
  <td>
    <div class="input-group">
      <input name="ngaybook" class="form-control datepicker"  value="<?php echo ($data->ngaybook) ? date('d-m-Y', $data->ngaybook) : ''; ?>" type="text">
      <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
    </div>
 </td>
</tr>
  


				<tr><td colspan="2"><input type="submit" name="save" class="btn btn-success" value="Lưu thông tin"></td>
				</tr>
			</table>
		</form>
	</div>
</div><!-- /.container -->
<script type="text/javascript">


	jQuery(function(){
		$('input[name="ketquadauvao"]').change(function(){
			var thisVal = $('input[name="ketquadauvao"]:checked').val();
			//
			switch(thisVal){
				case "Chưa book":
					$('tr.makhachhang').hide();
				break;

				default:
					$('tr.makhachhang').show();
			}
		});
	
    	$('input[name="ketquadauvao"]:checked').trigger('change');
    	$('select[name="city"]').trigger('change');
	$( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
  	});


//thamdinh
jQuery(function(){
		$('input[name="ketquathamdinh"]').change(function(){
			var thisVal = $('input[name="ketquathamdinh"]:checked').val();
			//
			switch(thisVal){
				case "Loại":
					$('tr.makhachhang').hide();
				break;

				default:
					$('tr.makhachhang').show();
			}
		});
	 $( "#datepicker" ).datepicker();
    	$('input[name="ketquathamdinh"]:checked').trigger('change');
    	$('select[name="city"]').trigger('change');
	

  	});
	
	function loadDistrict(cityId)
	{
		//reset
		$("#district, #town, #street").html("<option value=''>Chọn</option>");
		
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

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15729787.545155713!2d96.7592618818273!3d15.736311571207832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31157a4d736a1e5f%3A0xb03bb0c9e2fe62be!2sVietnam!5e0!3m2!1sen!2s!4v1456648554253" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>