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

<div class="form-group">
  <label for="city" class="col-sm-4 control-label">Thành phố/Tỉnh</label>
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
    </select>
    </div>
  </div>

  <div class="form-group">
    <label for="town" class="col-sm-4 control-label">Phường/xã <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <select name='town' class="form-control" id="town" onchange="loadStreet($(this).val())">
      </select>
    </div>
  </div>
<div class="form-group">
    <label for="street" class="col-sm-4 control-label">Tên Đường <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <select name='street' class="form-control" id="street">
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="sonha" class="col-sm-4 control-label">Số nhà <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <input name="sonha" type="text" class="form-control" id="sonha" placeholder="">
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