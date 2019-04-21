<?php  
	require "../lib/connect.php";
	require "../lib/function.php";
?>
<?php
	$idUser = (int)$_GET['idUser'];
	$idTin = (int)$_GET['idTin'];
	// echo $idTin;
	// echo $idUser;
	$strdislike = '<input type="button" id="btndislike" value=';
	$row_user = ChiTietUser($connect,$idUser);
	$pos = strlen(strstr($row_user['tindislike'],trim($idTin)));;
	if($pos > 0){ // Da tung dislike
		BoDisLike($connect, $idTin, $idUser);
		$row_tin = ChiTietTin($connect,$idTin);
		$strdislike .= '"dislike" style="color: blue;"><label>'.$row_tin['luotdislike'].'</label>';
	}
	else{ //Chua tung dislike
		$pos = strlen(strstr($row_user['tinlike'],trim($idTin)));;
		if($pos > 0){ //Da tung like
			BoLike($connect, $idTin, $idUser);
		}
		ThemDisLike($connect, $idTin, $idUser);
		$row_tin = ChiTietTin($connect,$idTin);
		$strdislike .= '"disliked" style="color: red;"><label>'.$row_tin['luotdislike'].'</label>';
	}	
		
	$strlike = '<input type="button" id="btnlike" value="like" style="color: blue;"><label>'.$row_tin['luotlike'].'</label>';
	echo $strlike . $strdislike;
?>