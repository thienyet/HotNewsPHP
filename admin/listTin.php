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
	  			<h2>Danh Sách Tin</h2>
	    	<table id="table_list"width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
			  	<tr>
			    	<th>Mã Tin</th>
			    	<th>Ngày Đăng</th>
			    	<th>Tin</th>
			    	<th>Thể Loại - Loại Tin</th>
			    	<th>Số lần xem</th>
			    	<th><a href="themTin.php">Thêm</a></th>
			  	</tr>
			  	<?php  
			  		$tin = DanhSachTin();
			  		while($row_tin = mysqli_fetch_array($tin)) {
			  			ob_start();
			  	?>
	  			<tr>
			    	<td>{idTin}</td>
			    	<td>{Ngay}</td>
			    	<td style="width: 40%;"><a href="suatin.php?idTin={idTin}">{TieuDe}</a><br/>
						<img style="float: left;margin-right: 5px;" src="{urlHinh}" alt="" width="152" height="96" />{TomTat}
			    	</td>
			    	<td>{TenTL} - {Ten}</td>
			    	<td>{SoLanXem}</td>
			    	<td>
			    		<a href="suatin.php?idTin={idTin}">Sửa</a>
			    		<a onclick="return confirm('Bạn có chắc muốn xóa không?')" href="xoaTin.php?idTin={idTin}">Xóa</a>
			    	</td>
			  	</tr>
			  	<?php  
			  			$s = ob_get_clean();
			  			$s = str_replace("{idTin}", $row_tin["idTin"], $s);
			  			$s = str_replace("{Ngay}", $row_tin["Ngay"], $s);
			  			$s = str_replace("{TieuDe}", $row_tin["TieuDe"], $s);
			  			$s = str_replace("{TomTat}", $row_tin["TomTat"], $s);
			  			$s = str_replace("{urlHinh}", $row_tin["urlHinh"], $s);
			  			$s = str_replace("{TenTL}", $row_tin["TenTL"], $s);
			  			$s = str_replace("{Ten}", $row_tin["Ten"], $s);
			  			$s = str_replace("{SoLanXem}", $row_tin["SoLanXem"], $s);
			  			echo $s;
			  		}
			  	?>
			</table>
			</td>
	  	</tr>
	</table>
</body>
</html>