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

	if(isset($_POST['themnha']))
	{
		$banla=$didong=$ngaythangnam=$tencuaban=$gioithieu=$duongpho=$sonha=$tinh=$quan=$phuong=$duong=$giachothue=$ttgt=$dttt=$tttt=$vitri=$ghichu=$anhbenngoai=$anhbentrong="";
		
		$ngaythangnam=$_POST['ngaythangnam'];
		
		$tinh=$_POST['city'];
		$quan=$_POST['district'];
		$phuong=$_POST['town'];
		$duong=$_POST['street'];
		

 	}
 
	if( isset( $_POST['ngaythangnam'])&&isset( $_POST['city'])&& isset( $_POST['district'])&& isset( $_POST['town'])&& isset( $_POST['street'])  )
	{
  
		$sql=mysql_query("select * from thuenha where ngaythangnam='".$ngaythangnam."'&& tinhthanhpho='".$tinh."'&& quanhuyen='".$quan."' && phuongxa='".$phuong."' && duong='".$duong."'");
		$num_row=mysql_num_rows($sql); 
		
		
		if($num_row == 0 )
		{
			echo "<p>Không tìm thấy kết quả </p>";
		}
		else{
			echo "<p>Kết quả tìm kiếm: có {$num_row} kết quả.</p>";
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
				echo "<tr>
						<td>{$idx}</td>
						
						<td>{$row["ngaythangnam"]}</td>
						<td>***</td>
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
		/*{
      // Xu ly upload
      $target_dir = "uploads/";
      if ($_FILES["anhbenngoai"]["name"] != ''){
        $anhbenngoai = $target_dir . basename($_FILES["anhbenngoai"]["name"]);
        $anhbenngoaiFileType = pathinfo($anhbenngoai,PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["anhbenngoai"]["tmp_name"], $anhbenngoai);
      }
      if ($_FILES["anhbentrong"]["name"] != ''){
        $anhbentrong = $target_dir . basename($_FILES["anhbentrong"]["name"]);
        $anhbentrongFileType = pathinfo($anhbentrong,PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["anhbentrong"]["tmp_name"], $anhbentrong);
      }*/

			/*$sql2="insert into thuenha(banla,didong,tencuaban,gioithieu,duongpho,sonha,tinhthanhpho,quanhuyen,phuongxa,duong,giachothue,thoathuangiathue,dientichtangtret,tinhtrangtangtret,vitri,ghichu,anhbenngoai,anhbentrong,ngaythangnam,giophutgiay) values('".$banla."','".$didong."','".$tencuaban."','".$gioithieu."','".$duongpho."','".$sonha."','".$tinh."','".$quan."','".$phuong."','".$duong."','".$giachothue."','".$ttgt."','".$dttt."','".$tttt."','".$vitri."','".$ghichu."','".$anhbenngoai."','".$anhbentrong."','".$ngaythangnam."','".$giophutgiay."')";  
			$query2=mysql_query($sql2);
			echo '<div class="alert alert-success" role="alert">Anh/Chị đã thêm thành công ! xin mời chọn tiếp.</div>' ;

		}*/
	

	 //Load city
	
?>