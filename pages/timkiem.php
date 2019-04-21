<?php  
	$idTL = 0; //Tim tat ca the loai
	if(isset($_GET['idTL'])){
		$idTL = (int)$_GET['idTL'];
	}

	$keyword = $_GET['keyword']; // = "" -> tim tat ca tin trong the loai
	$sapxep = 'moinhat';
	if(isset($_GET['sapxep'])){
		$sapxep = $_GET['sapxep'];
	}
?>

<?php  
	if($idTL!=0){
		if($keyword!=""){
			$tin = TimKiem($connect,$keyword, $idTL, $sapxep);
		}
		else{
			$tin = DanhSach_Tin_TheoTheLoai($connect, $idTL, 0, $sapxep);
		}
	}
	else{
		if($keyword!=""){
			$tin = TimKiem($connect,$keyword, 0, $sapxep);
		}
		else{
			$tin = DanhSach_Tin($connect, $sapxep, 0);
		}
	}
	$row_theloai = ChiTietTheLoai($connect, $idTL);

	$ketqua = "KETQUA";
	$soluong = mysqli_num_rows($tin);
	if($keyword!=""){
		$ketqua = 'Tìm kiếm "'.$keyword.'" ( '.$soluong.' kết quả )';
	}
	else if($idTL!=0){
		$ketqua = $row_theloai['TenTL'];
	}
	else{
		$ketqua = "Tất cả các tin";
	}
?>
<div class="trangchinh">
	<h3 style="font-size: 21px; margin-bottom: 10px; display: inline-block;"><?php echo $ketqua; ?></h3>
	<?php require "blocks/formtimkiem.php" ?>
	<hr>
	<?php  
		$sotin1trang = 6;
	    if(isset($_GET['number'])){
	        $number = (int)$_GET['number'];
	    }
	    else $number = 1;
	    $from = ($number - 1)*$sotin1trang;
		$j = 0;
		$i = 0;
		while(($row_tin = mysqli_fetch_array($tin)) && $j < $sotin1trang){
			if($i++ < $from) continue;
			$j++;
			$row_user = ChiTietUser($connect, $row_tin['idUser']);
	?>
	<div class="baidang">
		<img src="upload/tintuc/<?php echo $row_tin['urlHinh']; ?>" class="anh">
		<div class="noidungbaiviet">
			<a href="index.php?page=tin&idTin=<?php echo $row_tin['idTin']; ?>" class="tieude"><h3><?php echo $row_tin['TieuDe']; ?></h3></a>
			<br>
			<a href="index.php?page=theloai&idTL=<?php echo $row_tin['idTL']; ?>" class="theloai">/<?php
				$row_theloai = ChiTietTheLoai($connect,$row_tin['idTL']);
				echo $row_theloai['TenTL'];
			?>
			</a>
			<div class="mota">
				<?php echo TomTat($row_tin['TomTat'],500) ?>
			</div>
			<div class="tacgia">
				<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" class="daidien"><img src="<?php echo 'upload/user/'.$row_user['urlHinh']; ?>"></a>
				<a href="user/index.php?id=<?php echo $row_tin['idUser']; ?>" class="username"><?php  
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
	<div id="phantrang">
		<?php  
			$tongsotin = mysqli_num_rows($tin);
			$tongsotrang = ceil($tongsotin/$sotin1trang);
			for($i=1;$i<=$tongsotrang;$i++){
		?>
		<a href="index.php?keyword=<?php echo str_replace(" ","+",$keyword); ?>&page=timkiem&idTL=<?php echo $idTL; ?>&sapxep=<?php echo $sapxep; ?>&number=<?php echo $i; ?>"><?php echo $i; ?></a>
		<?php  
			}
		?>
	</div>
</div>