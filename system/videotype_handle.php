<?php
	include_once './library.php';
	$mode=$_POST["mode"];
	if(isset($_POST["videoTypeName"]))
		$videoTypeName=$_POST["videoTypeName"];
	if(isset($_POST["videoTypeMode"]))	
		$videoTypeMode=$_POST["videoTypeMode"];
	if(isset($_POST["videoTypeID"]))	
		$videoTypeID=$_POST["videoTypeID"];
		
	$mysqli=connect_database();
	
	if($mode=="new"){		
		$videoTypeID=get_id("videotype","videotype","videoTypeID",$mysqli);
		$query="insert into videotype(videoTypeID,videoTypeName,videoTypeMode) values (?,?,?)";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "sss",$videoTypeID,$videoTypeName,$videoTypeMode);

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
		$query="select videoTypeID,videoTypeName,videoTypeMode from videotype";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		//mysqli_stmt_bind_param($stmt, "sss",$videoTypeID,$videoTypeName,$videoTypeMode);
		mysqli_stmt_bind_result($stmt,$videoTypeID,$videoTypeName,$videoTypeMode);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp = array();
			$temp["videoTypeID"]=$videoTypeID;
			$temp["videoTypeName"]=$videoTypeName;
			$temp["videoTypeMode"]=$videoTypeMode;
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);
		
		echo "<response>";
			echo "<result>";
				echo "取得成功";
			echo "</result>";	
			echo "<videotypes>";
				foreach($result as $videotype){
					echo "<videotype>";
						echo "<videoTypeID>";
							echo $videotype["videoTypeID"];
						echo "</videoTypeID>";	
						echo "<videoTypeName>";
							echo $videotype["videoTypeName"];
						echo "</videoTypeName>";
						echo "<videoTypeMode>";
							echo $videotype["videoTypeMode"];
						echo "</videoTypeMode>";					
					echo "</videotype>";
				}
			echo "</videotypes>";				
		echo "</response>";
	}
	elseif($mode=="delete"){		
		
		$query="delete from videotype where videoTypeID=?";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$videoTypeID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		echo "<response>";
			echo "<result>";
				echo "刪除成功";
			echo "</result>";		
		echo "</response>";
	}
?>