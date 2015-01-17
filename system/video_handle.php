<?php
	include_once './library.php';
	$mode=$_POST["mode"];
	if(isset($_POST["videoID"]))
		$videoID=$_POST["videoID"];
	if(isset($_POST["videoName"]))
		$videoName=$_POST["videoName"];
	if(isset($_POST["videoType"]))
		$videoType=$_POST["videoType"];
	if(isset($_POST["rentPrice"]))	
		$rentPrice=$_POST["rentPrice"];
	if(isset($_POST["buyPrice"]))
		$buyPrice=$_POST["buyPrice"];
	if(isset($_POST["publishDate"]))	
		$publishDate=$_POST["publishDate"];
	if(isset($_POST["publisher"]))	
		$publisher=$_POST["publisher"];	
	if(isset($_POST["lang"]))	
		$lang=$_POST["lang"];			
		
	$mysqli=connect_database();
	
	if($mode=="new"){		
		$videoID=get_id("video","video","videoID",$mysqli);
		$query="insert into video(videoID,videoName,videoType,rentPrice,buyPrice,publishDate,publisher,lang) values (?,?,?,?,?,?,?,?)";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "ssssssss",$videoID,$videoName,$videoType,$rentPrice,$buyPrice,$publishDate,$publisher,$lang);

		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		echo "<response>";
			echo "<result>";
				echo "新增成功";
			echo "</result>";		
		echo "</response>";
	}
	elseif($mode=="get"){		

		$result=array();
		$query=
			"select ".
				"A.videoID,A.videoName,C.videoTypeName,C.videoTypeMode,A.rentPrice,A.buyPrice,A.publishDate,B.publisherName,B.publisherCountry,A.lang ".
			"from ".
				"video as A, ".
				"publisher as B, ".
				"videotype as C ".
			"where ".
				"B.publisherID = A.publisher and C.videoTypeID = A.videotype";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		//mysqli_stmt_bind_param($stmt, "sss",$videoID,$videoName,$videoType);
		mysqli_stmt_bind_result($stmt,$videoID,$videoName,$videoTypeName,$videoTypeMode,$rentPrice,$buyPrice,$publishDate,$publisherName,$publisherCountry,$lang);
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
					echo "</video>";
				}
			echo "</videos>";				
		echo "</response>";
	}
	elseif($mode=="delete"){		
		
		$query="delete from video where videoID=?";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$videoID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		echo "<response>";
			echo "<result>";
				echo "刪除成功";
			echo "</result>";		
		echo "</response>";
	}
?>