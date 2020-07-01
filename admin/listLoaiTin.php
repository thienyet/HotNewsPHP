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
	    		<h2>Danh Sách Loại Tin</h2>
	    	<table id="table_list"width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			  	<tr>
			    	<th>Mã Loại Tin</th>
			    	<th>Tên Loại Tin</th>
			    	<th>Tên Loại Tin Không Dấu</th>
			    	<th>Thứ Tự</th>
			    	<th>Thể Loại</th>
			    	<th><a href="themLoaiTin.php">Thêm</a></th>
			  	</tr>
			  	<?php  
			  		$loaitin = DanhSachLoaiTin();
			  		while($row_loaitin = mysqli_fetch_array($loaitin)) {
			  			ob_start();
			  	?>
	  			<tr>
			    	<td>{idLT}</td>
			    	<td>{Ten}</td>
			    	<td>{Ten_KhongDau}</td>
			    	<td>{ThuTu}</td>
			    	<td>{TenTL}</td>
			    	<td>
			    		<a href="suaLoaiTin.php?idLT={idLT}">Sửa</a>
			    		<a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="xoaLoaiTin.php?idLT={idLT}">Xóa</a>
			    	</td>
			  	</tr>
			  	<?php  
			  			$s = ob_get_clean();
			  			$s = str_replace("{idLT}", $row_loaitin["idLT"], $s);
			  			$s = str_replace("{Ten}", $row_loaitin["Ten"], $s);
			  			$s = str_replace("{Ten_KhongDau}", $row_loaitin["Ten_KhongDau"], $s);
			  			$s = str_replace("{ThuTu}", $row_loaitin["ThuTu"], $s);
			  			$s = str_replace("{TenTL}", $row_loaitin["TenTL"], $s);
			  			echo $s;
			  		}
			  	?>
			</table>
	    	</td>
	  	</tr>
	</table>
</body>
</html>