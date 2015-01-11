<html>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>
<?php
	session_cache_limiter('');
	session_start();
	
	$conn = mysqli_connect("green.dev", "root", "rhd1901", "kong");
	$id_tmp = $_POST['user_id'];
	$password_tmp = $_POST['user_password'];
	mysqli_select_db($conn,"kong");

	$findid= mysqli_query($conn, "SELECT userid FROM user WHERE userid='".$id_tmp."';");
	$findpassword= mysqli_query($conn, "SELECT password FROM user WHERE password='".$password_tmp."';");
	//var_dump($findid);
	$findid= mysqli_fetch_row($findid);
	$findpassword=mysqli_fetch_row($findpassword);

	if($id_tmp=="" || $password_tmp=="") {
		echo '<script type="text/javascript">';
		echo 'alert("아이디나 비밀번호가 입력되지 않았습니다.");';
		echo 'location.replace("./login2.html");';
		echo '</script>';
		return 1;
	}
	else if(!$findid) {
		if(!$findpassword) {
			echo "Your ID and password are wrong";
		}
		echo "<p><a href= \"login2.html\">Login again</a></p>";
		exit;
	}
	else if($findid) {
		if(!$findpassword) {
			echo "Your password is wrong";
			echo "<p><a href= \"login2.html\">Login again</a></p>";
		}
		else {
			$token= md5($userid.$password);
			$_SESSION['userid'] = $id_tmp;
			$_SESSION['token']= $token;
			header('Location: ./loginsession.php');
			return 0;
	    }
	}	
?>
