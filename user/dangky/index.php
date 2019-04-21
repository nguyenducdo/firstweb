  <?php
    require "function.php";
    require "../../lib/connect.php";
    $error = "";
    $username = "";
    $email = "";
    $matkhau = "";
    $matkhau2 = "";
    $HoTen = "";
    // echo '<pre>';
    // echo print_r($_POST);
    // echo '</pre>';
    if(isset($_POST['signup_submit'])){
      // Username
      $username = $_POST['username'];
      $email = $_POST['email'];
      $matkhau = $_POST['matkhau'];
      $matkhau2 = $_POST['matkhau2'];
      $HoTen = $_POST['HoTen'];
      if(trim($username)=="" || trim($email) == "" || trim($matkhau) == "" || trim($matkhau2) == "" || trim($HoTen) == ""){
        $error = "Hãy điền đầy đủ thông tin!";
      }
      else{
        //username
        if(!checkInput($username,'username')){
          if($error=="") $error = "Tài khoản không hợp lệ";
        }else{
          $qr = "
            SELECT * FROM users
            WHERE Username = '$username'
          ";
          $user = mysqli_query($connect,$qr);
          $row_user = mysqli_num_rows($user);
          if($row_user!=0){
            if($error=="") $error = "Tài khoản đã tồn tại";
          }
        }

        // Email
        if(!checkInput($email,'email')){
          if($error=="") $error = "Email không hợp lệ";
        }

        // matkhau
        if($matkhau != $matkhau2){
          if($error=="") $error = "Mật khẩu nhập lại không đúng";
        }
      }
      if($error==""){
        $qr = "
          INSERT INTO users (idUser,HoTen,Username,Password,Email,NgayDangKy,idGroup,tinlike,tindislike)
          VALUES(null,'$HoTen','$username',MD5('$matkhau'),'$email',CURDATE(),1,'','');
        ";
        mysqli_query($connect,$qr);
        header('location:../..');
      }
    }

  ?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div id="login-box">
  <div class="left">
    <h1>Sign up</h1>
    <form method="post" name="main_form">
      <input type="text" name="HoTen" placeholder="Họ tên" value="<?php echo $HoTen; ?>">
      <input type="text" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/>
      <input type="text" name="username" placeholder="Tài khoản" value="<?php echo $username; ?>"/>
      <input type="password" name="matkhau" placeholder="Mật khẩu" />
      <input type="password" name="matkhau2" placeholder="Nhập lại mật khẩu" />
      <p><?php echo $error; ?></p>
      <input type="submit" name="signup_submit" value="Đăng ký" />
    </form>
  </div>
  
  <div class="right">
    <span class="loginwith">Sign in with<br />social network</span>
    
    <button class="social-signin facebook">Log in with facebook</button>
    <button class="social-signin twitter">Log in with Twitter</button>
    <button class="social-signin google">Log in with Google+</button>
  </div>
  <div class="or">OR</div>
</div>
  
  

</body>

</html>
