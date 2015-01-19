<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/library.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/session.php';
	
	if(isset($_SESSION["user"])){
		$userID=$_SESSION["user"]["userID"];
	}
	else{
		exit;
	}
	if(isset($_POST["mode"]))	
		$mode=$_POST["mode"];	
	if(isset($_POST["userName"]))	
		$newUserName=$_POST["userName"];	

	$mysqli=connect_database();
	if($mode=="wanted"){
		
		$result=array();
		$query=
			"select ".
				"B.videoID,B.videoName,A.time ".
			"from ".
				"wanted as A, ".
				"video as B ".
			"where ".
				"A.userID= ? and B.videoID=A.videoID ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$userID);
		mysqli_stmt_bind_result($stmt,$videoID,$videoName,$time);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp=array();
			$temp["videoID"]=$videoID;
			$temp["videoName"]=$videoName;
			$temp["time"]=$time;
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);

		echo "<response>";
			echo "<result>";
				echo "SUCCESS";
			echo "</result>";
			echo "<videos>";
			foreach($result as $video){
				echo "<video>";
					echo "<videoID>";
						echo $video["videoID"];
					echo "</videoID>";
					echo "<videoName>";
						echo $video["videoName"];
					echo "</videoName>";
					echo "<time>";
						echo $video["time"];
					echo "</time>";
				echo "</video>";
			}
			echo "</videos>";
		echo "</response>";
	}
	elseif($mode=="buy"){
		
		$result=array();
		$query=
			"select ".
				"B.videoID,B.videoName,A.buyDate ".
			"from ".
				"`having` as A, ".
				"video as B ".
			"where ".
				"A.userID= ? and B.videoID=A.videoID ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$userID);
		mysqli_stmt_bind_result($stmt,$videoID,$videoName,$time);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp=array();
			$temp["videoID"]=$videoID;
			$temp["videoName"]=$videoName;
			$temp["time"]=$time;
			
			$mysqli2=connect_database();
			$rating = 0;
			$query2=
				"select ".
					"rating ".
				"from ".
					"user_feedback ".
				"where ".
					"userID= ? and videoID= ? ";
			$stmt2 = mysqli_prepare($mysqli2, $query2);
			mysqli_stmt_bind_param($stmt2,"ss",$userID,$videoID);
			mysqli_stmt_bind_result($stmt2,$ratingTemp);
			mysqli_stmt_execute($stmt2);
			if(mysqli_stmt_fetch($stmt2)){
				$rating = $ratingTemp;
			}			
			mysqli_stmt_close($stmt2);
			
			$temp["rating"]=$rating;				
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);

		echo "<response>";
			echo "<result>";
				echo "SUCCESS";
			echo "</result>";
			echo "<videos>";
			foreach($result as $video){
				echo "<video>";
					echo "<videoID>";
						echo $video["videoID"];
					echo "</videoID>";
					echo "<videoName>";
						echo $video["videoName"];
					echo "</videoName>";
					echo "<time>";
						echo $video["time"];
					echo "</time>";
					echo "<rating>";
						echo $video["rating"];
					echo "</rating>";
				echo "</video>";
			}
			echo "</videos>";
		echo "</response>";
	}
	elseif($mode=="rent"){
		
		$result=array();
		$query=
			"select ".
				"B.videoID,B.videoName,A.startTime,A.endTime ".
			"from ".
				"`rent` as A, ".
				"video as B ".
			"where ".
				"A.userID= ? and B.videoID=A.videoID ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$userID);
		mysqli_stmt_bind_result($stmt,$videoID,$videoName,$startTime,$endTime);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp=array();
			$temp["videoID"]=$videoID;
			$temp["videoName"]=$videoName;
			$temp["startTime"]=$startTime;
			$temp["endTime"]=$endTime;
			
			$mysqli2=connect_database();
			$rating = 0;
			$query2=
				"select ".
					"rating ".
				"from ".
					"user_feedback ".
				"where ".
					"userID= ? and videoID= ? ";
			$stmt2 = mysqli_prepare($mysqli2, $query2);
			mysqli_stmt_bind_param($stmt2,"ss",$userID,$videoID);
			mysqli_stmt_bind_result($stmt2,$ratingTemp);
			mysqli_stmt_execute($stmt2);
			if(mysqli_stmt_fetch($stmt2)){
				$rating = $ratingTemp;
			}			
			mysqli_stmt_close($stmt2);
			
			$temp["rating"]=$rating;
			
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);

		echo "<response>";
			echo "<result>";
				echo "SUCCESS";
			echo "</result>";
			echo "<videos>";
			foreach($result as $video){
				echo "<video>";
					echo "<videoID>";
						echo $video["videoID"];
					echo "</videoID>";
					echo "<videoName>";
						echo $video["videoName"];
					echo "</videoName>";
					echo "<startTime>";
						echo $video["startTime"];
					echo "</startTime>";
					echo "<endTime>";
						echo $video["endTime"];
					echo "</endTime>";
					echo "<rating>";
						echo $video["rating"];
					echo "</rating>";
				echo "</video>";
			}
			echo "</videos>";
		echo "</response>";
	}
	elseif($mode=="member"){
		
		$result=array();
		$query=
			"select ".
				"userID,account,userName,gender,birthday ".
			"from ".
				"user ".
			"where ".
				"userID= ? ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$userID);
		mysqli_stmt_bind_result($stmt,$userID,$account,$userName,$gender,$birthday);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_fetch($stmt)){
			$result["userID"]=$userID;
			$result["account"]=$account;
			$result["userName"]=$userName;
			$result["gender"]=$gender;
			$result["birthday"]=$birthday;
			
		}
		mysqli_stmt_close($stmt);

		$depositSum=getDepositSum($mysqli,$userID);
		
		echo "<response>";
			echo "<result>";
				echo "SUCCESS";
			echo "</result>";
			echo "<member>";
				echo "<userID>";
					echo $result["userID"];
				echo "</userID>";
				echo "<account>";
					echo $result["account"];
				echo "</account>";
				echo "<userName>";
					echo $result["userName"];
				echo "</userName>";
				echo "<gender>";
					echo $result["gender"];
				echo "</gender>";
				echo "<birthday>";
					echo $result["birthday"];
				echo "</birthday>";
				echo "<depositSum>";
					echo $depositSum;
				echo "</depositSum>";
			echo "</member>";
		echo "</response>";
	}
	elseif($mode=="revise"){
		
		$result=array();
		$query=
			"update ".
				"user ".
			"set ".
				"userName = ? ".
			"where ".
				"userID= ? ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "ss",$newUserName,$userID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
	}
	
	function getDepositSum($mysqli,$userID){
		$depositSum=-100000;
		$query=
			"select ".
				"sum(money)".
			"from ".
				"deposit ".
			"where ".
				"userID= ? ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$userID);
		mysqli_stmt_bind_result($stmt,$depositSumTemp);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_fetch($stmt)){
			$depositSum=$depositSumTemp;
		}
		mysqli_stmt_close($stmt);
		
		$query=
			"(select ".
				"B.buyPrice as Price ".
			"from ".
				"`having` as A, ".
				"video as B ".
			"where ".
				"A.userID= ? and B.videoID=A.videoID) ".
			"union ".
			"(select ".
				"D.rentPrice as Price ".
			"from ".
				"rent as C, ".
				"video as D ".
			"where ".
				"C.userID= ? and D.videoID=C.videoID)";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "ss",$userID,$userID);
		mysqli_stmt_bind_result($stmt,$price);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$depositSum=$depositSum-$price;
		}
		mysqli_stmt_close($stmt);
		
		return $depositSum;
	}

?>