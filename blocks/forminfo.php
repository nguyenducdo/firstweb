<?php  
	$idUser = $_SESSION['idUser'];
	$row_user = ChiTietUser($connect,$idUser);
	$anhdaidien .= $row_user['urlHinh'];
?>
<div id="infoForm">
	<table>
		<tr>
			<td class="HoTen"><?php echo $row_user['HoTen']; ?></td>
			<td rowspan="2"><a href="./user/"><img src="<?php echo $anhdaidien; ?>"></a></td>
		</tr>
		<tr>
			<td><form method="post" action="#"><input type="submit" name="btnThoat" value="Đăng xuất"></form></td>
		</tr>
	</table>
</div>

<style type="text/css">
	#infoForm table{
		text-align: right;
	}

	#infoForm .HoTen{
		font-size: 19px;
		font-weight: bold;
	}
	#infoForm img{
		width: 60px;
		height: 60px;
		border-radius: 100%;
		margin-left: 10px;
	}

	#infoForm input[type=submit]{
		padding: 3px 5px;
		font-size: 13px;
		/*margin-bottom: 10px;*/
		border: 1px solid black;
		border-radius: 5px;
		background-color: white;
	}

	#infoForm input[type=submit]:hover{
		border-color: blue;
		color: blue;
	}

</style>