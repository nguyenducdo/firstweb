<?php  
if(isset($_POST['btnThayDoi'])){
		$flag = true;
		$row_user = ChiTietUser($connect,$idUser);
		$Password = "";
		$HoTen = "";
		$Email = "";
		$urlHinh = $_FILES['upload']['name'];
		if(!isset($_POST['matkhaucu']) && !isset($_POST['matkhaumoi']) && !isset($_POST['matkhaumoi2'])){}
		else if($_POST['matkhaucu'] == "" && $_POST['matkhaumoi'] == "" && $_POST['matkhaumoi2'] == ""){}
		else{
			if($_POST['matkhaucu'] == "" || $_POST['matkhaumoi'] == "" || $_POST['matkhaumoi2'] == ""){
				$_SESSION['error'] = "Hãy điền đầy đủ thông tin";
				$flag = false;
			}
			else if (md5($_POST['matkhaucu'])!=$row_user['Password']) {
				$_SESSION['error'] = "Mật khẩu cũ không đúng";
				$flag = false;
			}
			else if($_POST['matkhaumoi'] != $_POST['matkhaumoi2']){
				$_SESSION['error'] = "Nhập lại mật khẩu không đúng";
				$flag = false;
			}
			else{
				$Password = $_POST['matkhaumoi'];
			}
		}
		if($_POST['HoTen'] == "" || $_POST['Email'] == ""){
			$_SESSION['error'] = "Hãy điền đầy đủ thông tin";
				$flag = false;
		}
		else{
			$HoTen = $_POST['HoTen'];
			$Email = $_POST['Email'];
		}

		if(!$flag) header("location:index.php?select=suathongtin");
		else{
			if($Password != ""){
				$setpass = "Password = MD5('$Password'),";
			}
			else $setpass = "";
			if($urlHinh != ""){
				$row_user = ChiTietUser($connect,$_SESSION['idUser']);
				if($row_user['urlHinh']!='000defaulurlHinh.jpg') unlink('../upload/user/'.$row_user['urlHinh']);
				move_uploaded_file($_FILES['upload']['tmp_name'], '../upload/user/'.$urlHinh);
				$path = '../upload/user/'.$urlHinh;
				$info = pathinfo($path);
				$newname = rand_string(10).'.'.$info['extension'];
				rename($path, '../upload/user/'.$newname);
				$urlHinh = $newname;
				$seturl = "urlHinh = '$urlHinh',";
			}
			else $seturl = "";
			$qr = "
				UPDATE users SET
				$seturl
				HoTen = '$HoTen',
				$setpass
				Email = '$Email'
				WHERE idUser = $idUser;
			";
			mysqli_query($connect,$qr);
			$_SESSION['error'] = "";
		}

		
	}
?>

