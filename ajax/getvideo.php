<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/library.php';
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/session.php';
	
	if(isset($_POST["videoTypeName"]))	
		$videoTypeName=$_POST["videoTypeName"];
	if(isset($_POST["videoTypeMode"]))	
		$videoTypeMode=$_POST["videoTypeMode"];	
	if(isset($_POST["orderBy"]))	
		$orderBy=$_POST["orderBy"];			
	if(isset($_POST["mode"]))	
		$mode=$_POST["mode"];	
	if(isset($_POST["videoID"]))	
		$videoID=$_POST["videoID"];			
		
	$mysqli=connect_database();

	if($mode=="list"){
		$result=array();
		$query=
			"select ".
				"A.videoID,A.videoName,C.videoTypeName,C.videoTypeMode,A.rentPrice,A.buyPrice,A.publishDate,B.publisherName,B.publisherCountry,A.lang,A.intro ".
			"from ".
				"video as A, ".
				"publisher as B, ".
				"videotype as C ".
			"where ".
				"B.publisherID = A.publisher and C.videoTypeID = A.videotype and C.videoTypeName= ? ";
		if($videoTypeMode!="default"){
			$query.=
				" and C.videoTypeMode= ? ";
		}
		if($orderBy=="buyPrice"){
			$query.=
				"order by A.buyPrice";
		}elseif($orderBy=="publishDate"){
			$query.=
				"order by A.publishDate";
		}else{
			//donothing
		}
		

		$stmt = mysqli_prepare($mysqli, $query);

		if($videoTypeMode=="default"){
			mysqli_stmt_bind_param($stmt, "s",$videoTypeName);
		}
		elseif($videoTypeMode!="default"){
			mysqli_stmt_bind_param($stmt, "ss",$videoTypeName,$videoTypeMode);
		}
			/* bind parameters for markers */
		//mysqli_stmt_bind_param($stmt, "sss",$videoID,$videoName,$videoType);
		mysqli_stmt_bind_result($stmt,$videoID,$videoName,$videoTypeName,$videoTypeMode,$rentPrice,$buyPrice,$publishDate,$publisherName,$publisherCountry,$lang,$intro);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp = array();
			$temp["videoID"]=$videoID;
			$temp["videoName"]=$videoName;
			$temp["videoType"]=$videoTypeName."/".$videoTypeMode;
			$temp["rentPrice"]=$rentPrice;
			$temp["buyPrice"]=$buyPrice;
			$temp["publishDate"]=$publishDate;
			$temp["publisher"]=$publisherName."/".$publisherCountry;
			$temp["lang"]=$lang;
			$temp["intro"]=$intro;
			
			$mysqli2=connect_database();
			$rating = 0;
			$query2=
				"select ".
					"avg(rating) ".
				"from ".
					"user_feedback ".
				"where ".
					"videoID= ? ";
			$stmt2 = mysqli_prepare($mysqli2, $query2);
			mysqli_stmt_bind_param($stmt2,"s",$videoID);
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
				echo "取得成功";
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
						echo "<videoType>";
							echo $video["videoType"];
						echo "</videoType>";			
						echo "<rentPrice>";
							echo $video["rentPrice"];
						echo "</rentPrice>";	
						echo "<buyPrice>";
							echo $video["buyPrice"];
						echo "</buyPrice>";
						echo "<publishDate>";
							echo $video["publishDate"];
						echo "</publishDate>";
						echo "<publisher>";
							echo $video["publisher"];
						echo "</publisher>";
						echo "<lang>";
							echo $video["lang"];
						echo "</lang>";		
						echo "<intro>";
							echo $video["intro"];
						echo "</intro>";		
						echo "<rating>";
							echo $video["rating"];
						echo "</rating>";						
					echo "</video>";
				}
			echo "</videos>";				
		echo "</response>";
	}
	elseif($mode=="item"){
	
		$islogin=false;
		if(isset($_SESSION["user"]["userID"])){
			$islogin=true;
			$userID=$_SESSION["user"]["userID"];
		}
		
	
		$result=array();
		$query=
			"select ".
				"A.videoID,A.videoName,C.videoTypeName,C.videoTypeMode,A.rentPrice,A.buyPrice,A.publishDate,B.publisherName,B.publisherCountry,A.lang,A.intro ".
			"from ".
				"video as A, ".
				"publisher as B, ".
				"videotype as C ".
			"where ".
				"A.videoID=? and B.publisherID = A.publisher and C.videoTypeID = A.videotype";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "s",$videoID);
		mysqli_stmt_bind_result($stmt,$videoID,$videoName,$videoTypeName,$videoTypeMode,$rentPrice,$buyPrice,$publishDate,$publisherName,$publisherCountry,$lang,$intro);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp = array();
			$temp["videoID"]=$videoID;
			$temp["videoName"]=$videoName;
			$temp["videoType"]=$videoTypeName."/".$videoTypeMode;
			$temp["rentPrice"]=$rentPrice;
			$temp["buyPrice"]=$buyPrice;
			$temp["publishDate"]=$publishDate;
			$temp["publisher"]=$publisherName."/".$publisherCountry;
			$temp["lang"]=$lang;
			$temp["intro"]=$intro;
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);
		
		$isHaving=0;
		$isRent=0;
		$isPut=0;
		if($islogin){
			$query=
				"select ".
					"havingID ".
				"from ".
					"`having` ".
				"where ".
					"userID=? and videoID=?";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "ss",$userID,$videoID);
			mysqli_stmt_bind_result($stmt,$havingID);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_fetch($stmt)){
				$isHaving=1;
			}
			mysqli_stmt_close($stmt);
			
			$query=
				"select ".
					"rentID ".
				"from ".
					"rent ".
				"where ".
					"userID=? and videoID=?";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "ss",$userID,$videoID);
			mysqli_stmt_bind_result($stmt,$rentID);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_fetch($stmt)){
				$isRent=1;
			}
			mysqli_stmt_close($stmt);	

			
			$query=
				"select ".
					"wantedID ".
				"from ".
					"`wanted` ".
				"where ".
					"userID=? and videoID=?";
			$stmt = mysqli_prepare($mysqli, $query);
			mysqli_stmt_bind_param($stmt, "ss",$userID,$videoID);
			mysqli_stmt_bind_result($stmt,$havingID);
			mysqli_stmt_execute($stmt);
			if(mysqli_stmt_fetch($stmt)){
				$isPut=1;
			}
			mysqli_stmt_close($stmt);
		}
		echo "<response>";
			echo "<result>";
				echo "取得成功";
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
						echo "<videoType>";
							echo $video["videoType"];
						echo "</videoType>";			
						echo "<rentPrice>";
							echo $video["rentPrice"];
						echo "</rentPrice>";	
						echo "<buyPrice>";
							echo $video["buyPrice"];
						echo "</buyPrice>";
						echo "<publishDate>";
							echo $video["publishDate"];
						echo "</publishDate>";
						echo "<publisher>";
							echo $video["publisher"];
						echo "</publisher>";
						echo "<lang>";
							echo $video["lang"];
						echo "</lang>";		
						echo "<intro>";
							echo $video["intro"];
						echo "</intro>";
						echo "<isRent>";
							echo $isRent;
						echo "</isRent>";	
						echo "<isHaving>";
							echo $isHaving;
						echo "</isHaving>";	
						echo "<isPut>";
							echo $isPut;
						echo "</isPut>";							
					echo "</video>";
				}
			echo "</videos>";				
		echo "</response>";
	}

?>