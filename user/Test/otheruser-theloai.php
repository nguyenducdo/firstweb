		<?php  
			$sotin1trang = 6;
		    if(isset($_GET['number'])){
		        $number = (int)$_GET['number'];
		    }
		    else $number = 1;
		    $from = ($number - 1)*$sotin1trang;
		    if($idTL!=0){
			    $tin = DanhSachTin_PhanTrang_TheoTheLoai($connect, $idTL, $from, $sotin1trang);
			}
			else{
				$tin = DanhSach_Tin_User($connect, 'moinhat',$from, $sotin1trang);
			}
			while($row_tin = mysqli_fetch_array($tin)){
		?>
		<div class="baidang">
			<img src="../upload/tintuc/<?php echo $row_tin['urlHinh']; ?>" class="anh">
			<div class="noidungbaiviet">
				<a href="../index.php?page=tin&idTin=<?php echo $row_tin['idTin']; ?>" class="tieude"><h3><?php echo $row_tin['TieuDe']; ?></h3></a>
				<br>
				<a href="index.php?id=<?php echo $idOtherUser;?>&idTL=<?php echo $row_tin['idTL']; ?>" class="theloai">/<?php 
						$row_theloai = ChiTietTheLoai($connect, $row_tin['idTL']);
						echo $row_theloai['TenTL'];
					?>
				</a>
				<div class="mota">
					<?php echo TomTat($row_tin['TomTat'],500) ?>
				</div>
				<div class="tacgia">
					<a href="index.php?id=<?php echo $row_tin['idUser']; ?>" class="daidien"><img src="../img/Koala.jpg"></a>
					<a href="index.php?id=<?php echo $row_tin['idUser']; ?>" class="username"><?php  
						$row_user = ChiTietUser($connect, $row_tin['idUser']);
						echo $row_user['HoTen'];
					?></a>
					<div class="ngaydang">Ngay xx/xx/xxxx</div>
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
				if($idTL!=0){
					$t = DanhSach_Tin_TheoTheLoai($connect, $idTL, 0, null);
				}
				else{
					$t = DanhSach_Tin($connect, 'moinhat', 0);
				}
				$tongsotin = mysqli_num_rows($t);
				$tongsotrang = ceil($tongsotin/$sotin1trang);
				for($i=1;$i<=$tongsotrang;$i++){
			?>
			<a href="index.php?id=<?php echo $idOtherUser;?>&idTL=<?php echo $idTL; ?>&number=<?php echo $i; ?>"><?php echo $i; ?></a>
			<?php  
				}
			?>
		</div>