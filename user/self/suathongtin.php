<div class="thongtintaikoan">
	<form action="index.php" method="post" enctype="multipart/form-data">
	<div>
		<p style="width: 450px" class="inline">Họ tên:&nbsp; <input type="text" name="HoTen" value="<?php echo $row_user['HoTen']; ?>"></p>
		<p style="" class="inline">ID User: <?php echo $row_user['idUser'];?></p>
	</div>
	<div>
		<p>Username: <?php echo $row_user['Username']; ?></p>
	</div>
	<div><span style="float: left; margin-right: 10px;">Password:</span> <span id="hiddenpass"><?php for($i=0;$i<10;$i++) echo '&#9679';?></span>
		<?php //require "formpass.php"; ?>
		<span id="button"><input type="button" id="thaydoi" value="Đổi mật khẩu"></span>
	</div>
	<div>
		<p style="width: 450px" class="inline">Email:&nbsp; <input type="text" name="Email" value="<?php echo $row_user['Email']; ?>"></p>
		<p style="" class="inline">Ngày đăng ký: 
			<?php
				$datePost = date_parse_from_format('Y-m-d',$row_user['NgayDangKy']);
					$tsPost = mktime($datePost['hour'],$datePost['minute'],$datePost['second'],$datePost['month'],$datePost['day'],$datePost['year']);
					echo date('d/m/Y',$tsPost);
			?>
		</p>

	</div>
	<div>
		<span style="margin-right: 10px;">Đổi ảnh đại diện: </span>
		<input type="file" name="upload">
	</div>
	<input type="submit" name="btnThayDoi" value="Thay đổi">
	<span style="margin-left: 30px; color: red; font-style: italic;"><?php echo $_SESSION['error']; ?></span>
	</form>
</div>