<form action="#" method="post" id="loginForm">
	<table>
		<tr>
			<td><input type="text" class="input" name="txtUn" placeholder="Tài khoản"></td>
			<td><input type="password" class="input" name="txtPa" placeholder="Mật khẩu"></td>
			<td><input type="submit" name="btnLogin" value="Đăng nhập"><span><a href="./user/dangky">Đăng ký</span></a></td>
		</tr>
		<tr>
			<td id="loidangnhap" colspan="2"><?php echo $_SESSION['loidangnhap']; ?></td>
		</tr>
	</table>
</form>

<style type="text/css">
	#loginForm input[type=submit]{
		padding: 5px;
		font-size: 13px;
		font-weight: bold;
		/*margin-bottom: 10px;*/
		border: 1px solid black;
		border-radius: 5px;
		background-color: white;
	}

	#loginForm input[type=submit]:hover{
		border-color: blue;
		color: blue;
	}

	#loginForm .input{
		border: none;
		border-bottom: 1px solid black;
		font-size: 14px;
		padding: 3px;
		margin-right: 15px;
	}

	#loginForm #loidangnhap{
		color: red;
		font-size: 14px;
		font-style: italic;
		padding-top: 8px;
	}

	#loginForm span{
		border-left: 1px solid black;
		margin-left: 8px;
		padding-left: 8px;
	}

	#loginForm span a{
		color: blue;
		/*text-decoration: underline;*/
	}

</style>