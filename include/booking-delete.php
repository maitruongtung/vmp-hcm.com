<?php
	$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
	if ($id){
		try{
			$qb = mysql_query("DELETE FROM thuenha WHERE id={$id}");
			echo '<div class="alert alert-success" role="alert">Xóa dữ liệu thành công!</div>';
			echo '<a href="javascript:window.history.back()"><button type="button" class="btn btn-primary">Quay về trang trước</button></a>';
		}catch(Exception $e){
			echo '<div class="alert alert-danger" role="alert">Xóa dữ liệu không thành công. '.$e->getMessage().'</div>';
		}
		
	}else{
		echo '<div class="alert alert-danger" role="alert">Không tìm thấy dữ liệu!</div>';
	}
?>