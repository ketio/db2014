<?php 
	include_once "./system/session.php"; 
	include_once "./system/library.php"; 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php
	$mode=$_POST["mode"];
	if(isset($_POST["account"]))
		$account=$_POST["account"];
	if(isset($_POST["password"]))
		$password=$_POST["password"];
	
	
	
	$mysqli=connect_database();
	
	if($mode=="login"){
	
		$login_status=false;
		$query="select userID,account,userName from user where account = ? and password = ?";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "ss",$account,$password);
		mysqli_stmt_bind_result($stmt,$userID,$account,$userName);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_fetch($stmt)){
			$login_status=true;
		}
		mysqli_stmt_close($stmt);
		if($login_status){
			$_SESSION["user"]["userID"]=$userID;
			$_SESSION["user"]["account"]=$account;
			$_SESSION["user"]["userName"]=$userName;
			
			echo
				"<script>".
					"window.location.replace('/db2014/member.php');".
				"</script>";
		}
		else{
			echo
				"<script>".
					"alert('帳號或密碼錯誤');".
					"window.location.replace('/db2014/member.php');".
				"</script>";
		}		
	}
	elseif($mode=="logout"){
		$_SESSION=array();
		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(),'',time()-42000,'/');
		}
		session_destroy();
		echo
			"<script>".
				"window.location.replace('/db2014/index.php');".
			"</script>";
		
	}
	
?>	
</html>
