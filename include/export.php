<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once("../connect/connect.php");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=data.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	//
	$qbCity = mysql_query("SELECT * FROM city");
	$rsCity = array();
	while ($fetchCity = mysql_fetch_assoc($qbCity)) {
	  $rsCity[$fetchCity['cityId']] = $fetchCity['cityName'];
	}

	//
	$qbDistrict = mysql_query("SELECT * FROM district");
	$rsDistrict = array();
	while ($fetchDistrict = mysql_fetch_assoc($qbDistrict)) {
	  $rsDistrict[$fetchDistrict['districtId']] = $fetchDistrict['districtName'];
	}

	//
	$qbTown = mysql_query("SELECT * FROM town");
	$rsTown = array();
	while ($fetchTown = mysql_fetch_assoc($qbTown)) {
	  $rsTown[$fetchTown['townId']] = $fetchTown['townName'];
	}

	//
	$qbStreet = mysql_query("SELECT * FROM street");
	$rsStreet = array();
	while ($fetchStreet = mysql_fetch_assoc($qbStreet)) {
	  $rsStreet[$fetchStreet['streetId']] = $fetchStreet['streetName'];
	}
 
	if( isset( $_REQUEST['search']) )
	{
		//
  		$keyword = isset($_REQUEST['keyword']) ?  $_REQUEST['keyword'] : "";
  		$ngay_tu = isset($_REQUEST['ngay_tu']) ?  $_REQUEST['ngay_tu'] : "";
  		$ngay_den = isset($_REQUEST['ngay_den']) ?  $_REQUEST['ngay_den'] : "";
  		$city = isset($_REQUEST['city']) ?  $_REQUEST['city'] : "";
  		$district = isset($_REQUEST['district']) ? $_REQUEST['district'] : "";
  		$town = isset($_REQUEST['town']) ? $_REQUEST['town'] : "";
  		$street = isset($_REQUEST['street']) ? $_REQUEST['street'] : "";
  
		$qbSearch = "select * from thuenha where 1=1 ";

		//
		if ($keyword != ''){
			$qbSearch .= " AND (banla LIKE '%{$keyword}%' OR didong LIKE '%{$keyword}%' OR tencuaban LIKE '%{$keyword}%' OR duongpho LIKE '%{$keyword}%' OR sonha LIKE '%{$keyword}%')";
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
		//
		$qbSearch .= " ORDER BY ngaythangnam DESC ";
		//
		$sql = mysql_query($qbSearch);
		$num_row=mysql_num_rows($sql); 
		
		if($num_row == 0 )
		{
			echo "<p>Không tìm thấy kết quả </p>";
		}
		else {
			echo "<p>Kết quả tìm kiếm: có {$num_row} kết quả.</p>";
			//
			echo '<table style="width: 100%;border-collapse: collapse;" border="1">';
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
					</tr>
				</thead>';
			echo '<tbody>';
			$idx = 0;
			while($row=mysql_fetch_array($sql)){
				$idx++;
				$ngaythangnam = ($row["ngaythangnam"]) ? date('d-m-Y', $row["ngaythangnam"]) : '';
				echo "<tr>
						<td>{$idx}</td>
						
						<td> {$ngaythangnam}</td>
						<td>***,{$rsStreet[$row["duong"]]}<br>{$rsTown[$row["phuongxa"]]},{$rsDistrict[$row["quanhuyen"]]},{$rsCity[$row["tinhthanhpho"]]}</td>
						<td>Ngang:{$row["dientichtangtret"]}<br>Dài:{$row["chieudai"]}<br>Số lầu:{$row["solau"]}</td>
						<td>{$row["giachothue"]}</td>
						<td>{$row["gioithieu"]}</td>
						<td>{$row["vitri"]}</td>
						
						
						<td>{$row["tencuaban"]}<br>{$row["didong"]}<br>SDT chủ nhà: {$row["sdtchunha"]}</td>
						<td>{$row["loaidat"]}</td>
						<td>{$row["ketquadauvao"]}</td>
						
						<td>{$row["lydo"]}</td>
						<td>{$row["nhanvienphutrach"]}</td>
						
					</tr>";
			}
			echo '</tbody>';
			echo '</table>';
		}
	}
	
?>