<ul>
	<?php
		$idTL=0;
		if(isset($_GET['idTL'])){
			$idTL = (int)$_GET['idTL'];
		}
	?>
	<li><a href="./" style="<?php if($idTL==0) echo 'color: red;' ?>">Trang Chủ</a></li>
	<?php  
		$theloai = DanhSachTheLoai($connect);
		while($row_theloai = mysqli_fetch_array($theloai)){
	?>
		<li><a href="index.php?page=theloai&idTL=<?php echo $row_theloai['idTL']; ?>" style="<?php if($idTL == $row_theloai['idTL']) echo 'color: red;' ?>">
			<?php echo $row_theloai['TenTL']; ?>
		</a></li>
	<?php  
		}
	?>
</ul>