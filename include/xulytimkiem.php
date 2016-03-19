<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <title>Khách hàng</title>
 
    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
 
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
 
  <body>
 <?php
	//Gọi file connection.php ở bài trước
	require_once("../connect/connect.php");
	?>
	
    <div class="container">
      <div class="row">
        <h3 align="center"> Khách hàng</h3>
        <table class="table">
          <caption>Thông tin của khách</caption>
          <thead>
            <tr>
              <th>STT</th>
              <th>Bạn là</th>
              <th>Di động</th>
              <th>Tên của bạn</th>
         
			  <th>Thẩm định</th>
			  
            </tr>
          </thead>
          <tbody>
            <?php
            $stt = 1 ;
			
			$didong=$_REQUEST["didong"];
            $sql = "SELECT * FROM thuenha where didong like'%$didong%'";
            // thực thi câu $sql với biến conn lấy từ file connection.php
            $query = mysql_query($sql);
            while ($data = mysql_fetch_array($query)) {
          ?>
            <tr>
              <th scope="row"><?php echo $stt++ ?></th>
              <td><?php echo $data["banla"]; ?></td>
              <td><?php echo $data["didong"]; ?></td>
              <td><?php echo $data["tencuaban"]; ?></td>
			<td><a href="khachhangdat.php?id=<?php echo $data["id"]; ?>">Đạt /</a> <a href="xoathanhvien.php?id=<?php echo $data["id"]; ?>">Không đạt</a></td>
			
             	
              
            </tr>
          <?php
            }
          ?>
          </tbody>
        </table>
      </div>
 
    </div><!-- /.container -->
 
 
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>