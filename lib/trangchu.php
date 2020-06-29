<?php 
	function TinMoiNhat_MotTin() {
    $conn = myConnect();
    $qr = "
            select * 
            from tin
            order by idTin desc
            limit 0,1
    ";
	$result = mysqli_query($conn, $qr);

    return $result;
	}

	function TinMoiNhat_BonTin() {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            order by idTin desc
	            limit 1,6
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TinXemNhieuNhat() {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            order by SoLanXem desc
	            limit 1,4
	    ";
	    
		$result = mysqli_query($conn, $qr);

    	return $result;
	}

		function TinMoiNhat_TheoLoaiTin_MotTin($idLT) {
    $conn = myConnect();
    $qr = "
            select * 
            from tin
            where idLT = $idLT
            order by idTin desc
            limit 0,1
    ";
	$result = mysqli_query($conn, $qr);

    return $result;
	}

	function TinMoiNhat_TheoLoaiTin_BonTin($idLT) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idLT = $idLT
	            order by idTin desc
	            limit 1,4
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TenLoaiTin($idLT) {
		$conn = myConnect();
		$qr = "
	            select Ten 
	            from loaitin
	            where idLT = $idLT
	    ";
	    
		$result = mysqli_query($conn, $qr);
		$row = mysqli_fetch_array($result);

	    return $row['Ten'];
	}

	function QuangCao($vitri) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from quangcao
	            where vitri = $vitri

	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function DanhSachTheLoai() {
		$conn = myConnect();
		$qr = "
	            select * 
	            from theloai
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function DanhSachLoaiTin_Theo_TheLoai($idTL) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from loaitin
	            where idTL = $idTL
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TinMoi_BenTrai($idTL) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idTL = $idTL
	            order by idTin desc
	            limit 0, 1
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TinMoi_BenPhai($idTL) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idTL = $idTL
	            order by idTin desc
	            limit 1, 2
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TinTheoLoaiTin($idLT) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idLT = $idLT
	            order by idTin desc
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function breadCrumb($idLT) {
		$conn = myConnect();
		$qr = "
	            select TenTL, Ten
	            from theloai, loaitin
	            where theloai.idTL = loaitin.idTL
	            and idLT = $idLT
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TinTheoLoaiTin_PhanTrang($idLT, $from, $sotin1trang) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idLT = $idLT
	            order by idTin desc
	            limit $from, $sotin1trang
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function ChiTietTin($idTin) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idTin = $idTin
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TinCungLoaiTin($idTin, $idLT) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idTin <> $idTin
	            and idLT = $idLT
	            order by rand()
	            limit 0, 3
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function CapNhatSoLanXemTin($idTin) {
		$conn = myConnect();
		$qr = "
	            update tin
	            set SoLanXem = SoLanXem + 1
	            where idTin = $idTin
	    ";
	    
		mysqli_query($conn, $qr);
	}

	function TimKiem($tukhoa) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where TieuDe regexp '$tukhoa'
	            order by idTin desc

	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	//Hàm login sau khi mạng xã hội trả dữ liệu về
	function loginFromSocialCallBack($socialUser) {
	    $conn = myConnect();
	    $result = mysqli_query($con, "Select `idUser`,`Username`,`Email`,`HoTen` from `users` WHERE `email` ='" . $socialUser['email'] . "'");
	    if ($result->num_rows == 0) {
	        $result = mysqli_query($con, "INSERT INTO `users` (`HoTen`,`Email`, `idGroup`) VALUES ('" . $socialUser['name'] . "', '" . $socialUser['email'] . "', 0 ');");
	        if (!$result) {
	            echo mysqli_error($con);
	            exit;
	        }
	        $result = mysqli_query($con, "Select `idUser`,`Username`,`Email`,`HoTen` from `users` WHERE `email` ='" . $socialUser['email'] . "'");
	    }
	    if ($result->num_rows > 0) {
	        $user = mysqli_fetch_assoc($result);
	        if (session_status() == PHP_SESSION_NONE) {
	            session_start();
	        }
	        $_SESSION['current_user'] = $user;
	        header('Location: ./index.php');
	    }
	}
?>