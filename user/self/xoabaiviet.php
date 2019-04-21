<?php  
	session_start();
	if(!isset($_SESSION['idUser'])){
		header("location:../../index.php");
	}

	$idUser = $_SESSION['idUser'];

	require "../../lib/function.php";
	require "../../lib/function_user.php";
	require "../../lib/connect.php";

?>

<?php  
	$idTin = (int)$_GET['idTin'];
	$qr = "
		DELETE FROM tin
		WHERE idTin = $idTin
		AND idUser = $idUser
	";
	mysqli_query($connect, $qr);
	header('location:../index.php?select=baiviet');
?>