<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();
	if($_SESSION['islogin']==0 || !isset($_SESSION['islogin'])){
   		header('Location: ./login2.html');
   	}
	//데이터베이스에 접근하기 위한 부분
	$conn = mysqli_connect("green.dev", "root", "rhd1901", "kong");
	
	$_SESSION['name'] = $_SESSION['userid'];
	//세션에서 토큰(키 값)을 가져온다.
	$getSessionToken = $_SESSION['token'];
	//세션에서 아이디를 가져온다.
	$_SESSION['islogin'] = 1;
	$user_id = $_SESSION['userid'];
	//*사실 아이디와 같은부분은 서버에 부담을 최소화하기위해 쿠키에 저장하는게 바람직하다.
	
	//데이터베이스에서 id가 가진 토큰을 가져온다.
	$getDBToken = "SELECT token FROM user WHERE userid='$id_tmp';";
	$getDBToken = mysqli_query($conn, $getDBToken);
	$getDBToken = mysqli_use_result($getDBToken, 0);
	//세션에 등록한 토큰과 데이터베이스의 토큰이 일치하면
	
?>
<html>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
	<head>
		<style type="text/css">
			fieldset {
				width: 400px;
				padding : 20px;
			}
		</style>
		<title>Members' page</title>
	</head>
	<body>
		<div class="container">
			<p class="login_message">
				<fieldset>
					<?php
						if($getDBToken == $getSessionToken && $getSessionToken){
							//로그인 인정
							$login = 1;
							echo "$id_tmp 님 <br>환영합니다 <br>";
						}
					?>
				</fieldset>
			</p>
			<button type="submit" value="logout" onclick=location.href="./logout.php">로그아웃</button><br>
		</div>
	</body>
</html>