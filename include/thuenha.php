<?php
	if(isset($_POST['themnha']))
	{
		$banla=$didong=$ngaythangnam=$tencuaban=$gioithieu=$duongpho=$sonha=$tinh=$quan=$phuong=$duong=$giachothue=$ttgt=$dttt=$tttt=$vitri=$ghichu=$anhbenngoai=$anhbentrong=$chieudai=$solau=$googlemap=$sdtchunha=$dientichhuudung=$chungcucanho=$chungcucanhoTemp=$nhatiemnang=$danhmuc==$diachichunha="";
		$banla=$_POST['banla'];
		$didong=$_POST['didong'];
		$ngaythangnam=time();
		$tencuaban=$_POST['tencuaban'];
		$gioithieu= (isset($_POST['gioithieu'])) ? implode(', ', $_POST['gioithieu']) : '';
		$duongpho=$_POST['duongpho'];
		$sonha=$_POST['sonha'];
		$tinh=$_POST['city'];
		$quan=$_POST['district'];
		$phuong=$_POST['town'];
		$duong=$_POST['street'];
		$giachothue=$_POST['giachothue'];
		$ttgt= (isset($_POST['ttgt'])) ? implode(', ', $_POST['ttgt']) : "";
		$dttt=$_POST['dttt'];
		$tttt=$_POST['tttt'];
		$vitri= (isset($_POST['vitri'])) ? implode(', ', $_POST['vitri']) : '';
		$ghichu=$_POST['ghichu'];
		$chieudai=$_POST['chieudai'];
		$solau=$_POST['solau'];
		$googlemap=$_POST['googlemap'];
		$sdtchunha=$_POST['sdtchunha'];
		$dientichhuudung=$_POST['dientichhuudung'];
		$chungcucanho=$_POST['chungcucanho'];
   		 $chungcucanhoTemp = $_POST['chungcu_canho_temp'];
		$nhatiemnang= (isset($_POST['ntn'])) ? implode(', ', $_POST['ntn']) : "";
		$danhmuc=$_POST['danhmuc'];
		$diachichunha=$_POST['diachichunha'];
		$hoahong=$_POST['hoahong'];
		$youtube=$_POST['youtube'];


 	}
 
	if(isset( $_POST['sonha'])&& isset( $_POST['city'])&& isset( $_POST['district'])&& isset( $_POST['town'])&& isset( $_POST['street'])  )
	{

    // Neu co chung cu can ho moi thi them vao database
    if ($chungcucanhoTemp != '' && $chungcucanho == '') {
      $time = time();
      $sqlChungCu = "INSERT INTO chungcu_canho (`chungcu_canho_name`, `chungcu_canho_username`, `chungcu_canho_created_time`) VALUES ('{$chungcucanhoTemp}', '{$_SESSION['username']}', {$time})";
      $qrChungCu = mysql_query($sqlChungCu);
      // Lay id Chung cu moi nhat
      $lastIdChungCuQB = mysql_query("SELECT MAX(`chungcu_canho_id`) AS `lastId` FROM chungcu_canho");
      $lastIdChungCuRs = mysql_fetch_assoc($lastIdChungCuQB);
      $chungcucanho = $lastIdChungCuRs['lastId'];
    }
  
		$sql="select * from thuenha where sonha='".$sonha."'&& tinhthanhpho='".$tinh."'&& quanhuyen='".$quan."' && phuongxa='".$phuong."' && duong='".$duong."' && chungcucanho='{$chungcucanho}'"; 
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
      }
      if ($_FILES["anhbentrong"]["name"] != ''){
        $anhbentrong = $target_dir . basename($_FILES["anhbentrong"]["name"]);
        $anhbentrongFileType = pathinfo($anhbentrong,PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["anhbentrong"]["tmp_name"], $anhbentrong);
      }

			$sql2="insert into thuenha(banla,didong,tencuaban,gioithieu,duongpho,sonha,tinhthanhpho,quanhuyen,phuongxa,duong,giachothue,thoathuangiathue,dientichtangtret,tinhtrangtangtret,vitri,ghichu,anhbenngoai,anhbentrong,ngaythangnam,chieudai,solau,googlemap,sdtchunha,dientichhuudung,username,chungcucanho,nhatiemnang,danhmuc,diachichunha,hoahong,youtube) values('".$banla."','".$didong."','".$tencuaban."','".$gioithieu."','".$duongpho."','".$sonha."','".$tinh."','".$quan."','".$phuong."','".$duong."','".$giachothue."','".$ttgt."','".$dttt."','".$tttt."','".$vitri."','".$ghichu."','".$anhbenngoai."','".$anhbentrong."','".$ngaythangnam."','".$chieudai."','".$solau."','".$googlemap."','".$sdtchunha."','".$dientichhuudung."','".$_SESSION['username']."','".$chungcucanho."','".$nhatiemnang."','".$danhmuc."','".$diachichunha."','".$hoahong."','".$youtube."')";  
			$query2=mysql_query($sql2);
			echo '<div class="alert alert-success" role="alert">Anh/Chị đã thêm thành công ! xin mời chọn tiếp.</div>' ;
			header('Location: index.php?act=cus-booking');

		}
	}

	 //Load city
	 $sql_city = "select * from city";
	 $sql_city = mysql_query($sql_city);
	 $city_html = "<option value='0'>Chọn</option>";
	 while($city = mysql_fetch_assoc($sql_city))
	 {
	 	$city_html .= <<<eof
		<option value="{$city['cityId']}">{$city['cityName']}</option>
eof;
	 }

   //Load chung cu can ho
   $sql_chungcucanho = "select * from chungcu_canho";
   $sql_chungcucanho = mysql_query($sql_chungcucanho);
   $chungcu_canho_html = "<option></option>";
   while($chungcu_canho = mysql_fetch_assoc($sql_chungcucanho))
   {
    $chungcu_canho_html .= <<<eof
    <option value="{$chungcu_canho['chungcu_canho_id']}">{$chungcu_canho['chungcu_canho_name']}</option>
eof;
   }
	 
