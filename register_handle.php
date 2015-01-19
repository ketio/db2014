<?php 
	include_once "./system/session.php"; 
	include_once "./system/library.php"; 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php

	$acct=$_POST["account"];
	$pass=$_POST["password"];
	$user=$_POST["username"];
	$g=$_POST["gender"];
	$bY=$_POST["birthday_y"];
	$bM=$_POST["birthday_m"];
	$bD=$_POST["birthday_d"];
	$date = $bY."-".$bM."-".$bD." 00:00:00";

	$mysqli=connect_database();
	
	$accountRepeat=false;
	$query="select userID from user where account=?";
	$stmt = mysqli_prepare($mysqli, $query);
	mysqli_stmt_bind_param($stmt,"s",$acct);
	mysqli_stmt_execute($stmt);
	if(mysqli_stmt_fetch($stmt)){
	
		$accountRepeat=true;
	}
	mysqli_stmt_close($stmt);
	
	if($accountRepeat){
		echo
			"<script>".
				"alert('帳號重複!');".
				"window.location.replace('/db2014/register.php');".
			"</script>";
	}
	else{
	
	
		$userID=get_id("user","user","userID",$mysqli);	
		$query="insert into user(userID,account,password,userName,gender,birthday) values (?,?,?,?,?,?)";
		$stmt = mysqli_prepare($mysqli, $query);
		
		mysqli_stmt_bind_param($stmt,"ssssss",$userID,$acct,$pass,$user,$g,$date);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		$now=date('Y-m-d H:i:s', time());
		$money="1000";
		$depositID=get_id("deposit","deposit","depositID",$mysqli);
		$query="insert into deposit(depositID,userID,time,money) values (?,?,?,?)";
		$stmt = mysqli_prepare($mysqli, $query);
		
		mysqli_stmt_bind_param($stmt,"ssss",$depositID,$userID,$now,$money);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);	
		echo
			"<script>".
				"window.location.replace('/db2014/register_result.php');".
			"</script>";
	}
?>