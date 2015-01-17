<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/db2014/system/library.php';
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
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);
		
		

		echo "<response>";
			echo "<result>";
				echo "取得成功";
			echo "</result>";	
			echo "<query>";
				echo $query;
			echo "</query>";
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
					echo "</video>";
				}
			echo "</videos>";				
		echo "</response>";
	}
	elseif($mode=="item"){
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
					echo "</video>";
				}
			echo "</videos>";				
		echo "</response>";
	}

?>