<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
	require_once("../connect/connect.php");
	header("Content-type: application/octet-stream");
	header("Content-Disposition: attachment; filename=data-customer.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
 
	if( isset( $_REQUEST['search']) )
	{
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
		//
		$sql = mysql_query($sql);
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
						<th>STT</th>
						<th>Tên</th>
						<th>Điện thoại</th>
						<th>Email</th>
						<th>Địa chỉ</th>
						<th>MST</th>
						<th>Nhãn hiệu</th>
						<th>Ngày HT</th>
						<th>Danh mục</th>
					</tr>
				</thead>';
			echo '<tbody>';
			$idx = 0;
			while($row=mysql_fetch_array($sql)){
				$idx++;
				$ngayhoptac = ($row["ngayhoptac"]) ? date('d-m-Y', $row["ngayhoptac"]) : '';
				echo "<tr>
						<td>{$idx}</td>
						<td>{$row['ten']}</td>
						<td>{$row['dienthoai']}</td>
						<td>{$row['email']}</td>
						<td>{$row['diachi']}</td>
						<td>{$row['masothue']}</td>
						<td>{$row['nhanhieu']}</td>
						<td>{$ngayhoptac}</td>
						<td>{$row['danhmuc']}</td>
					</tr>";
			}
			echo '</tbody>';
			echo '</table>';
		}
	}
	
?>