<?php
	$sql = "SELECT * FROM khachhang WHERE 1=1";
	// Tu khoa
	$tuKhoa = isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
	if ($tuKhoa != '') {
		$sql .= " AND (`ten` LIKE %keyword% OR `hoten` LIKE %keyword% OR `dienthoai` LIKE %keyword% OR `email` LIKE %keyword% OR `diachi` LIKE %keyword% OR `masothue` LIKE %keyword% OR `nhanhieu` LIKE %keyword%)";
		$sql = str_replace('%keyword%', "'%{$tuKhoa}%'", $sql);
	}
	// Ngay hop tac tu
	$ngayhoptac_from = isset($_REQUEST['ngayhoptac_from']) ? $_REQUEST['ngayhoptac_from'] : '';
	if ($ngayhoptac_from != '') {
		$sql .= " AND ngayhoptac >= " . strtotime($ngayhoptac_from);
	}
	// Ngay hop tac den
	$ngayhoptac_to = isset($_REQUEST['ngayhoptac_to']) ? $_REQUEST['ngayhoptac_to'] : '';
	if ($ngayhoptac_to != '') {
		$sql .= " AND ngayhoptac <= " . strtotime($ngayhoptac_to . ' 23:59');
	}
	// Danh muc
	$danhmuc = isset($_REQUEST['danhmuc']) ? $_REQUEST['danhmuc'] : '';
	if ($danhmuc != '') {
		$sql .= " AND danhmuc = '{$danhmuc}'";
	}
	//
	$sql .= " ORDER BY makhachhang DESC";
	//die($sql);

	// Phan trang
	$maxItem = mysql_num_rows(mysql_query($sql)); // Tong so dong
	$itemOnPage = 30; // So dong tren 1 trang
	$pageNum = ceil($maxItem/$itemOnPage);
	if (isset($_REQUEST['page'])){
		$page = $_REQUEST['page'];
	}else{
		$page = 1;
	}

	if ($page != '') {
		$limit = ($page-1) * $itemOnPage;
	  	$sql .= " LIMIT {$limit}, $itemOnPage";
	}

	//
	$qr = mysql_query($sql);
?>
<style type="text/css">
	.marketing{margin: 0 0;}
	.header{margin-bottom:0;}
	.head-info{margin-top: 0;}
</style>
<div class="row">
	<div class="col-md-6">
		<h3 class="head-info">Danh sách khách hàng</h3>
	</div>
	<div class="col-md-6 text-right">
		<a class="btn btn-default" href="index.php?act=cus-khachhang-insert" role="button">Thêm mới</a>
		
		<div style="float: right;">
			<div class="dropdown" style="z-index: 1;">
			  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    Tìm Kiếm
			    <span class="caret"></span>
			  </button>
			  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2" style="width: 400px;">
			  	<form class="col-xs-12" action="" method="get">
			  		<input type="hidden" name="act" value="cus-khachhang"></input>
			  		<div class="form-group">
					    <label for="keyword">Từ khóa</label>
					    <input type="text" class="form-control" id="keyword" placeholder="Tên, điện thoại, email,..." name="keyword" value="<?php echo $tuKhoa; ?>">
					</div>
					<div class="form-group">
					    <label for="ngayhoptac_from">Ngày hợp tác (từ - đến)</label>
					    <div class="input-group">
					    	<input type="text" class="form-control datepicker" id="ngayhoptac_from" name="ngayhoptac_from" value="<?php echo $ngayhoptac_from; ?>">
					    	<div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
					    	<input type="text" class="form-control datepicker" id="ngayhoptac_to" name="ngayhoptac_to" value="<?php echo $ngayhoptac_to; ?>">
					    	<div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
					    </div>
					</div>
					<div class="form-group">
					    <label for="danhmuc">Danh mục</label>
					    <select name='danhmuc' class="form-control" id="danhmuc" >
					    	<option value=""></option>
				  			<option value="Khác">---Khác---</option>
				  			<option value="Khách hàng vãng lai">Khách hàng vãng lai</option>
				  			<option value="Hợp đồng đặt hàng">Hợp đồng đặt hàng</option>
				  			<option value="Khách hàng tiềm năng">Khách hàng tiềm năng</option>
				  			<option value="Đã hủy hợp tác">Đã hủy hợp tác</option>
				  		</select>
					</div>
					<div class="form-group">
					    <input type="submit" style="background-color: #F93;" class="form-control" id="btnSearch" name="btnSearch" value="Tìm kiếm">
					</div>
				</form>
			  </div>
			</div>
		</div>
		<a href="#" data-value="<?php echo $_SERVER['REQUEST_URI']; ?>" class="btn btn-default export-excel" style="margin-left:10px; float: right;" role="button">Tải về</a>
		
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>STT</th>
			<th>Tên</th>
			<th>Điện thoại</th>
			<th>Email</th>
			<th>Địa chỉ</th>
			<th>MST</th>
			<th>Nhãn hiệu</th>
			<th>Ngày HT</th>
			<th>Danh mục</th>
			<th>Quản lý</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$no = 0;
			while ($rows = mysql_fetch_object($qr)) { 
		?>
		<tr>
			<td align="center"><?php echo ++$no; ?></td>
			<td><?php echo $rows->hoten . ' (' . $rows->ten . ')'; ?></td>
			<td><?php echo $rows->dienthoai; ?></td>
			<td><?php echo $rows->email; ?></td>
			<td><?php echo $rows->diachi; ?></td>
			<td><?php echo $rows->masothue; ?></td>
			<td><?php echo $rows->nhanhieu; ?></td>
			<td><?php echo ($rows->ngayhoptac) ? date('d.m.Y', $rows->ngayhoptac) : ''; ?></td>
			<td><?php echo $rows->danhmuc; ?></td>
			<td align="center">
				<a href="index.php?act=cus-khachhang-update&id=<?php echo $rows->makhachhang; ?>" title="Cập nhật">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
				<a class="booking-delete" href="index.php?act=cus-khachhang-delete&id=<?php echo $rows->makhachhang; ?>" title="Xóa">
					<span class="glyphicon glyphicon-minus-sign"></span>
				</a>
			</td>
		</tr>
		<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<td colspan="100" align="center"><?php include('include/pagination.php'); ?></td>
		</tr>
	</tfoot>
</table>
<script type="text/javascript">
	jQuery(function(){
        $( ".datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
    });
</script>
<iframe id="ifm-export-excel" src="" style="display:none; width:100%; "></iframe>
<script type="text/javascript">
  jQuery(function($){
    $('.export-excel').on('click', function(){
      $('#ifm-export-excel').attr('src', 'include/khachhang-excel.php' + $(this).data('value') + "&search=search");
      return false;
    })
  });
</script>