?><style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
.del_temp span:first-child{display: none;}
.del_temp span:last-child{display: block !important;}
-->
</style>
<form id="frm-thuenha" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="banla" class="col-sm-4 control-label">Bạn là <font color="#FF0000"></font></label>
    <div class="col-sm-8">
    	<select name='banla' class="form-control" id="banla" >
			<option value="Chính chủ">Chính chủ</option>
			<option value="Người thân của chính chủ">Người thân của chính chủ</option>
			<option value="Công ty môi giới">Công ty môi giới</option>
			<option value="Môi giới độc lập">Môi giới độc lập</option>
			<option value="Khác">Khác</option>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="didong" class="col-sm-4 control-label">Số điện thoại đại lý <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <input name="didong" type="text" class="form-control" id="didong" placeholder="">
    </div>
  </div>
  
  <div class="form-group">
    <label for="tencuaban" class="col-sm-4 control-label">Tên đại lý</label>
    <div class="col-sm-8">
      <input name="tencuaban" type="text" class="form-control" id="tencuaban" placeholder="">
    </div>
  </div>
	 <div class="form-group">
    <label for="didong" class="col-sm-4 control-label">Số điện thoại chủ nhà </label>
    <div class="col-sm-8">
      <input name="sdtchunha" type="text" class="form-control" id="sdtchunha" placeholder="">
    </div>
  </div>

	 <div class="form-group">
    <label for="dccn" class="col-sm-4 control-label">Địa chỉ chủ nhà </label>
    <div class="col-sm-8">
      <input name="diachichunha" type="text" class="form-control" id="diachichunha" placeholder="">
    </div>
  </div>

  <div class="form-group">
  	<label class="col-sm-4 control-label">Giới thiệu</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="gioithieu[]" type="checkbox" value="Nguyên căn nhà mặt phố"> Nguyên căn nhà mặt phố
        </label>
        <label>
          <input name="gioithieu[]" type="checkbox" value="Mặt bằng lối đi riêng"> Mặt bằng lối đi riêng
        </label>
      </div>
      <input name="gioithieu[]" type="text" class="form-control" id="gioithieu" placeholder="Khác">
    </div>
  </div>

  <div class="form-group">
    <label for="duongpho" class="col-sm-4 control-label">Đường phố <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
    	<select name='duongpho' class="form-control" id="duongpho" >
			<option value="Đường phố chính" >Đường phố chính</option>
			<option value="Đường nội bộ xe tải vào được">Đường nội bộ xe tải vào được</option>
			<option value="Đại lộ">Đại lộ</option>
			<option value="Hẻm xe hơi">Hẻm xe hơi</option>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="city" class="col-sm-4 control-label">Thành phố/Tỉnh <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
    	<select name='city' class="form-control" id="city" onchange="loadDistrict($(this).val())">
			<?php echo $city_html; ?>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="district" class="col-sm-4 control-label">Quận/Huyện <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
    	<select name='district' class="form-control" id="district" onchange="loadTown($(this).val())">
			<?php echo $district_html; ?>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="town" class="col-sm-4 control-label">Phường/xã <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
    	<select name='town' class="form-control" id="town" onchange="loadStreet($(this).val())">
			<?php echo $town_html; ?>
		</select>
    </div>
  </div>

  <div class="form-group">
    <label for="street" class="col-sm-4 control-label">Đường <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
    	<select name='street' class="form-control" id="street">
			<?php echo $street_html; ?>
		</select>
    </div>
  </div>
