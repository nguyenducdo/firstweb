<div class="trangchinh">
	<a href="index.php?keyword=&page=timkiem&idTL=0&sapxep=moinhat" style="display: inline-block; color: black;"><h3 style="font-size: 21px; margin-bottom: 10px;">Bài đăng mới nhất</h3></a>
	<?php require "blocks/formtimkiem.php" ?>
	<hr>
	<?php  
		$tin = DanhSach_Tin($connect, 'moinhat',6);
		while($row_tin = mysqli_fetch_array($tin)){
			$row_user = ChiTietUser($connect, $row_tin['idUser']);
	?>
	<div class="baidang">
		<img src="upload/tintuc/<?php echo $row_tin['urlHinh']; ?>" class="anh">
		<div class="noidungbaiviet">
			<a href="index.php?page=tin&idTin=<?php echo $row_tin['idTin']; ?>" class="tieude"><h3><?php echo $row_tin['TieuDe']; ?></h3></a>
			<br>
			<a href="index.php?page=theloai&idTL=<?php echo $row_tin['idTL']; ?>" class="theloai">/<?php 
					$row_theloai = ChiTietTheLoai($connect, $row_tin['idTL']);
					echo $row_theloai['TenTL'];
				?>
			</a>
			<div class="mota">
				<?php echo TomTat($row_tin['TomTat'],500); ?>
			</div>
			<div class="tacgia">
				<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" class="daidien"><img src="<?php echo 'upload/user/'.$row_user['urlHinh']; ?>"></a>
				<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" class="hoten"><?php  
					echo $row_user['HoTen'];
				?></a>
				<div class="ngaydang">Ngày đăng: <?php
					$datePost = date_parse_from_format('Y-m-d H:i:s',$row_tin['thoigian']);
					$tsPost = mktime($datePost['hour'],$datePost['minute'],$datePost['second'],$datePost['month'],$datePost['day'],$datePost['year']);
					echo date('d/m/Y H:i',$tsPost);
				?></div>
			</div>
			<div class="luotxem">
				<p><?php echo $row_tin['SoLanXem'] ?> Lượt xem</p>
				<p>Like: <?php echo $row_tin['luotlike'] ?> &nbsp; - &nbsp; Dislike: <?php echo $row_tin['luotdislike'] ?></p>
			</div>
		</div>
	</div>
	<?php  
		}
	?>
	<a href="index.php?keyword=&page=timkiem&idTL=0&sapxep=moinhat" style="float: right; font-size: 19px; margin-right: 20px;">Xem Thêm</a>
</div>

<div class="trangchinh">
	<a href="index.php?keyword=&page=timkiem&idTL=0&sapxep=xemnhieunhat"><h3 style="font-size: 21px; padding-top: 40px; margin-bottom: 10px">Bài xem nhiều nhất</h3></a>
	<hr>
	<?php  
		$tin = DanhSach_Tin($connect, 'xemnhieunhat',6);
		while($row_tin = mysqli_fetch_array($tin)){
	?>
	<div class="baidang">
		<img src="upload/tintuc/<?php echo $row_tin['urlHinh']; ?>" class="anh">
		<div class="noidungbaiviet">
			<a href="index.php?page=tin&idTin=<?php echo $row_tin['idTin']; ?>" class="tieude"><h3><?php echo $row_tin['TieuDe']; ?></h3></a>
			<br>
			<a href="index.php?page=theloai&idTL=<?php echo $row_tin['idTL']; ?>" class="theloai">/<?php 
					$row_theloai = ChiTietTheLoai($connect, $row_tin['idTL']);
					echo $row_theloai['TenTL'];
				?>
			</a>
			<div class="mota">
				<?php echo TomTat($row_tin['TomTat'],500); ?>
			</div>
			<div class="tacgia">
				<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" class="daidien"><img src="<?php echo 'upload/user/'.$row_user['urlHinh']; ?>"></a>
				<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" class="username"><?php  
					$row_user = ChiTietUser($connect, $row_tin['idUser']);
					echo $row_user['HoTen'];
				?></a>
				<div class="ngaydang">Ngày đăng: <?php
					$datePost = date_parse_from_format('Y-m-d H:i:s',$row_tin['thoigian']);
					$tsPost = mktime($datePost['hour'],$datePost['minute'],$datePost['second'],$datePost['month'],$datePost['day'],$datePost['year']);
					echo date('d/m/Y H:i',$tsPost);
				?></div>
			</div>
			<div class="luotxem">
				<p><?php echo $row_tin['SoLanXem'] ?> Lượt xem</p>
				<p>Like: <?php echo $row_tin['luotlike'] ?> &nbsp; - &nbsp; Dislike: <?php echo $row_tin['luotdislike'] ?></p>
			</div>
		</div>
	</div>
	<?php  
		}
	?>
	<a href="index.php?keyword=&page=timkiem&idTL=0&sapxep=xemnhieunhat" style="float: right; font-size: 19px; margin-right: 20px;">Xem Thêm</a>
</div>