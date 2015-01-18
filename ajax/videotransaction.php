<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/library.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/session.php';
	
	$userID=$_SESSION["user"]["userID"];
	$userName=$_SESSION["user"]["userName"];
	if(isset($_POST["mode"]))	
		$mode=$_POST["mode"];	
	if(isset($_POST["videoID"]))	
		$videoID=$_POST["videoID"];			
		
	$mysqli=connect_database();

	if($mode=="buy"){
		
		$depositSum=getDepositSum($mysqli,$userID);	
		
		$buyPrice=999999999;
		$videoName="";
		$query=
			"select ".
				"buyPrice,videoName ".
			"from ".
				"video ".
			"where ".
				"videoID= ? ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$videoID);
		mysqli_stmt_bind_result($stmt,$buyPriceTemp,$videoName);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_fetch($stmt)){
			$buyPrice=$buyPriceTemp;
		}
		mysqli_stmt_close($stmt);
		
		if($depositSum>=$buyPrice){
		
			$now=date('Y-m-d H:i:s', time());
			$havingID=get_id("having","having","havingID",$mysqli);
			
			$query=	"insert into `having`(havingID,userID,videoID,buyDate) values (?,?,?,?) ";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "ssss",$havingID,$userID,$videoID,$now);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);		
		
			echo "<response>";
				echo "<result>";
					echo "SUCCESS";
				echo "</result>";
				echo "<userName>";
					echo $userName;
				echo "</userName>";
				echo "<depositSum>";
					echo $depositSum;
				echo "</depositSum>";
				echo "<videoName>";
					echo $videoName;
				echo "</videoName>";
				echo "<buyPrice>";
					echo $buyPrice;
				echo "</buyPrice>";
				echo "<retainDeposit>";
					echo $depositSum-$buyPrice;
				echo "</retainDeposit>";
			echo "</response>";
		
		}
		else{
			echo "<response>";
				echo "<result>";
					echo "FAIL";
				echo "</result>";
				echo "<reason>";
					echo "餘額不足";
				echo "</reason>";
			echo "</response>";
		}
	}
	elseif($mode=="rent"){
	
		$depositSum=getDepositSum($mysqli,$userID);	
		$rentPrice=999999999;
		$videoName="";
		$query=
			"select ".
				"rentPrice,videoName ".
			"from ".
				"video ".
			"where ".
				"videoID= ? ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$videoID);
		mysqli_stmt_bind_result($stmt,$rentPriceTemp,$videoName);
		mysqli_stmt_execute($stmt);
		if(mysqli_stmt_fetch($stmt)){
			$rentPrice=$rentPriceTemp;
		}
		mysqli_stmt_close($stmt);
		
		if($depositSum>=$rentPrice){
		
			$now=time();
			$startTime=date('Y-m-d H:i:s', $now);
			$endTime=date('Y-m-d H:i:s', $now+24*60*60*30);
			
			$rentID=get_id("rent","rent","rentID",$mysqli);
			
			$query=	"insert into `rent`(rentID,userID,videoID,startTime,endTime) values (?,?,?,?,?) ";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "sssss",$rentID,$userID,$videoID,$startTime,$endTime);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);		
		
			echo "<response>";
				echo "<result>";
					echo "SUCCESS";
				echo "</result>";
				echo "<userName>";
					echo $userName;
				echo "</userName>";
				echo "<depositSum>";
					echo $depositSum;
				echo "</depositSum>";
				echo "<videoName>";
					echo $videoName;
				echo "</videoName>";
				echo "<rentPrice>";
					echo $rentPrice;
				echo "</rentPrice>";
				echo "<startTime>";
					echo $startTime;
				echo "</startTime>";
				echo "<endTime>";
					echo $endTime;
				echo "</endTime>";
				echo "<retainDeposit>";
					echo $depositSum-$rentPrice;
				echo "</retainDeposit>";
			echo "</response>";
		
		}
		else{
			echo "<response>";
				echo "<result>";
					echo "FAIL";
				echo "</result>";
				echo "<reason>";
					echo "餘額不足";
				echo "</reason>";
			echo "</response>";
		}		
	}
	elseif($mode=="put"){
	
		$time=date('Y-m-d H:i:s', time());
	
		$wantedID=get_id("wanted","wanted","wantedID",$mysqli);
			
		$query=	"insert into `wanted`(wantedID,userID,videoID,time) values (?,?,?,?) ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "ssss",$wantedID,$userID,$videoID,$time);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);		
	
		$videoName="";
		$query=
			"select ".
				"videoName ".
			"from ".
				"video ".
			"where ".
				"videoID= ? ";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$videoID);
		mysqli_stmt_bind_result($stmt,$videoName);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_fetch($stmt);
		mysqli_stmt_close($stmt);	
	
		echo "<response>";
			echo "<result>";
				echo "SUCCESS";
			echo "</result>";
			echo "<userName>";
				echo $userName;
			echo "</userName>";
			echo "<videoName>";
				echo $videoName;
			echo "</videoName>";
			echo "<time>";
				echo $time;
			echo "</time>";
		echo "</response>";
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