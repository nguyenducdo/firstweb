<?php  
	function checkEmail($email){
		$pattern = '#^\w[\w\.]*@[A-Za-z0-9]{2,}(\.[a-z0-9]{2,}){1,2}$#';
		$flag = false;
		if(preg_match($pattern, $email)){
			$flag = true;
		}
		return $flag;
	}

	function checkUsername($username){
		$pattern = '#^[A-Za-z_][A-Za-z0-9_\.\s]*$#';
		$flag = false;
		if(preg_match($pattern, $username)){
			$flag = true;
		}
		return $flag;
	}

	function checkPassword($password){
		$pattern = '#^(?=.*\d)(?=.*\W)(?=.*[A-Z]).{8,}$#';
		$flag = false;
		if(preg_match($pattern, $password)){
			$flag = true;
		}
		return $flag;
	}

	function checkUrl($url){
		$pattern = '#^(https?://(www\.)? | www\.)[A-Za-z0-9\-]+(\.[A-Za-z]{2,}){1,2}$#';
		$flag = false;
		if(preg_match($pattern, $url)){
			$flag = true;
		}
		return $flag;
	}

	function checkInput($value, $type = 'email'){
		$pattern = "";
		switch ($type) {
			case 'email':
				$pattern = '#^\w[\w\.]*@[A-Za-z0-9]{2,}(\.[a-z0-9]{2,}){1,2}$#';
				break;
			case 'username':
				$pattern = '#^[A-Za-z_][A-Za-z0-9_\.\s]*$#';
				break;
			case 'password':
				$pattern = '#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}$#';
				break;
			case 'url':
				$pattern = '#^(https?://(www\.)? | www\.)[A-Za-z0-9\-]+(\.[A-Za-z]{2,}){1,2}$#';
				break;
			default:
				break;
		}

		$flag = preg_match($pattern, $value);
		return $flag;
	}

?>