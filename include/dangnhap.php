<?php
	// Kiểm tra nếu người dùng đã ân nút đăng nhập thì mới xử lý
	if (isset($_POST["btn_submit"])) {
		// lấy thông tin người dùng
		$username = $_POST["username"];
		$password = $_POST["password"];

		//làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
		//mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
		$username = strip_tags($username);
		$username = addslashes($username);
		$password = strip_tags($password);
		$password = addslashes($password);
		if ($username == "" || $password =="") {
			echo '<div class="alert alert-danger" role="alert">Username hoặc password bạn không được để trống!</div>';
		}else{
			$sql = "select * from users where username = '$username' and password = '$password' ";
			$query = mysql_query($sql);
			$num_rows = mysql_num_rows($query);
			if ($num_rows==0 ) {
				echo '<div class="alert alert-danger" role="alert">Tài khoản hoặc mật khẩu không đúng!</div>';
			}
			else{
				$account = mysql_fetch_object($query);
				//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
				$_SESSION['username'] = $account->username;
				$_SESSION['level'] = $account->level;
				header('Location: index.php');
                // Thực thi hành động sau khi lưu thông tin vào session
                // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                //header('Location: ../weblinks/dangky.php');
            }
		}
	}
?>
<form id="frm-login" class="form-horizontal" action="" method="post">
  <div class="form-group">
    <label for="username" class="col-sm-4 control-label">Username <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <input name="username" type="text" class="form-control" id="username" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <label for="password" class="col-sm-4 control-label">Password <font color="#FF0000">*</font></label>
    <div class="col-sm-8">
      <input name="password" type="password" class="form-control" id="password" placeholder="">
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-8">
      <button name="btn_submit" type="submit" class="btn btn-success btn_submit">Đăng nhập</button>
    </div>
  </div>
</form>


