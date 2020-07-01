<h4>Chào bạn 
<?php 
	if(!empty($_SESSION["HoTen"])) { echo $_SESSION["HoTen"];}
	else if(!empty($_SESSION['user_first_name'])) { echo $_SESSION['user_first_name'].' '.$_SESSION['user_last_name'];}
	else if(!empty($_SESSION['user_name'])) { echo $_SESSION['user_name'];}
	
	if(isset($_POST['btn_admin'])) {
		header("location:https://localhost/hotnews.vn/admin/");
	}
?>
	
</h4>
<form method="POST" action="">
	<input type="submit" name="btn_thoat" value="Đăng xuất" class="btn btn-primary">
	<?php  
	if(empty($_SESSION['user_first_name']) && !empty($_SESSION["HoTen"]) && $_SESSION["idGroup"]==1) {
	?>
		<a href=""><input type="submit" name="btn_admin" value="Quản trị" class="btn btn-success" style="width: 70px; color: ưhite;"></a>
	<?php } ?>
</form>


