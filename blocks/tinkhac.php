<?php  
	$tin = DanhSach_Tin($connect, 'tron',6);
	while($row_tin = mysqli_fetch_array($tin)){
?>
<tr>
	<td>
		<div class="tieude">
			<a href="index.php?page=tin&idTin=<?php echo $row_tin['idTin'] ?>" title="<?php echo $row_tin['TieuDe']; ?>"><?php echo TomTat($row_tin['TieuDe'],45); ?></a>
		</div>
		<div class="mota">
			<img src="upload/tintuc/<?php echo $row_tin['urlHinh']?>">
			<p><?php echo TomTat($row_tin['TomTat'],250); ?></p>
		</div>
	</td>
</tr>
<?php  
	}
?>