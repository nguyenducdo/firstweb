<?php  
	require "../lib/connect.php";
	require "../lib/function.php";
?>
<?php
	$idUser = (int)$_GET['idUser'];
	$idTin = (int)$_GET['idTin'];
	// echo $idTin;
	// echo $idUser;
	$strlike = '<input type="button" id="btnlike" value=';
	$row_user = ChiTietUser($connect,$idUser);
	$pos = strlen(strstr($row_user['tinlike'],trim($idTin)));
	if($pos > 0){ // Da tung like
		BoLike($connect, $idTin, $idUser);
		$row_tin = ChiTietTin($connect,$idTin);
		$strlike .= '"like" style="color: blue;"><label>'.$row_tin['luotlike'].'</label>';
	}
	else{ //Chua tung like
		$pos = strlen(strstr($row_user['tindislike'],trim($idTin)));
		if($pos > 0){ //Da tung dislike
			BoDisLike($connect, $idTin, $idUser);
		}
		ThemLike($connect, $idTin, $idUser);
		$row_tin = ChiTietTin($connect,$idTin);
		$strlike .= '"liked" style="color: red;"><label>'.$row_tin['luotlike'].'</label>';
	}	
		
	$strdislike = '<input type="button" id="btndislike" value="dislike" style="color: blue;"><label>'.$row_tin['luotdislike'].'</label>';
	echo $strlike . $strdislike;
?>