<ul>
	<li><a href="index.php?id=<?php echo $idOtherUser;?>" style="<?php if($idTL==0) echo 'color: red;' ?>">Tất cả</a></li>
	<?php  
		$theloai = DanhSachTheLoai_TheoUser($connect,$idOtherUser);
		while($row_theloai = mysqli_fetch_array($theloai)){
	?>
		<li><a href="index.php?id=<?php echo $idOtherUser;?>&idTL=<?php echo $row_theloai['idTL']; ?>" style="<?php if($idTL == $row_theloai['idTL']) echo 'color: red;' ?>">
			<?php echo $row_theloai['TenTL']; ?>
		</a></li>
	<?php  
		}
	?>
</ul>