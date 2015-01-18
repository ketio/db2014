<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/library.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/session.php';
	
	if(isset($_SESSION["user"])){
		$userID=$_SESSION["user"]["userID"];
	}
	if(isset($_POST["score"]))	
		$score=$_POST["score"];	
	if(isset($_POST["videoID"]))	
		$videoID=$_POST["videoID"];			
		
	$mysqli=connect_database();

	$isRating=false;	
	$query2=
		"select ".
			"rating ".
		"from ".
			"user_feedback ".
		"where ".
			"userID= ? and videoID= ? ";
	$stmt = mysqli_prepare($mysqli, $query2);
	mysqli_stmt_bind_param($stmt,"ss",$userID,$videoID);
	mysqli_stmt_bind_result($stmt,$ratingTemp);
	mysqli_stmt_execute($stmt);
	if(mysqli_stmt_fetch($stmt)){
		$isRating = true;
	}			
	mysqli_stmt_close($stmt);
	
	$now=date('Y-m-d H:i:s', time());
	if($isRating){
		$query2=
			"update ".
				"user_feedback ".
			"set ".
				"rating = ?, time = ? ".
			"where ".
				"userID= ? and videoID= ? ";
		$stmt = mysqli_prepare($mysqli, $query2);
		mysqli_stmt_bind_param($stmt,"ssss",$score,$now,$userID,$videoID);
		mysqli_stmt_execute($stmt);		
		mysqli_stmt_close($stmt);	
	}
	else{
		$userFeedbackID=get_id("user_feedback","user_feedback","userFeedbackID",$mysqli);	
		$query="insert into user_feedback(userFeedbackID,userID,videoID,rating,time) values (?,?,?,?,?)";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt,"sssss",$userFeedbackID,$userID,$videoID,$score,$now);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);	
	}
	
?>