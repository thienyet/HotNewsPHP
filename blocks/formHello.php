<h4>Chào bạn 
<?php 
	if(!empty($_SESSION["HoTen"])) { echo $_SESSION["HoTen"];}
	else if(!empty($_SESSION['user_first_name'])) { echo $_SESSION['user_first_name'].' '.$_SESSION['user_last_name'];}
	// else if(!empty($_SESSION['user_name'])) { echo $_SESSION['user_name'];}
?>
	
</h4>
<form method="POST" action="">
	<input type="submit" name="btn_thoat" value="Đăng xuất"></td>
</form>
