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
	if(isset($_POST["btn_Sua"])) {
		$TieuDe = $_POST["TieuDe"];
		$TieuDe_KhongDau = changeTitle($TieuDe);
		$TomTat = $_POST["TomTat"];
		$urlHinh = $_POST["urlHinh"];
		$Ngay = $_POST["Ngay"];
		$idUser = $_SESSION["idUser"];
		$Content = $_POST["Content"];
		$idLT = $_POST["idLT"];
		settype($idLT, "int");
		$idTL = $_POST["idTL"];
		settype($idTL, "int");
		$SoLanXem = 0;
		$TinNoiBat = $_POST["tinnoibat"];
		settype($TinNoiBat, "int");
		$AnHien = $_POST["anhien"];
		settype($AnHien, "int");

		$conn = myConnect();

		$qr = "update tin set
			TieuDe = '$TieuDe', 
			TieuDe_KhongDau = '$TieuDe_KhongDau', 
			TomTat = '$TomTat', 
			urlHinh = '$urlHinh',
			Ngay = '$Ngay',
			idUser = '$idUser',
			Content = '$Content',
			idLT = '$idLT',
			idTL = '$idTL',
			SoLanXem = '$SoLanXem',
			AnHien = '$AnHien'
			where idTin = '$idTin'  ";
		mysqli_query($conn, $qr);
		header("location:listTin.php");
	}
?>

<?php  
	$idTin = $_GET["idTin"];
	settype($idTin, "int");
	$row_tin = ChiTietTin($idTin);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="layout.css" />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>
	<style>
		h3 {
			text-align: center;
		}
		#table_them {
			margin-top: 20px
		}
		#table_them tr td:first-child {
			width: 10%;
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
	    		<h3>Sửa Tin</h3>
	    		<form method="POST" action="">
                    
                    <table id="table_them" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td>Tiêu Đề</td>
                            <td><input value="<?php echo $row_tin["TieuDe"] ?>" type="text" name="TieuDe" maxlength="80"></td>
                        </tr>
                        <tr>
                            <td>Tóm Tắt</td>
                            <td><input value="<?php echo $row_tin["TomTat"] ?>" type="text" name="TomTat" maxlength="80"></td>
                        </tr>
                        <tr>
                            <td>Hình ảnh</td>
                            <td><input value="<?php echo $row_tin["urlHinh"] ?> type="text" name="urlHinh" maxlength="80"></td>
                        </tr>
                        <tr>
                            <td>Ngày</td>
                            <td><input value="<?php echo $row_tin["Ngay"] ?> type="text" name="Ngay" maxlength="80"></td>
                        </tr>
                        <tr>
                            <td>Nội dung</td>
                            <td><label for="Content"></label>
                            	<textarea value="<?php echo $row_tin["Content"] ?> name="Content" id="Content" cols="45" rows="45"></textarea>
                            	<script type="text/javascript">
								var editor = CKEDITOR.replace( 'Content',{
									uiColor : '#9AB8F3',
									language:'vi',
									skin:'v2',
									filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?Type=Images',
									filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?Type=Flash',
									filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
			 	
									toolbar:[
									['Source','-','Save','NewPage','Preview','-','Templates'],
									['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'],
									['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
									['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
									['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
									['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
									['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
									['Link','Unlink','Anchor'],
									['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],
									['Styles','Format','Font','FontSize'],
									['TextColor','BGColor'],
									['Maximize', 'ShowBlocks','-','About']
									]
								});		
								</script>
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
                            		<option <?php if($row_theloai["idTL"] == $row_tin["idTL"]) echo "selected = 'selected'" ?> value="<?php echo $row_theloai["idTL"] ?>"><?php echo $row_theloai["TenTL"] ?></option>
                            		<?php  
                            			}
                            		?>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td>Loại tin</td>
                            <td><label for="idLT"></label>
                            	<select name="idLT" id="idLT">
                            		<?php 
                            			$loaitin = DanhSachLoaiTin();
                            			while($row_loaitin = mysqli_fetch_array($loaitin)) {
                            		?>
                            		<option <?php if($row_loaitin["idLT"] == $row_tin["idLT"]) echo "selected = 'selected'" ?> value="<?php echo $row_loaitin["idLT"] ?>"><?php echo $row_loaitin["Ten"] ?></option>
                            		<?php  
                            			}
                            		?>
                            	</select></td>
                        </tr>
                        <tr>
                            <td>Tin nổi bật</td>
                            <td>
                            	<input <?php if($row_tin["TinNoiBat"] == 1) echo "checked='checked'"; ?> type="radio" id="noibat" name="tinnoibat" value="1">
							  	<label for="hien">Nổi bật</label><br>
							  	<input <?php if($row_tin["AnHien"] == 0) echo "checked='checked'"; ?> type="radio" id="binhthuong" name="tinnoibat" value="0">
							  	<label for="an">Bình thường</label><br>
							</td>
                        </tr>
                        <tr>
                            <td>Ẩn hiện</td>
                            <td>
                            	<input <?php if($row_tin["AnHien"] == 1) echo "checked='checked'"; ?> type="radio" id="hien" name="anhien" value="1">
							  	<label for="hien">Hiện</label><br>
							  	<input <?php if($row_tin["AnHien"] == 0) echo "checked='checked'"; ?> type="radio" id="an" name="anhien" value="0">
							  	<label for="an">Ẩn</label><br>
                            </td>
                        </tr>
                        
                        <tr>
                        	<td></td>
                            <td colspan="2"> <input type="submit" name="btn_Sua" value="Sửa"></td>
                        </tr>
                    </table>         
                </form>
	    	</td>
	  	</tr>
	</table>
</body>
</html>