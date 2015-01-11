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

	if(isset($_POST['user_id']) && isset($_POST['user_password']) && $_POST['user_id']!="" && $_POST['user_password']!="") {
		$id = $_POST['user_id'];
		$password = $_POST['user_password'];
		$forMD5 = $id.$password;	
	}
	else {
		echo '<script type="text/javascript">';
		echo 'alert("아이디나 비밀번호가 입력되지 않았습니다.");';
		echo 'location.replace("./join.html");';
		echo '</script>';
		return 0;
	}
	$id = $_POST['user_id'];
	$check = "SELECT * FROM user WHERE userid='$id';";
	$check = mysqli_query($conn, $check);
	$check = mysqli_use_result($conn);

	if($id) {
		if(!$check){
			if($password){
			$token = md5($forMD5);
			$setQuery= "INSERT INTO user VALUES ('$id', '$password', '$token')";
			$setQuery = mysqli_query($conn, $setQuery);
			$setQuery = mysqli_use_result($setQuery);
			header('Location: ./joinend.html');
			return 0;
			}
		}
		else {
			echo '<script type="text/javascript">';
			echo 'alert("아이디가 중복되었습니다.");';
			echo 'location.replace("./signup.html");';
			echo '</script>';
			return 1;
		}
	}
?>