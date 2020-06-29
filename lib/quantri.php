<?php
	//quan ly the loai
	function DanhSachTheLoai() {
		$conn = myConnect();
	    $qr = "
	            select * from theloai
	            order by idTL desc
	    ";
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function ChiTietTheLoai($idTL) {
		$conn = myConnect();
	    $qr = "
	            select * from theloai
	            where idTL = $idTL
	    ";
		$result = mysqli_query($conn, $qr);

	    return mysqli_fetch_array($result);
	}

	//quan ly loai tin
	function DanhSachLoaiTin() {
		$conn = myConnect();
	    $qr = "
	            select * from loaitin, theloai
	            where theloai.idTL = loaitin.idTL
	            order by idLT desc
	    ";
		$result = mysqli_query($conn, $qr);

	    return $result;
	}

	function ChiTietLoaiTin($idLT) {
		$conn = myConnect();
	    $qr = "
	            select * from loaitin
	            where idLT = $idLT
	    ";
		$result = mysqli_query($conn, $qr);

	    return mysqli_fetch_array($result);
	}

	function stripUnicode($str) {
		if(!$str) return false;
		$unicode = array(
			'a' => 'à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ',
			'A' => 'À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ',
			'd' => 'đ',
			'D' => 'Đ',
			'e' => 'è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ',
			'E' => 'È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ',
			'i' => 'ì|í|ị|ỉ|ĩ',
			'I' => 'Ì|Í|Ị|Ỉ|Ĩ',
			'o' => 'ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ',
			'O' => 'Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ',
			'u' => 'ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ',
			'U' => 'Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ',
			'y' => 'ỳ|ý|ỵ|ỷ|ỹ',
			'Y' => 'Ỳ|Ý|Ỵ|Ỷ|Ỹ'
		);
		foreach ($unicode as $khongdau => $codau) {
			$arr = explode("|", $codau);
			$str = str_replace($arr, $khongdau, $str);
		}
		return $str;
	}

	function changeTitle($str) {
		$str = trim($str);
		if($str == "") return "";
		$str = str_replace('"', '', $str);
		$str = str_replace("'", '', $str);
		$str = stripUnicode($str);
		$str = mb_convert_case($str, MB_CASE_TITLE, 'utf-8');
		$str = str_replace(' ', '-', $str);
		return $str;
	}

?>