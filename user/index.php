<?php  
	require "../lib/function.php";
	require "../lib/function_user.php";
	require "../lib/connect.php";

?>
<?php  
	ob_start();
	session_start();
	if(!isset($_SESSION['idUser']) && !isset($_GET['id'])){
		header("location:../index.php");
	}

	$idUser = 0;
	$idOtherUser = 0;

	if(isset($_SESSION['idUser'])){
		$idUser = (int)$_SESSION['idUser'];
	}

	if (isset($_GET['id'])) {
		$idOtherUser = (int)$_GET['id'];
	}
	$_SESSION['loidangnhap'] = "";
?>

<?php  
	if(isset($_POST['btnLogin'])){
        $un = $_POST['txtUn'];
        $pass = md5($_POST['txtPa']);
        $qr = "
            SELECT * FROM Users
            WHERE Username = '$un'
            AND Password = '$pass'
        ";
        $user = mysqli_query($connect,$qr);
        if(mysqli_num_rows($user)==1){
            //dang nhap dung
            $row = mysqli_fetch_array($user);
            $_SESSION['idUser'] = $row['idUser'];
            $_SESSION['Username'] = $row['Username'];
            $_SESSION['HoTen'] = $row['HoTen'];
            $_SESSION['idGroup'] = $row['idGroup'];
            $idUser = (int)$_SESSION['idUser'];
			$_SESSION['error'] = "";
        }
        else{
        	$_SESSION['loidangnhap'] = "Tài khoản hoặc mật khẩu không đúng";
        }
    }
?>

<?php  
    //Thoat
    if(isset($_POST['btnThoat'])){
        unset($_SESSION['idUser']);
        unset($_SESSION['Username']);
        unset($_SESSION['HoTen']);
        unset($_SESSION['idGroup']);
        header('location:../');
    }
?>

<?php  
	require "self/thaydoithongtin.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP&MySQL</title>
	<link rel="stylesheet" type="text/css" href="layout.css" />
	<script type="text/javascript" src="../jquery-slider-master/js/jquery-2.1.0.min.js"></script>
	<script>
		$(document).ready(function(){
			$("#thaydoi").click(function(){
				$.get("self/formpass.php",function(data){
					$("#hiddenpass").html(data);
				});
			});
		});
		$(document).ready(function(){
			$("#thaydoi").click(function(){
				$.get("self/null.php",function(data){
					$("#button").html(data);
				});
			});
		});
	</script>
</head>
<body>
	<div id="container">
		<div id="header">
			<a href="http://localhost/cc.vn"><h1>TRANG CHỦ</h1></a>
			<div id="login">
				<?php
					if (!isset($_SESSION['idUser'])) {
						require "../blocks/formlogin.php"; 
					} 
					else{
						$anhdaidien = "../upload/user/";
						require "../blocks/forminfo.php";
					}
				?>
			</div>
		</div>
		<div id="content">
			<?php  
				if($idUser == $idOtherUser || $idOtherUser == 0){
					require "self.php";
				}
				else if($idUser != $idOtherUser || $idUser == 0){
					require "otheruser.php";
				}
			?>
		</div>
	</div>
</body>
</html>