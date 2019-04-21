<div class="tablebaiviet">
	<table border="1">
	 	<tr>
	  	<tr>
	 		<td></td>
	 		<td></td>
	 		<td></td>
	 		<td></td>
	 		<td style="padding: 10px 0px 10px 0px" class="col5"><a href="self/thembaiviet.php">Thêm</a></td>
	 	</tr>
	 	<?php  
	 		$tin = DanhSach_Tin_User($connect,'moinhat',0 , 20);
	 		while($row_tin = mysqli_fetch_array($tin)){ 	
	 	?>
	 	<tr>
	 		<td class="col1">
	 			ID: <?php echo $row_tin['idTin']; ?>
	 			<br>
	 			<?php echo $row_tin['thoigian']; ?>
	 		</td>
	 		<td class="col2">
	 			<a href=""><?php echo $row_tin['TieuDe']; ?></a>
	 			<br>
	 			<img style="float: left; margin-right: 5px; margin-top: 5px;" src="../upload/tintuc/<?php echo $row_tin['urlHinh']; ?>" width="152" height="96">
	 			<?php echo $row_tin['TomTat']; ?>
	 		</td>
	 		<td class="col3">
	 			<?php
	 				$theloai = ChiTietTheLoai($connect,$row_tin['idTL']);
	 				echo $theloai['TenTL'];
	 			?>
	 		</td>
	 		<td class="col4">
	 			Số lượt xem <?php echo $row_tin['SoLanXem']; ?>
	 			<br>
	 			<br>
	 			Like: <?php echo $row_tin['luotlike']; ?>
	 			<br>
	 			Dislike: <?php echo $row_tin['luotdislike']; ?>
	 		</td>
	 		<td class="col5"> 
	 			<a href="self/suabaiviet.php?idTin=<?php echo $row_tin['idTin']; ?>">Sửa</a> - <a onclick="return confirm('Bạn có chắc muốn xóa tin <?php echo $row_tin['idTin']; ?> ?')" href="self/xoabaiviet.php?idTin=<?php echo $row_tin['idTin']; ?>">Xóa</a>
	 		</td>
	 	</tr>
	 	<?php  
	 		}
	 	?>
	</table>
</div>