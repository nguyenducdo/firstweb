<div class="thongtintaikoan">
	<div>
		<p style="width: 450px" class="inline">Họ tên: <?php echo $row_user['HoTen'];?></p>
		<p style="" class="inline">ID User: <?php echo $row_user['idUser'];?></p>
	</div>
	<div><p>Username: <?php echo $row_user['Username']; ?></p></div>
	<div><p>Password: <?php for($i=0;$i<10;$i++) echo '&#9679'; ?></p></div>
	<div>
		<p style="width: 450px" class="inline">Email: <?php echo $row_user['Email'];?></p>
		<p style="" class="inline">Ngày đăng ký: 
			<?php
				$datePost = date_parse_from_format('Y-m-d',$row_user['NgayDangKy']);
					$tsPost = mktime($datePost['hour'],$datePost['minute'],$datePost['second'],$datePost['month'],$datePost['day'],$datePost['year']);
					echo date('d/m/Y',$tsPost);
			?>
		</p>
	</div>
</div>