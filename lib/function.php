<?php  

	function TomTat($str, $max_length){
		if(mb_strlen($str)>$max_length){
			$str = substr($str, 0, ($max_length - 3)) . '...';
		}
		return $str;
	}

	function CheckNoiDung($str){
		$pattern = '#<h[1-6].*</h[1-6]>#';
		return preg_replace($pattern,'', $str);
	}

	function rand_string( $length ) {
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str = "";
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		return $str;
	}

	function DanhSachTheLoai($connect){
		$qr = "
			SELECT * FROM theloai
		";
		return mysqli_query($connect,$qr);
	}

	function ChiTietTheLoai($connect, $idTL){
		$qr = "
			SELECT * FROM theloai
			WHERE idTL = $idTL;
		";

		$theloai = mysqli_query($connect,$qr);
		return mysqli_fetch_array($theloai);
	}

	function ChiTietTin($connect, $idTin){
		$qr = "
			SELECT * FROM tin
			WHERE idTin = $idTin;
		";

		$tin = mysqli_query($connect,$qr);
		return mysqli_fetch_array($tin);
	}

	function ChiTietUser($connect, $idUser){
		$qr = "
			SELECT * FROM users
			WHERE idUser = $idUser;
		";

		$user = mysqli_query($connect,$qr);
		return mysqli_fetch_array($user);
	}

	function DanhSach_Tin($connect, $sapxep, $sotin){
		$order = "";
		$limit = "LIMIT 0,$sotin";
		if($sotin==0) $limit = "";
		switch ($sapxep) {
			case 'moinhat':
				$order = "ORDER BY idTin DESC";
				break;
			case 'cunhat':
				$order = "ORDER BY idTin ASC";
				break;
			case 'xemnhieunhat':
				$order = "ORDER BY SoLanXem DESC";
				break;
			case 'tron':
				$order = "ORDER BY RAND()";
				break;
			default:
				$order = "";
				break;
		}
		$qr = "
			SELECT * FROM tin
			$order
			$limit
		";
		return mysqli_query($connect,$qr);
	}

	function DanhSach_Tin_TheoTheLoai($connect, $idTL, $sotin, $sapxep = 'moinhat'){
		$limit = "LIMIT 0," . $sotin;
		if($sotin==0) $limit = "";
		$order = "";
		switch ($sapxep) {
			case 'moinhat':
				$order = "ORDER BY idTin DESC";
				break;
			case 'cunhat':
				$order = "ORDER BY idTin ASC";
				break;
			case 'xemnhieunhat':
				$order = "ORDER BY SoLanXem DESC";
				break;
			case 'tron':
				$order = "ORDER BY RAND()";
				break;
			default:
				$order = "";
				break;
		}
		$qr = "
			SELECT * FROM tin
			WHERE idTL = $idTL
			$order
			$limit
		";
		return mysqli_query($connect,$qr);
	}

	function DanhSachTin_PhanTrang_TheoTheLoai($connect, $idTL, $from, $sotin1trang){
		$qr = "
			SELECT * FROM tin
			WHERE idTL = $idTL
			ORDER BY idTin DESC
			LIMIT $from, $sotin1trang
		";
		return mysqli_query($connect,$qr);
	}

	function DanhSachBinhLuan($connect, $idTin){
		$qr = "
			SELECT * FROM binhluan
			WHERE idTin = $idTin
			ORDER BY id DESC
		";
		return mysqli_query($connect,$qr);
	}

	function TimKiem($connect,$keyword, $idTL=0, $sapxep='moinhat'){
		if($idTL == 0 ) $theloai = "";
		else{
			$theloai = "AND idTL = $idTL";
		}
		$order = "";
		switch ($sapxep) {
			case 'moinhat':
				$order = "ORDER BY idTin DESC";
				break;
			case 'cunhat':
				$order = "ORDER BY idTin ASC";
				break;
			case 'xemnhieunhat':
				$order = "ORDER BY SoLanXem DESC";
				break;
			case 'tron':
				$order = "ORDER BY RAND()";
				break;
			default:
				$order = "";
				break;
		}
		$qr = "
			SELECT * FROM tin
			WHERE TieuDe REGEXP '$keyword'
			$theloai
			$order
		";
		return mysqli_query($connect,$qr);
	}

	function CapNhatSoLanXemTin($connect, $idTin){
		$qr = "
			UPDATE tin 
			SET SoLanXem = SoLanXem + 1
			WHERE idTin = $idTin
		";
		mysqli_query($connect,$qr);
	}

	function CapNhatSoLanLike($connect, $idTin, $tang = 'tang'){
		if($tang == 'tang') $capnhat = 'luotlike + 1';
		else $capnhat = 'luotlike - 1';
		$qr = "
			UPDATE tin 
			SET luotlike = $capnhat
			WHERE idTin = $idTin
		";
		mysqli_query($connect,$qr);
	}

	function CapNhatSoLanDisLike($connect, $idTin, $tang = 'tang'){
		if($tang == 'tang') $capnhat = 'luotdislike + 1';
		else $capnhat = 'luotdislike - 1';
		$qr = "
			UPDATE tin 
			SET luotdislike = $capnhat
			WHERE idTin = $idTin
		";
		mysqli_query($connect,$qr);
	}

	function BoLike($connect, $idTin, $idUser){
		$qr = "
			SELECT * FROM users
			WHERE idUser = $idUser
		";

		$like = mysqli_query($connect,$qr);
		$row_like = mysqli_fetch_array($like);
		$row_like = $row_like['tinlike'];
		// echo ' row_like: '.$row_like;
		$tinlike = str_replace(' '.$idTin,'',$row_like);
		// echo 'tin like: '.$tinlike;
		$qr = "
			UPDATE users SET
			tinlike = '$tinlike'
			WHERE idUser = $idUser
		";
		mysqli_query($connect,$qr);
		CapNhatSoLanLike($connect,$idTin,'giam');
	}

	function ThemLike($connect, $idTin, $idUser){
		$qr = "
			SELECT users.tinlike FROM users
			WHERE idUser = $idUser
		";

		$like = mysqli_query($connect,$qr);
		$row_like = mysqli_fetch_array($like);
		$row_like = $row_like['tinlike'];

		$tinlike = $row_like . ' ' . $idTin;
		$qr = "
			UPDATE users SET
			tinlike = '$tinlike'
			WHERE idUser = $idUser
		";
		mysqli_query($connect,$qr);
		CapNhatSoLanLike($connect,$idTin,'tang');
	}

	function BoDisLike($connect, $idTin, $idUser){
		$qr = "
			SELECT * FROM users
			WHERE idUser = $idUser
		";

		$dislike = mysqli_query($connect,$qr);
		$row_dislike = mysqli_fetch_array($dislike);
		$row_dislike = $row_dislike['tindislike'];

		$tindislike = str_replace(' '.$idTin,'',$row_dislike);
		$qr = "
			UPDATE users SET
			tindislike = '$tindislike'
			WHERE idUser = $idUser
		";
		mysqli_query($connect,$qr);
		CapNhatSoLanDisLike($connect,$idTin,'giam');
	}

	function ThemDisLike($connect, $idTin, $idUser){
		$qr = "
			SELECT users.tindislike FROM users
			WHERE idUser = $idUser
		";

		$dislike = mysqli_query($connect,$qr);
		$row_dislike = mysqli_fetch_array($dislike);
		$row_dislike = $row_dislike['tindislike'];

		$tindislike = $row_dislike . ' ' . $idTin;
		$qr = "
			UPDATE users SET
			tindislike = '$tindislike'
			WHERE idUser = $idUser
		";
		mysqli_query($connect,$qr);
		CapNhatSoLanDisLike($connect,$idTin,'tang');
	}

?>