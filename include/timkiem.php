<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
-->
</style><?php
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
		$sql=mysql_query("select * from thuenha where didong like'%$keyword%' order by ngaythangnam desc  ");
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
						<th>Số nhà</th>
							<th>Tên đường</th>
						<th>Phường</th>
						<th>Quận</th>
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
				$ngaythangnam = ($row["ngaythangnam"]) ? date('d-m-Y', $row["ngaythangnam"]) : '';
				echo "<tr>
						<td>{$idx}</td>
						
						<td>{$ngaythangnam}</td>
						<td>***</td>
						<td>{$rsStreet[$row["duong"]]}</td>
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
<a href="#" data-value="<?php echo $_SERVER['REQUEST_URI']; ?>" class="export-excel" style="margin-left:10px;">Xuất excel</a>
<iframe id="ifm-export-excel" src="" style="display:none; width:100%; "></iframe>
<script type="text/javascript">
	jQuery(function($){
		$('.export-excel').on('click', function(){
			$('#ifm-export-excel').attr('src', 'include/export.php' + $(this).data('value') + "&search=search");
			return false;
		})
	});
</script>