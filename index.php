<?php  
	require "lib/connect.php";
	require "lib/function.php";
?>

<?php  
	session_start();
	$page = "";
	if(isset($_GET['page'])){
		$page = $_GET['page'];
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
            $_SESSION['loidangnhap'] = "";
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
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP&MySQL</title>
	<link rel="stylesheet" type="text/css" href="css/layout.css" />
	<script type="text/javascript" src="jquery-slider-master/js/jquery-2.1.0.min.js"></script>
		<!-- $(document).ready(function(){
			$("#btnlike").click(function(){
				alert(1);
				var idT = $_GET['idTin'];
				var idU = $_SESSION['idUser'];
				$.get("blocks/test.php",{idTin=idT,idU=idU},function(data){
					$("#like-dislike").html(data);
				});
			});
		});

		$(document).ready(function(){
			$("#thaydoi").click(function(){
				$.get("self/null.php",function(data){
					$("#button").html(data);
				});
			});
		}); -->
		
</head>
<body>
	<div id="container">
		<div id="header">
			<a href="./"><h1>TRANG CHỦ</h1></a>
			<div id="login">
				<?php
					if (!isset($_SESSION['idUser'])) {
						require "blocks/formlogin.php"; 
					} 
					else{
						$anhdaidien = "upload/user/";
						require "blocks/forminfo.php";
					}
				?>
			</div>
		</div>
		<div id="menu-header">
			<?php require "blocks/menu.php" ?>
		</div>
		<div id="content">
			<?php 
				switch ($page) {
					case 'tin':
						require "pages/tin.php";
						break;
					case 'theloai':
						require "pages/theloai.php";
						break;
					case 'timkiem':
						require "pages/timkiem.php";
						break;
					default:
						require "pages/trangchu.php";
						break;
				}
			?>
		</div>
	</div>
</body>
</html>