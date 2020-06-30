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
	$idLT = $_GET["idLT"];
	settype($idLT, "int");
	$qr = "delete from loaitin where idLT='$idLT'";
	$conn = myConnect();
	mysqli_query($conn, $qr);
	header("location:listLoaiTin.php");
?>