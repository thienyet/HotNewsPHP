<?php 
	function TinMoiNhat_MotTin() {
    $conn = myConnect();
    $qr = "
            select * 
            from tin
            order by ngay desc
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
	            order by ngay desc
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
	            limit 1,6
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
		        order by ngay desc
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
	            order by ngay desc
	            limit 1,2
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

	function DanhSachTin_Theo_TheLoai($idTL) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idTL = $idTL
	    ";
	    
		$result = mysqli_query($conn, $qr);		
	    return mysqli_num_rows($result);
	}

	function TinMoi_BenTrai($idTL) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where idTL = $idTL
	            order by ngay desc
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
	            order by ngay desc
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
	            order by ngay desc
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
	            order by ngay desc
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
	            order by ngay desc

	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function TimKiem_PhanTrang($tukhoa, $from, $sotin1trang) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from tin
	            where TieuDe regexp '$tukhoa'
	            order by ngay desc
	            limit $from, $sotin1trang
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function DanhSachBinhLuan($idTin) {
		$conn = myConnect();
		$qr = "
	            select * 
	            from comment
	            where idTin = $idTin
	            order by id desc
	    ";
	    
		$result = mysqli_query($conn, $qr);

	    return $result;
	}
?>