<html>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
</html>
<?php
	//세션을 사용하기 위해 선언하는 부분
	session_cache_limiter('');
	session_start();
	//세션에 등록된 아이디 가져오기
	$user_id = $_SESSION['userid'];
	//세션에 등록된 토큰 파기
	$_SESSION['name'] = "";
	$_SESSION['token'] = 0;	
	$_SESSION['islogin'] = 0;
	//세션에 등록된 아이디 파기
	$_SESSION['userid'] = 0;
	//데이터베이스에서 토큰 초기화
	echo '<script>';
	echo 'alert("로그아웃 되었습니다.");';
	echo '</script>';
	header('Location: ./login2.html');
?>