<div class="form-group">

     <label for="street" class="col-sm-4 control-label"></label>
    <div class="col-sm-8">
    	
			<font color="#FF0000">Chưa có tên đường vui lòng điền tên đường vào ô ghi chú</font>
		
    </div>
    
  </div>


  <div class="form-group">
    <label for="sonha" class="col-sm-4 control-label">Số nhà <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <input name="sonha" type="text" class="form-control" id="sonha" placeholder="">
    </div>
  </div>

<div class="form-group">
  	<label class="col-sm-4 control-label">Nhà tiềm năng</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ntn[]" type="checkbox" value="Vị trí đẹp">Vị trí đẹp
        </label>&nbsp;&nbsp;
        <label>
          <input name="ntn[]" type="checkbox" value="Nhà số đẹp">Nhà số đẹp
        </label>&nbsp;&nbsp;
        <label>
          <input name="ntn[]" type="checkbox" value="Nhà nuôi">Nhà nuôi
        </label>
        
      </div>
    </div>
  </div>




	 <div class="form-group" id="chungcucanho_ele">
		 <label for="chungcucanho" class="col-sm-4 control-label">Chung cư / Căn hộ <font color="#FF0000"></font></label>
    <div class="col-sm-8">
		  <select name='chungcucanho' class="form-control" id="chungcucanho">
        <?php echo $chungcu_canho_html; ?>
      </select>
      <input type="text" name="chungcu_canho_temp" id="chungcu_canho_temp" class="form-control" style="display: none;" />
      <script type="text/javascript">
        jQuery(function($){
          $('#chungcucanho').combobox();
          $('#chungcucanhoundefined').attr('autocomplete', 'off');
          $('#chungcucanhoundefined').keyup(function(){
            var thisVal = $(this).val();
            $('#chungcu_canho_temp').val(thisVal);
          });
          $('#chungcucanhoundefined').focusout(function(){
            var chungcucanhoVal = $('input[name="chungcucanho"]').val();
            var tempVal = $('#chungcu_canho_temp').val();
            //
            if (chungcucanhoVal == '' && tempVal != ''){
              $(this).hide();
              $(this).closest('.input-group').prepend($('#chungcu_canho_temp').show());
              $('#chungcucanho_ele .input-group-addon').addClass('del_temp');
              return false;
            }
          });
          //
          $('#chungcucanho_ele').on('click', '.del_temp', function(){
            $(this).removeClass('del_temp');
            $('#chungcu_canho_temp').val('').hide();
            $('#chungcucanhoundefined').show();
            return false;
          });
        });
      </script>
    </div>
  </div>

