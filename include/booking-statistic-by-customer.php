<?php 
	// thoi gian trong ngay
	$startTime	= strtotime(date('d.m.Y'));
	$endTime	= time();
	$qr = "SELECT u.`makhachhang`, u.`ten`, u.`dienthoai`, u.`email`, COUNT(t.`id`) AS sum
			FROM khachhang AS u
			LEFT JOIN khachhang_thuenha AS khtn
			ON u.makhachhang = khtn.makhachhang
			INNER JOIN thuenha AS t
			ON khtn.`id` = t.`id`
			WHERE t.`ngaythangnam` >= '{$startTime}' AND t.`ngaythangnam` <= '{$endTime}'"
	;

	switch ($act) {
		case 'cus-statistic': // Dau vao
			$actCur = 'cus-onsite';
			break;

		case 'cus-thamdinh': // Tham dinh
			$qr .= " AND (ketquadauvao IS NOT NULL OR ketquadauvao <> '')";
			$actCur = 'cus-onsite-thamdinh';
			break;

		case 'cus-damphan': // Dam phan
			$actCur = 'cus-onsite-damphan';
			break;
		
		default:
			# code...
			break;
	}

	$qr .= " GROUP BY u.`makhachhang`";

	$results = mysql_query($qr);

	$gioHienTai = date('h:i', $endTime);
	$ngayHienTai = date('d/m/Y', $endTime);
	$content = "<h4>Tổng cộng: <span class='label label-danger'>__diachi__</span> địa chỉ, được <span class='label label-danger'>__daily__</span> khách hàng gửi vào hệ thống đến {$gioHienTai} - $ngayHienTai</h4>";
	$content .= '<table class="table table-bordered"><thead><tr><th>Tên khách hàng</th><th>Email</th><th>Đã book</th></tr></thead><tbody>';

	$countDiachi = $countDaily = 0;
	while ($row = mysql_fetch_assoc($results)) {
		$countDiachi += $row['sum'];
		$countDaily++;
		$content .= "<tr><td>{$row['ten']}</td><td>{$row['email']}</td><td><a href='index.php?act={$actCur}&makhachhang={$row['makhachhang']}'>Xem chi tiết <span class='badge'>{$row['sum']}</span></a></td></tr>";
	}

	$content .= '</tbody></table>';

	echo str_replace(array('__diachi__', '__daily__'), array($countDiachi, $countDaily), $content);
?>
<a href="index.php?act=cus-report&username=" class="search" style="margin-left:10px;">TÌM KIẾM</a>