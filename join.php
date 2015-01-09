<html>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>
<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();
	
	//데이터베이스에 접근하기 위한 부분
	$conn = mysqli_connect("green.dev", "root", "rhd1901", "kong");
	mysqli_select_db($conn,"kong");

	$id_tmp = $_POST['user_id'];
	$password_tmp = $_POST['user_password'];
	$forMD5 = $id_tmp.$password_tmp;
	$check = "SELECT * FROM user WHERE userid='".$id_tmp."';";
	$check = mysqli_query($check);
	$check = mysqli_use_result($check, 0, "userid");
	//아이디가 있다면
	if($id_tmp) {
		if(!$check){
			if($password_tmp){
			$token = md5($forMD5);
			$setQuery= "INSERT INTO user VALUES ('$id_tmp', '$password_tmp', '$token')";
			$setQuery = mysqli_query($setQuery);
			$setQuery = mysqli_use_result($setQuery, 0);
			header('Location: ./joinend.html');
			return 0;
			}
		}
	}
?>