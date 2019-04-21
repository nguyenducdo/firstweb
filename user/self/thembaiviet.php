<?php  
	// ob_start();
	session_start();
	if(!isset($_SESSION['idUser'])){
		header("location:../../index.php");
	}

	require "../../lib/function.php";
	require "../../lib/function_user.php";
	require "../../lib/connect.php";

	$idUser = 0;
	$idOtherUser = 0;

	if(isset($_SESSION['idUser'])){
		$idUser = (int)$_SESSION['idUser'];
	}

	if (isset($_GET['id'])) {
		$idOtherUser = (int)$_GET['id'];
	}
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
			$_SESSION['error'] = "";
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
        header('location:../../');
    }
?>

<?php  
	if(isset($_POST['btnDangBai'])){
		$TieuDe = $_POST['TieuDe'];
		$TomTat = $_POST['TomTat'];
		$Content = $_POST['Content'];
		$idTL = $_POST['idTL'];
		// if($_FILE['upload']['error'] > 0){
		// 	$TieuDe = 'Loi Hinh ANh CMNR';
		// }
		$urlHinh = $_FILES['upload']['name'];
		if($urlHinh != ""){
			move_uploaded_file($_FILES['upload']['tmp_name'], '../../upload/tintuc/'.$urlHinh);
			$path = '../../upload/tintuc/'.$urlHinh;
			$info = pathinfo($path);
			$newname = rand_string(10).'.'.$info['extension'];
			rename($path, '../../upload/tintuc/'.$newname);
			$urlHinh = $newname;
		}
		$qr = "
			INSERT INTO tin
			VALUES (null,'$TieuDe','$TomTat','$urlHinh',NOW(),'$idUser','$Content','$idTL',0,0,0);
		";
		mysqli_query($connect,$qr);
		header('location:../index.php?select=baiviet');
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>PHP&MySQL</title>
	<link rel="stylesheet" type="text/css" href="layout_them_sua/layout.css" />
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="ckfinder/ckfinder.js"></script>

</head>
<body>
	<div id="container">
		<div id="header">
			<a href="http://localhost/cc.vn"><h1>TRANG CHỦ</h1></a>
			<div id="login">
				<?php
					if (!isset($_SESSION['idUser'])) {
						require "../../blocks/formlogin.php"; 
					} 
					else{
						$anhdaidien = "../../upload/user/";
						require "../../blocks/forminfo.php";
					}
				?>
			</div>
		</div>
		<hr width="80%" style="margin:auto; margin-top: 60px;">
		<div id="them">
			<form method="post" enctype="multipart/form-data" id="form">
			<table border="0">
				<tr>
					<th colspan="2" style="font-size: 23px; padding-bottom: 30px;">THÊM BÀI VIẾT</th>
				</tr>
				<tr>
					<td style="width: 100px;">Tiêu đề: </td>
					<td><input type="text" name="TieuDe"></td>
				</tr>
				<tr>
					<td>Hình ảnh: </td>
					<td><input type="file" name="upload"></td>
				</tr>
				<tr>
					<td>Mô tả: </td>
					<td><textarea class="mota" name="TomTat"></textarea></td>
				</tr>
				<tr>
					<td>Nội dung: </td>
					<td>
						<textarea class="noidung" id="texteditor" name="Content"></textarea>
						<script>
							CKEDITOR.replace( 'texteditor',
								{
									filebrowserBrowseUrl : 'ckfinder/ckfinder.html',
									filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',
									filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',
									filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
									filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
									filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
								});
						</script>
					</td>
				</tr>
				<tr>
					<td>Thể loại: </td>
					<td>
						<select name="idTL">
							<?php  
								$theloai = DanhSachTheLoai($connect);
								while($row_theloai = mysqli_fetch_array($theloai)){
									echo '<option value="'.$row_theloai['idTL'].'">'.$row_theloai['TenTL'].'</option>';
								}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align: center"><input type="submit" name="btnDangBai" value="Đăng bài"></td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</body>
</html>