<div class="form-group">
    <label for="danhmuc" class="col-sm-4 control-label">Danh mục (Mục đích sử dụng) <font color="#FF0000"></font></label>
    <div class="col-sm-8">
      <select name='danhmuc' class="form-control" id="danhmuc" >
			<option value="Khác">---Khác--</option>
			<option value="Biệt thự">Biệt thự</option>
			<option value="Cửa hàng tiện ích">Cửa hàng tiện ích</option>
			<option value="Siêu thị">Siêu thị</option>
			<option value="Chi nhánh ngân hàng">Chi nhánh ngân hàng</option>
			<option value="Shop">Shop</option>
			<option value="Trường học">Trường học</option>
			<option value="Quán ăn">Quán ăn</option>
			<option value="Nhà hàng">Nhà hàng</option>
			<option value="Khách sạ">Khách sạn</option>
			<option value="Kiot,sạp chợ">Kiot,sạp chợ</option>
			<option value="Quán cà phê">Quán cà phê</option>
			<option value="Spa">Spa</option>
			<option value="Tiệm tóc">Tiệm tóc</option>
			<option value="Villa">Villa</option>
			<option value="Văn phòng">Văn phòng</option>
			
		</select>
    </div>
  </div>


  <div class="form-group">
    <label for="giachothue" class="col-sm-4 control-label">Giá cho thuê <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <input name="giachothue" type="text" class="form-control" id="giachothue" placeholder="" autocomplete="off">
    </div>
  </div>

  <div class="form-group">
  	<label class="col-sm-4 control-label">Thoả thuận giá thuê</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="ttgt[]" type="checkbox" value="Giá bao gồm thuế"> Giá bao gồm thuế
        </label>
        <label>
          <input name="ttgt[]" type="checkbox" value="Giá cố định trong 3 năm đầu"> Giá cố định trong 3 năm đầu
        </label>
        <label>
          <input name="ttgt[]" type="checkbox" value="Giá còn thương lượng"> Giá còn thương lượng
        </label>
        <label>
          <input name="ttgt[]" type="checkbox" value="Giá đã chốt"> Giá đã chốt
        </label>
      </div>
    </div>
  </div>


	 <div class="form-group">
    <label for="hoahong" class="col-sm-4 control-label">Hoa hồng </label>
    <div class="col-sm-8">
      <input name="hoahong" type="text" class="form-control" id="hoahong" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="dttt" class="col-sm-4 control-label">Chiều ngang</label>
    <div class="col-sm-8">
      <input name="dttt" type="text" class="form-control" id="dttt" placeholder="Chiều ngang">
    </div>
  </div>
	
  <div class="form-group">
    <label for="dttt" class="col-sm-4 control-label ">Chiều dài</label>
    <div class="col-sm-8 ">
      <input name="chieudai" type="text" class="form-control  " id="chieudai" placeholder="Chiều dài ">    
    </div>
  </div>
	
	 <div class="form-group">
    <label for="dthd" class="col-sm-4 control-label ">Diện tích hữu dụng</label>
    <div class="col-sm-8 ">
      <input name="dientichhuudung" type="text" class="form-control  " id="dientichhuudung" placeholder="Diện tích hữu dụng">    
    </div>
  </div>
   
  <div class="form-group">
    <label for="dttt" class="col-sm-4 control-label ">Số lầu</label>
    <div class="col-sm-8 ">
      <input name="solau" type="text" class="form-control  " id="solau" placeholder="Số lầu">    
    </div>
  </div>


  <div class="form-group">
    <label for="tttt" class="col-sm-4 control-label">Tình trạng tầng trệt <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
    	<select name='tttt' class="form-control" id="tttt" >
			<option value="Trong suốt">Trống suốt</option>
			<option value="Cầu thang cuối nhà">Cầu thang cuối nhà</option>
			<option value="Cầu thang 2/3 nhà">Cầu thang 2/3 nhà</option>
			<option value="Cầu thang giữa nhà">Cầu thang giữa nhà</option>
			<option value="Cầu thang trước nhà">Cầu thang trước nhà</option>
		</select>
    </div>
  </div>

  <div class="form-group">
  	<label class="col-sm-4 control-label">Vị trí</label>
    <div class="col-sm-8">
      <div class="checkbox">
        <label>
          <input name="vitri[]" type="checkbox" value="Góc 2 mặt tiền đường lớn"> Góc 2 mặt tiền đường lớn
        </label>
        <label>
          <input name="vitri[]" type="checkbox" value="Góc 2 mặt tiền hẻm"> Góc 2 mặt tiền hẻm
        </label>
        <label>
          <input name="vitri[]" type="checkbox" value="Vòng xoay nhiều ngã"> Vòng xoay nhiều ngã
        </label>
        <label>
			<input name="vitri[]" type="checkbox" value="Gần ngã ba/ Ngã tư"> Gần ngã ba/ Ngã tư
        </label>
        <label>
			<input name="vitri[]" type="checkbox" value="Chung cư/ Cao ốc"> Chung cư/ Cao ốc 
        </label>
        <label>
			<input name="vitri[]" type="checkbox" value="Bên cạnh/ Đối diện/ Gần trường học, bệnh viện, chợ"> Bên cạnh/ Đối diện/ Gần trường học, bệnh viện, chợ
        </label>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="ghichu" class="col-sm-4 control-label">Ghi chú</label>
    <div class="col-sm-8">
      <textarea rows="5" cols="40" class="form-control" name="ghichu" id="ghichu"></textarea>
    </div>
  </div>

  <div class="form-group">
    <label for="anhbenngoai" class="col-sm-4 control-label">Ảnh bên ngoài</label>
    <div class="col-sm-8">
      <input name="anhbenngoai" type="file" class="form-control" id="anhbenngoai" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="anhbentrong" class="col-sm-4 control-label">Ảnh bên trong</label>
    <div class="col-sm-8">
      <input name="anhbentrong" type="file" class="form-control" id="anhbentrong" placeholder="">
    </div>
  </div>

	<div class="form-group">
    <label for="googlemap" class="col-sm-4 control-label">Địa chỉ trên google map <font color="#FF0000"></font></label>
    <div class="col-sm-8">
      <input name="googlemap" type="text" class="form-control" id="googlemap" placeholder="">
    </div>
  </div>


	<div class="form-group">
    <label for="googlemap" class="col-sm-4 control-label">Link video Youtube <font color="#FF0000"></font></label>
    <div class="col-sm-8">
      <input name="youtube" type="text" class="form-control" id="youtube" placeholder="">
    </div>
  </div>
	
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button name="themnha" type="submit" class="btn btn-success">Nhập</button>
    </div>
  </div>

