<div class="binhluan">
	<div style="margin-bottom: 25px;">
		<p style="margin-left: 5px; margin-bottom: 10px">Bạn có thích bài viết này?</p>
		<div id="likedislike"><span style="margin-right: 80px; margin-left: 5px;">Thích</span><span>Không thích</span></div>
	</div>
	<div class="submitform">
		<table>
			<tr><td style="padding-bottom: 50px;">
				<form action="" method="post">
					<textarea name="txtarea" placeholder="Hãy viết bình luận của bạn tại đây ..."></textarea>
					<input type="submit" name="btnGui" value="Bình Luận">
				</form>
			</td></tr>
			<tr><td>
				<?php  
					$binhluan = DanhSachBinhLuan($connect, $idTin);
					while($row_binhluan = mysqli_fetch_array($binhluan)){
				?>
				<div class="binhluantruoc">
					<div class="motbinhluan">
						<div class="tacgia">
							<a href="user/index.php?id=<?php echo $row_binhluan['idUser'] ?>" class="daidien"><img src="<?php echo $anhdaidien; ?>"></a>
							<a href="user/index.php?id=<?php echo $row_binhluan['idUser'] ?>" class="hoten"><?php  
								$row_user = ChiTietUser($connect, $row_binhluan['idUser']);
									echo $row_user['HoTen'];
								?></a>
							<br>
							<div class="ngaydang" style="color: #808080; margin-top: 5px;">
								<?php 
									$thoigianbinhluan = $row_binhluan['thoigian'];
									$hientai = date('Y-m-d H:i:s');

									$datePost = date_parse_from_format('Y-m-d H:i:s', $thoigianbinhluan);
									$dateReply = date_parse_from_format('Y-m-d H:i:s', $hientai);

									$tsPost = mktime($datePost['hour'],$datePost['minute'],$datePost['second'],$datePost['month'],$datePost['day'],$datePost['year']);
									$tsReply = mktime($dateReply['hour'],$dateReply['minute'],$dateReply['second'],$dateReply['month'],$dateReply['day'],$dateReply['year']);
									$distance = $tsReply - $tsPost;

									$result = "";
									switch($distance){
										case ($distance < 10):
											$result = "Vừa xong";
										break;
										case ($distance >=10 && $distance < 60):
											$result = $distance . 'giây trước';
										break;
										case ($distance >=60 && $distance < 3600):
											$minute = round($distance/60);
											$result = $minute . 'phút trước';
										break;
										case ($distance >= 3600 && $distance < 86400):
											$hour = round($distance/3600);
											$result = $hour . 'giờ trước';
										break;
										case (round($distance/86400)==1):
											$result = 'Hôm qua lúc '.date('H:i:s',$tsPost);
										break;
										default:
											$result = date('d/m/Y H:i:s',$tsPost);
									}
									echo $result;
								?>
							</div>
						</div>
						<br>
						<div class="noidungbinhluan">
							<?php echo $row_binhluan['noidung']; ?>
						</div>
					</div>
					<?php  
						}
					?>
				</div>
			</td></tr>
		</table>
	</div>
</div>
