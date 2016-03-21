<?php
	if(isset($_POST['themkhachhang']))
	{
    $ten        = isset($_POST['ten']) ? $_POST['ten'] : '';
    $hoten      = isset($_POST['hoten']) ? $_POST['hoten'] : '';
    $dienthoai  = isset($_POST['dienthoai']) ? $_POST['dienthoai'] : '';
    $email      = isset($_POST['email']) ? $_POST['email'] : '';
    $diachi     = isset($_POST['diachi']) ? $_POST['diachi'] : '';
    $masothue   = isset($_POST['masothue']) ? $_POST['masothue'] : '';
    $nhanhieu   = isset($_POST['nhanhieu']) ? $_POST['nhanhieu'] : '';
    $ngayhoptac = (isset($_POST['ngayhoptac']) && $_POST['ngayhoptac'] != '') ? strtotime($_POST['ngayhoptac']) : 'NULL';
    $danhmuc    = isset($_POST['danhmuc']) ? $_POST['danhmuc'] : '';

    //
    $sql = "INSERT INTO khachhang (`ten`,`hoten`,`dienthoai`,`email`,`diachi`,`masothue`,`nhanhieu`,`ngayhoptac`,`danhmuc`) VALUES('".$ten."','".$hoten."','".$dienthoai."','".$email."','".$diachi."','".$masothue."','".$nhanhieu."',".$ngayhoptac.",'".$danhmuc."')";  

    $qr = mysql_query($sql);

    echo '<div class="alert alert-success" role="alert">Anh/Chị đã thêm thành công ! xin mời chọn tiếp.</div>' ;
    header('Location: index.php?act=cus-khachhang');
 	}
	 
?>
<form id="frm-thuenha" class="form-horizontal" action="" method="post">
  
  <div class="form-group">
    <label for="ten" class="col-sm-4 control-label">Tên Khách Hàng</label>
    <div class="col-sm-8">
      <input name="ten" type="text" class="form-control" id="ten" placeholder="">
    </div>
  </div>

	<div class="form-group">
    <label for="hoten" class="col-sm-4 control-label">Họ Tên </label>
    <div class="col-sm-8">
      <input name="hoten" type="text" class="form-control" id="hoten" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="dienthoai" class="col-sm-4 control-label">Số Điện Thoại</label>
    <div class="col-sm-8">
      <input name="dienthoai" type="text" class="form-control" id="dienthoai" placeholder="">
    </div>
  </div>

	<div class="form-group">
    <label for="email" class="col-sm-4 control-label">Email </label>
    <div class="col-sm-8">
      <input name="email" type="text" class="form-control" id="email" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="diachi" class="col-sm-4 control-label">Địa chỉ </label>
    <div class="col-sm-8">
      <input name="diachi" type="text" class="form-control" id="diachi" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="masothue" class="col-sm-4 control-label">Mã số Thuế </label>
    <div class="col-sm-8">
      <input name="masothue" type="text" class="form-control" id="masothue" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="nhanhieu" class="col-sm-4 control-label">Nhãn Hiệu </label>
    <div class="col-sm-8">
      <input name="nhanhieu" type="text" class="form-control" id="nhanhieu" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="ngayhoptac" class="col-sm-4 control-label">Ngày Hợp Tác </label>
    <div class="col-sm-8">
      <input name="ngayhoptac" type="text" class="form-control datepicker" id="ngayhoptac" placeholder="">
    </div>
  </div>


  <div class="form-group">
    <label for="danhmuc" class="col-sm-4 control-label">Danh Mục </label>
    <div class="col-sm-8">
      <select name='danhmuc' class="form-control" id="danhmuc" >
  			<option value="Khác">---Khác---</option>
  			<option value="Khách hàng vãng lai">Khách hàng vãng lai</option>
  			<option value="Hợp đồng đặt hàng">Hợp đồng đặt hàng</option>
  			<option value="Khách hàng tiềm năng">Khách hàng tiềm năng</option>
  			<option value="Đã hủy hợp tác">Đã hủy hợp tác</option>
  		</select>
    </div>
  </div>
	
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button name="themkhachhang" type="submit" class="btn btn-success">Nhập</button>
    </div>
  </div>

</form>

<script>
	
	$('#frm-thuenha').validate({
        focusCleanup: true,
        rules: {
            ten: {
                required: true,
            },
            dienthoai: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 11,
            },
        },
        messages: {
            ten: {
                required: "Vui lòng nhập tên khách hàng.",
            },
            dienthoai: {
                required: "Vui lòng nhập số điện thoại.",
                number: "Vui lòng nhập đúng số điện thoại.",
                minlength: "Vui lòng nhập số điện thoại 10-11 ký tự.",
                maxlength: "Vui lòng nhập số điện thoại 10-11 ký tự."
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
        $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
    });
	
</script>