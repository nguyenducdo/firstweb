<div class="timkiem">
    <form action="" method="get" target="_self" id="search">
	    <input name="keyword" value="" maxlength="80" class="txt_input" type="text" placeholder="Tìm kiếm">
		<input value="" class="icon_search_web" type="submit">
		<input type="hidden" name="page" value="timkiem">
		<input type="hidden" name="idTL" value="<?php echo $idTL; ?>">
		<select name="sapxep">
			<option value="" disabled selected>Sắp xếp theo</option>
			<option value="'moinhat'">Mới nhất</option>
			<option value="'cunhat'">Cũ nhất</option>
			<option value="'xemnhieunhat'">Xem nhiều nhất</option>
		</select>
	</form>
</div>