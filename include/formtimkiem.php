<?php
//Load city
$sql_city = "select * from city";

$sql_city = mysql_query($sql_city);

$city_html = "<option value=''>Chọn</option>";
while($city = mysql_fetch_assoc($sql_city))
{
 $city_html .= <<<eof
 <option value="{$city['cityId']}">{$city['cityName']}</option>
eof;
}
// Username
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : $_SESSION['username'];
?>

<form id="frm-search" action="index.php" method="get" class="form-horizontal  formtim">
  <input type="hidden" name="act" value="searchtenduong">

  <input type="hidden" name="username" value="<?php echo $username;?>">

  <div class="form-group">
    <label for="city" class="col-sm-4 control-label">Từ khóa</label>
    
    <div class="col-sm-8">
      <input type="text" name="keyword" class="form-control" placeholder="Số điện thoại, tên, số nhà...">
    </div>
  </div>
  
  <div class="form-group">
    <label for="city" class="col-sm-4 control-label">Thời gian (từ - đến)</label>
    <div class="col-sm-8">
      <div class="input-group input-group-sm">
        <input type="text" class="form-control" id="ngay_tu" name="ngay_tu" placeholder="dd-mm-yyyy" value="<?php echo (isset($_GET['ngay_tu'])) ? $_GET['ngay_tu'] : '' ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        <input type="text" class="form-control" id="ngay_den" name="ngay_den" placeholder="dd-mm-yyyy" value="<?php echo (isset($_GET['ngay_den'])) ? $_GET['ngay_den'] : '' ?>">
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
  </div>

<div class="form-group">
  <label for="street" class="col-sm-4 control-label">Tìm theo loại hồ sơ</label>
  <div class="col-sm-8">
    <select name="loaidat" class="form-control">
      <option value="">--Chọn--</option>
      <option value="Đã hủy HĐ">Đã hủy HĐ</option>
      <option value="Cân nhắc">Cân nhắc</option>
      <option value="Chuyển đàm phán">Chuyển đàm phán</option>
      <option value="Đã ký HĐ">Đã ký HĐ</option>
      <option value="Mời ký HĐ">Mời ký HĐ</option>
      <option value="Đã thanh toán tiền thuê">Đã thanh toán tiền thuê</option>
      <option value="Đã ký thành công">Đã ký thành công</option>
      <option value="Đã đặt cọc thuê nhà">Đã đặt cọc thuê nhà</option>
      <option value="Đạt sơ bộ">Đạt sơ bộ</option>
      <option value="Chưa thực hiện">Chưa thực hiện</option>
      <option value="Đã book">Đã book</option>
      <option value="Chưa book">Chưa book</option>
      <option value="Đạt">Đạt</option>
      <option value="Loại">Không đạt</option>
      <option value="Loại">Loại</option>
    </select>
 </div>
</div>

<div class="form-group">
  <div class="col-sm-offset-4 col-sm-8">
    <button name="search" type="submit" value="search" class="btn btn-success">Tìm Kiếm</button>
    <a class="btn btn-primary" href="javascript:history.go(-1);" role="button">Trở lại</a>
  </div>
</div>


</form>

<script>
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
  $("#town, #street").html("<option value=''>Chọn</option>");

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
  $("#street").html("<option value=''>Chọn</option>");

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
  $( "#ngay_tu, #ngay_den" ).datepicker({dateFormat: 'dd-mm-yy'});
})

</script>