<head>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/pivottable/1.3.0/pivot.min.css"/>
        <script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pivottable/1.3.0/pivot.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<style type="text/css" media="print">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->

#print_button{
display:none;
}
</style>

</style>

<?php
// load library
//require 'include/php-excel.class.php';
	if(isset($_REQUEST["keyword"])){

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

		$keyword=$_REQUEST["keyword"];
		$sql=mysql_query("select * from thuenha INNER JOIN street on thuenha.duong=street.streetId         where streetName   like'%$keyword%'   ");
		
		$num_row=mysql_num_rows($sql);
		
		
		if($num_row == 0){
			echo "<p>Không tìm thấy kết quả cho '{$keyword}'</p>";
		} else {
			echo "<p>Kết quả tìm kiếm: '{$keyword}' có {$num_row} kết quả.</p>";
			//
			echo '<table class="table table-condensed">';
			echo '<thead>
					<tr>
						<th>STT</th>
						<th>Ngày</th>
						<th>Địa chỉ</th>
							<th>Diện Tích</th>
						<th>Loại Nhà</th>
						<th>Tên của bạn</th>
						<th>Tỉnh / TP</th>
						<th>Diện tích</th>
						<th>Giá cho thuê</th>
						<th>NV phụ trách</th>
						<th>Kết quả thẩm định</th>
						<th>Lý Do</th>
						<th>Loại Đạt</th>
					
					</tr>
				</thead>';
			echo '<tbody>';
			$idx = 0;
			while($row=mysql_fetch_array($sql)){
				++$idx;
				echo "<tr>
						<td>{$idx}</td>
						
						<td>{$row["ngaythangnam"]}</td>
						<td>{$row["sonha"]},{$rsStreet[$row["duong"]]},{$rsTown[$row["phuongxa"]]},{$rsDistrict[$row["quanhuyen"]]}<br>{$rsCity[$row["tinhthanhpho"]]}</td>
						<td>{$rsTown[$row["phuongxa"]]}</td>
						<td>{$rsDistrict[$row["quanhuyen"]]}</td>
						<td>{$rsCity[$row["tinhthanhpho"]]}</td>
						<td>{$row["dientichtangtret"]}</td>
						<td>{$row["giachothue"]}</td>
						<td>{$row["nhanvienphutrach"]}</td>
						<td>{$row["ketquadauvao"]}</td>
						<td>{$row["lydo"]}</td>
						<td>{$row["loaidat"]}</td>
						
					</tr>";
			}
			echo '</tbody>';
			echo '</table>';
		}
	}


?>


<a href="include/export.php" >Xuất Report</a> / <a href="#" onClick="window.print();return false;">In Report</a>


