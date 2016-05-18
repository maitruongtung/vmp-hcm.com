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

 
	if( isset( $_REQUEST['search']) )
	{
		//
  		$keyword	= isset($_REQUEST['keyword']) ? $_REQUEST['keyword'] : '';
  		$ngay_tu	= isset($_REQUEST['ngay_tu']) ? $_REQUEST['ngay_tu'] : '';
  		$ngay_den	= isset($_REQUEST['ngay_den']) ? $_REQUEST['ngay_den'] : '';
  		$city 		= isset($_REQUEST['city']) ? $_REQUEST['city'] : '';
  		$district 	= isset($_REQUEST['district']) ? $_REQUEST['district'] : '';
  		$town 		= isset($_REQUEST['town']) ? $_REQUEST['town'] : '';
  		$street 	= isset($_REQUEST['street']) ? $_REQUEST['street'] : '';
  		$sonha 		= isset($_REQUEST['sonha']) ? $_REQUEST['sonha'] : '';
		$loaidat 	= isset($_REQUEST['loaidat']) ? $_REQUEST['loaidat'] : '';
		$googlemap 	= isset($_REQUEST['googlemap']) ? $_REQUEST['googlemap'] : '';
		$username 	= isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
		$didong		= isset($_REQUEST['didong']) ? $_REQUEST['didong'] : '';
		$username1 	= $_SESSION["username"];
  
		$qbSearch = "select * from thuenha LEFT JOIN street AS ST ON duong = ST.streetId LEFT JOIN district AS DT ON quanhuyen = DT.districtId where 1=1";

		//
		if ($keyword != ''){
			$qbSearch .= " AND (banla LIKE '%{$keyword}%' OR didong LIKE '%{$keyword}%' OR tencuaban LIKE '%{$keyword}%' OR duongpho LIKE '%{$keyword}%' OR sonha LIKE '%{$keyword}%' OR streetName LIKE '%{$keyword}%' OR districtName LIKE '%{$keyword}%')";
		}
		// 
		if ($ngay_tu != ''){
			$ngay_tu = strtotime($ngay_tu);
			$qbSearch .= " AND ngaythangnam >= {$ngay_tu}";
		}
		// 
		if ($ngay_den != ''){
			$ngay_den = strtotime($ngay_den." 23:59");
			$qbSearch .= " AND ngaythangnam <= {$ngay_den}";
		}
		// 
		if ($city != ''){
			$qbSearch .= " AND tinhthanhpho = {$city}";
		}
		// 
		if ($district != ''){
			$qbSearch .= " AND quanhuyen = {$district}";
		}
		// 
		if ($town != ''){
			$qbSearch .= " AND phuongxa = {$town}";
		}
		if ($street != ''){
			$qbSearch .= " AND duong = {$street}";
		}
		if ($sonha != ''){
			$qbSearch .= " AND sonha LIKE '%{$sonha}%'";
		}
		//
		if ($loaidat != ''){
			$qbSearch .= " AND (loaidat LIKE '{$loaidat}' OR ketquadauvao LIKE '{$loaidat}' OR ketquathamdinh LIKE '{$loaidat}' OR ketquadamphan LIKE '{$loaidat}' )";
		}
		//
		if ($username != ''){
			$qbSearch .= " AND username = '{$username}'";
		}
		
		if ($didong != ''){
			$qbSearch .= " AND didong = '{$didong}'";
		}
		
		//
		$qbSearch .= " ORDER BY ngaythangnam DESC ";
		//echo $qbSearch;

		// Phan trang
		$maxItem = mysql_num_rows(mysql_query($qbSearch)); // Tong so dong
		$itemOnPage = 30; // So dong tren 1 trang
		$pageNum = ceil($maxItem/$itemOnPage);
		if (isset($_REQUEST['page'])){
			$page = $_REQUEST['page'];
		}else{
			$page = 1;
		}

		if ($page != '') {
			$limit = ($page-1) * $itemOnPage;
		  	$qbSearch .= " LIMIT {$limit}, $itemOnPage";
		}

		$sql = mysql_query($qbSearch);
		
		if($maxItem == 0 )
		{
			echo "<p>Không tìm thấy kết quả </p>";
			require_once("include/formtimkiem.php");
		}
		else {
			echo "<p>Danh sách của : $username1  có {$maxItem} kết quả.</p>";
			//
			echo '<table class="table table-condensed">';
			echo '<thead>
					<tr>
						<th>Mã số</th>
						<th>Ngày</th>
						<th>Địa chỉ</th>
							<th>Diện Tích</th>
						<th>Giá Thuê</th>
						<th>Loại nhà</th>
						<th>Vị trí</th>
						
						<th>Liên Hệ</th>
						<th>Onsite</th>
						<th>Offsite</th>
						<th>Lý Do</th>
						<th>Thẩm định Offsite</th>
						<th>Username</th>
						
					
					</tr>
				</thead>';
			echo '<tbody>';
			$idx = 0;
			while($row=mysql_fetch_array($sql)){
				++$idx;
				$ngaythangnam = ($row["ngaythangnam"]) ? date('d-m-Y', $row["ngaythangnam"]) : '';
				echo "<tr>
						<td>{$idx}</td>
						
						<td>{$ngaythangnam}</td>
						<td>{$row["sonha"]},{$rsStreet[$row["duong"]]}<br>{$rsTown[$row["phuongxa"]]},{$rsDistrict[$row["quanhuyen"]]},{$rsCity[$row["tinhthanhpho"]]}</td>
						<td>Ngang:{$row["dientichtangtret"]}<br>Dài:{$row["chieudai"]}<br>Số lầu:{$row["solau"]}</td>
						<td>{$row["giachothue"]}</td>
						<td>{$row["gioithieu"]}</td>
						<td>{$row["vitri"]}</td>
						
						
						<td>{$row["tencuaban"]}<br>{$row["didong"]}<br>SDT chủ nhà:{$row["sdtchunha"]}</td>
						
						<td>{$row["ketquadauvao"]}</td>
						<td>{$row["loaidat"]}</td>
						<td>{$row["lydo"]}</td>
						<td>{$row["nhanvienphutrach"]}</td>
						<td>{$row["username"]}</td>
						
					</tr>";
			}
			echo '</tbody>';
			echo '<tfoot><tr><td colspan="100" align="right">';
			include('include/pagination.php');
          	echo '</td></tr></tfoot>';
			echo '</table>';
		}
	}
	
?>
<p><br>
<a href="index.php?act=searchtimkiem&username=<?php echo $username;?>" >TRỞ LẠI TÌM KIẾM</a>
<a href="#" data-value="<?php echo $_SERVER['REQUEST_URI']; ?>" class="export-excel" style="margin-left:10px;">TẢI VỀ</a>
</p>
<iframe id="ifm-export-excel" src="" style="display:none; width:100%; "></iframe>
<script type="text/javascript">
  jQuery(function($){
    $('.export-excel').on('click', function(){
      $('#ifm-export-excel').attr('src', 'include/export-excel.php' + $(this).data('value') + "&search=search");
      return false;
    })
  });
</script>