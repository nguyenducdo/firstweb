<?php  
	$row_user = ChiTietUser($connect, $idOtherUser);
	$idTL = 0;
	if(isset($_GET['idTL'])){
		$idTL = (int)$_GET['idTL'];
	}
	$tin_user = DanhSachTin_TheoUser($connect, $idOtherUser);

?>
<div class="other">
	<hr width="80%" style="margin:auto">
	<div id="thongtinchung">
		<img src="<?php echo '../upload/user/'.$row_user['urlHinh']; ?>">
		<div class="p">
			<p id="ten"><?php echo $row_user['HoTen'] ?></p>
			<p style="font-size: 19px;">ID: <?php echo $row_user['idUser']; ?></p>
			<p id="sobaiviet">Số bài viết đã đăng: <?php echo mysqli_num_rows($tin_user); ?></p>
		</div>
		<div class="theodoi">
			<a href="">Theo dõi</a>
			<a href="">Facebook</a>
		</div>
	</div>
	<div id="menu">
			<?php 
				//require "otheruser-menu.php" 
			?>
	</div>
	<div class="danhsach">
		<?php  
			//require "otheruser-theloai.php";
		?>
	</div>
</div>