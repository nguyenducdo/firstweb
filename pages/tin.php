<?php
	if(isset($_GET['idTin'])){
		$idTin = (int)$_GET['idTin'];
	}
	else $idTin = 1;
	CapNhatSoLanXemTin($connect, $idTin);
	$row_tin = ChiTietTin($connect, $idTin);
	$row_tacgia = ChiTietUser($connect, $row_tin['idUser']);
	if(isset($_SESSION['idUser']))$row_user = ChiTietUser($connect,$_SESSION['idUser']);
?>

<?php  
	if(isset($_POST['btnGui']) && $_POST['txtarea']!=""){
		// $idUser = $row_tin['idUser'];
		$idUser = $_SESSION['idUser'];
		$text = $_POST['txtarea'];
		$qr = "
			INSERT INTO binhluan
			VALUES (null,'$idUser','$text','$idTin',NOW()) 
		";
		mysqli_query($connect,$qr);
	}
?>

<div class="trangtin">
	<div id="tacgia">
		<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" id="daidien"><img src="<?php  echo 'upload/user/'.$row_tacgia['urlHinh']; ?>"></a>
		<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" id="hoten"><?php  echo $row_tacgia['HoTen'];?></a>
		<div class="luotxem">
			<p>Lượt xem: <?php echo $row_tin['SoLanXem'] ?></p>
			<p>Like: <?php echo $row_tin['luotlike'] ?></p>
			<p>Dislike: <?php echo $row_tin['luotdislike'] ?></p>
		</div>	
		<br>
		<div class="ngaydang">Ngày đăng: <?php
					$datePost = date_parse_from_format('Y-m-d H:i:s',$row_tin['thoigian']);
					$tsPost = mktime($datePost['hour'],$datePost['minute'],$datePost['second'],$datePost['month'],$datePost['day'],$datePost['year']);
					echo date('d/m/Y H:i',$tsPost);
				?></div>
	</div>
	<hr width="80%">
	<div class="chitietbaiviet">
		<div id="tieude"><?php echo $row_tin['TieuDe']; ?></div>
		<div id="tomtat"><?php echo TomTat($row_tin['TomTat'],500); ?></div>
		<div id="noidung"><?php echo CheckNoiDung($row_tin['Content']); ?></div>
	</div>
	<hr width="80%">
	<?php 
		if(isset($_SESSION['idUser'])){
			require "blocks/binhluan.php";
		}
		else{
			echo 'Dang nhap di. dmm';
		}
	?>
	<div class="tinkhac">
		<table>
			<tr>
				<td style="color: #b20707; text-align: center; font-style: italic;">Một số tin khác</td>
			</tr>
			<?php require "blocks/tinkhac.php"; ?>
		</table>
	</div>
</div>