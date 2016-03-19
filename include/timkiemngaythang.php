<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
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

	if(isset($_POST['themnha1']))
	{
		$banla=$didong=$ngaythangnam=$tencuaban=$gioithieu=$duongpho=$sonha=$tinh=$quan=$phuong=$duong=$giachothue=$ttgt=$dttt=$tttt=$vitri=$ghichu=$anhbenngoai=$anhbentrong="";
		
		$ngaythangnam=$_POST['ngaythangnam1'];
		
		
		

 	}
 
	if( isset( $_POST['ngaythangnam1']) )
	{
  
		$sql=mysql_query("select * from thuenha where ngaythangnam='".$ngaythangnam."'");
		$num_row=mysql_num_rows($sql); 
		
		
		if($num_row == 0 )
		{
			echo "<p>Không tìm thấy kết quả </p>";
		}
		else {
			echo "<p>Kết quả tìm kiếm: có {$num_row} kết quả.</p>";
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
						
					
					</tr>
				</thead>';
			echo '<tbody>';
			$idx = 0;
			while($row=mysql_fetch_array($sql)){
				++$idx;
				echo "<tr>
						<td>{$idx}</td>
						
						<td>{$row["ngaythangnam"]}</td>
						<td>{$row["sonha"]},{$rsStreet[$row["duong"]]}<br>{$rsTown[$row["phuongxa"]]},{$rsDistrict[$row["quanhuyen"]]},{$rsCity[$row["tinhthanhpho"]]}</td>
						<td>{$row["dientichtangtret"]}</td>
						<td>{$row["giachothue"]}</td>
						<td>{$row["gioithieu"]}</td>
						<td>{$row["vitri"]}</td>
						
						
						<td>{$row["tencuaban"]}<br>{$row["didong"]}</td>
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