</form>

<script>
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
	
	$(document).ready(function(){
		loadDistrict(1);
	})

	$('#frm-thuenha').validate({
        focusCleanup: true,
        rules: {
            city: {
                required: true,
                min: 1,
            },
            district: {
                required: true,
                min: 1,
            },
            town: {
                required: true,
                min: 1,
            },
            street: {
                required: true,
                min: 1,
            },
            sonha: {
                required: true,
            },
            giachothue: {
                required: true,
				number: true,
            },
            didong: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11,
            },
			sdtchunha: {
				//required: true,
				//number: true,
				// minlength: 10,
				//maxlength: 11,
            }
			
        },
        messages: {
            city: {
                required: "Vui lòng chọn Thành phố/Tỉnh.",
                min: "Vui lòng chọn Thành phố/Tỉnh.",
            },
            district: {
                required: "Vui lòng chọn Quận/Huyện.",
                min: "Vui lòng chọn Quận/Huyện.",
            },
            town: {
                required: "Vui lòng chọn Phường/xã.",
                min: "Vui lòng chọn Phường/xã.",
            },
            street: {
                required: "Vui lòng chọn Đường.",
                min: "Vui lòng chọn Đường.",
            },
            sonha: {
                required: "Vui lòng nhập tên tài khoản.",
            },
            giachothue: {
                required: "Vui lòng nhập giá bằng số.",
				number: "Vui lòng nhập số.",
            },
            didong: {
                required: "Vui lòng nhập số điện thoại.",
                number: "Vui lòng nhập đúng số điện thoại.",
                minlength: "Vui lòng nhập số điện thoại 10-11 ký tự.",
                maxlength: "Vui lòng nhập số điện thoại 10-11 ký tự."
            },
			sdtchunha: {
				// required: "Vui lòng nhập số điện thoại.",
				//number: "Vui lòng nhập đúng số điện thoại.",
				//minlength: "Vui lòng nhập số điện thoại 10-11 ký tự.",
				//maxlength: "Vui lòng nhập số điện thoại 10-11 ký tự."
            },
        },
        invalidHandler: function (form, validator) {
            var errors = validator.numberOfInvalids();
            if (errors) {
                validator.errorList[0].element.focus(); //Set Focus
            }
        },
        errorClass: "input-validation-error",
    });

    jQuery(function(){
        $('#giachothue').number( true); 
    });
	
</script>