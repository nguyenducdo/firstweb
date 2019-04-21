<?php  
	function DanhSachTin_TheoUser($connect, $idUser){
		$qr = "
			SELECT * FROM tin
			WHERE idUser = $idUser
			ORDER BY idTin DESC
		";
		return mysqli_query($connect,$qr);
	}

	function DanhSachTheLoai_TheoUser($connect, $idUser){
		$qr = "
			SELECT DISTINCT theloai.*  FROM tin, theloai
			WHERE tin.idUser = $idUser
			AND tin.idTL = theloai.idTL
			ORDER BY idTL ASC
		";

		return mysqli_query($connect,$qr);
	}

	function DanhSach_Tin_User($connect, $sapxep,$batdau , $sotin){ //Bo sung tam
		$order = "";
		$limit = "LIMIT $batdau,$sotin";
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

	function checkEmail($email){
		$pattern = '#^\w[\w\.]*@[A-Za-z0-9]{2,}(\.[a-z0-9]{2,}){1,2}$#';
		$flag = false;
		if(preg_match($pattern, $email)){
			$flag = true;
		}
		return $flag;
	}
?>