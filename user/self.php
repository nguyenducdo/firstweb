<?php  
	$row_user = ChiTietUser($connect,$idUser);
	$select = "";
	if(isset($_GET['select'])){
		$select = $_GET['select'];
	}
?>

<div class="self">
	<hr width="80%" style="margin:auto">
	<div id="thongtinchung">
		<img src="<?php echo $anhdaidien; ?>">
		<div class="p">
			<p id="ten"><?php echo $row_user['HoTen'] ?></p>
		</div>
		<div id="menu">
			<ul>
				<li><a href="index.php?" style="<?php if($select=="") echo 'color:#f41d1d'.';border-color:#f41d1d';?>">Thông tin tài khoản</a></li>
				<li><a href="index.php?select=baiviet" style="<?php if($select=="baiviet") echo 'color:#f41d1d'.';border-color:#f41d1d';?>">Bài viết</a></li>	
				<li><a href="index.php?select=suathongtin" style="<?php if($select=="suathongtin") echo 'color:#f41d1d'.';border-color:#f41d1d';?>">Sửa thông tin</a></li>
				<li><a href="index.php?select=khac" style="<?php if($select=="khac") echo 'color:#f41d1d'.';border-color:#f41d1d';?>">Khác</a></li>
			</ul>
		</div>
	</div>
	<div class="danhsach">
		<?php  
			switch ($select) {
				case 'baiviet':
					require "self/baiviet.php";
					break;
				case 'suathongtin':
					require "self/suathongtin.php";
					break;
				case 'khac':
					echo '
						<div><p style="font-size: 30px; text-align: center; margin-top: 50px;">Éo có cái lon gì đâu</p></div>
					';
					break;
				default:
					require "self/thongtintaikhoan.php";
					break;
			}
		?>
	</div>
</div>