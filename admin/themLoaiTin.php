<?php  
	ob_start();
	session_start();
	if( !isset($_SESSION["idUser"]) && $_SESSION["idGroup"]!=1) {
		header("location:../index.php");
	}

	require "../lib/dbConn.php";
	require "../lib/quantri.php";
?>

<?php  
	if(isset($_POST["btn_Them"])) {
		$Ten = $_POST["ten"];
		$Ten_KhongDau = changeTitle($Ten);
		$ThuTu = $_POST["thutu"];
		settype($ThuTu, "int");
		$AnHien= $_POST["anhien"];
		settype($AnHien, "int");
		$idTL= $_POST["idTL"];
		settype($idTL, "int");

		$conn = myConnect();
		$qr = "insert into loaitin values(null, '$Ten', '$Ten_KhongDau', '$ThuTu', '$AnHien', '$idTL')  ";
		mysqli_query($conn, $qr);
		header("location:listLoaiTin.php");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="layout.css" />
	<style>
		h3 {
			text-align: center;
		}
		#table_them {
			margin-top: 20px
		}
		#table_them tr, #table_them td {
			padding: 8px;
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
	    		<h3>Thêm Loai Tin</h3>
	    		<form method="POST" action="">
                    
                    <table id="table_them" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>Tên</td>
                            <td><input type="text" name="ten" maxlength="80"></td>
                        </tr>
                        <tr>
                            <td>Thứ tự</td>
                            <td><input type="text" name="thutu" maxlength="80"></td>
                        </tr>
                        <tr>
                            <td>Ẩn hiện</td>
                            <td>
                            	<input type="radio" id="hien" name="anhien" value="1">
							  	<label for="hien">Hiện</label><br>
							  	<input type="radio" id="an" name="anhien" value="0">
							  	<label for="an">Ẩn</label><br>
                            </td>
                        </tr>
                        <tr>
                            <td>Thể loại</td>
                            <td>
                            	<label for="idTL"></label>
                            	<select name="idTL" id="idTL">
                            		<?php 
                            			$theloai = DanhSachTheLoai();
                            			while($row_theloai = mysqli_fetch_array($theloai)) {
                            		?>
                            		<option value="<?php echo $row_theloai["idTL"] ?>"><?php echo $row_theloai["TenTL"] ?></option>
                            		<?php  
                            			}
                            		?>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"> <input type="submit" name="btn_Them" value="Thêm"></td>
                        </tr>
                    </table>         
                </form>
	    	</td>
	  	</tr>
	</table>
</body>
</html>