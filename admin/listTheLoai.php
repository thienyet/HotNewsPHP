<?php  
	ob_start();
	session_start();
	if( !isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1) {
		header("location:../index.php");
	}

	require "../lib/dbConn.php";
	require "../lib/quantri.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="layout.css" />
	<style>
	#table_list {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	#table_list td,#table_list th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	#table_list tr:nth-child(even) {
	  background-color: #dddddd;
	}
	</style>
</head>
<body>
	<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
	  	<tr>
	    	<td id="hangTieuDe">Trang quản trị
				<div style="width: 200px; float: right;">
					<div>Chào bạn <?php echo $_SESSION["HoTen"]; ?></div>
				</div>
	    	</td>
	  	</tr>
	  	<tr>
	    	<td id="hang2"><?php require "menu.php"; ?></td>
	  	</tr>
	  	<tr>
	  		<td>
	  			<h2>Danh Sach The Loai</h2>
	    	<table id="table_list"width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			  	<tr>
			    	<th>idTL</th>
			    	<th>TenTL</th>
			    	<th>TenTL_KhongDau</th>
			    	<th>ThuTu</th>
			    	<th>AnHien</th>
			    	<th><a href="themTheLoai.php">Them</a></th>
			  	</tr>
			  	<?php  
			  		$theloai = DanhSachTheLoai();
			  		while($row_theloai = mysqli_fetch_array($theloai)) {
			  			ob_start();
			  	?>
	  			<tr>
			    	<td>{idTL}</td>
			    	<td>{TenTL}</td>
			    	<td>{TenTL_KhongDau}</td>
			    	<td>{ThuTu}</td>
			    	<td>{AnHien}</td>
			    	<td>
			    		<a href="suaTheLoai.php?idTL={idTL}">Sua</a>
			    		<a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="xoaTheLoai.php?idTL={idTL}">Xoa</a>
			    	</td>
			  	</tr>
			  	<?php  
			  			$s = ob_get_clean();
			  			$s = str_replace("{idTL}", $row_theloai["idTL"], $s);
			  			$s = str_replace("{TenTL}", $row_theloai["TenTL"], $s);
			  			$s = str_replace("{TenTL_KhongDau}", $row_theloai["TenTL_KhongDau"], $s);
			  			$s = str_replace("{ThuTu}", $row_theloai["ThuTu"], $s);
			  			$s = str_replace("{AnHien}", $row_theloai["AnHien"], $s);
			  			echo $s;
			  		}
			  	?>
			</table>
			</td>
	  	</tr>
	</table>
</body>
</html>