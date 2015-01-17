<?php
	include_once './library.php';
	$mode=$_POST["mode"];
	if(isset($_POST["publisherName"]))
		$publisherName=$_POST["publisherName"];
	if(isset($_POST["publisherCountry"]))	
		$publisherCountry=$_POST["publisherCountry"];
	if(isset($_POST["publisherID"]))	
		$publisherID=$_POST["publisherID"];
		
	$mysqli=connect_database();
	
	if($mode=="new"){		
		$publisherID=get_id("publisher","publisher","publisherID",$mysqli);
		$query="insert into publisher(publisherID,publisherName,publisherCountry) values (?,?,?)";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		mysqli_stmt_bind_param($stmt, "sss",$publisherID,$publisherName,$publisherCountry);

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
		$query="select publisherID,publisherName,publisherCountry from publisher";
		$stmt = mysqli_prepare($mysqli, $query);

		/* bind parameters for markers */
		//mysqli_stmt_bind_param($stmt, "sss",$publisherID,$publisherName,$publisherCountry);
		mysqli_stmt_bind_result($stmt,$publisherID,$publisherName,$publisherCountry);
		mysqli_stmt_execute($stmt);
		while(mysqli_stmt_fetch($stmt)){
			$temp = array();
			$temp["publisherID"]=$publisherID;
			$temp["publisherName"]=$publisherName;
			$temp["publisherCountry"]=$publisherCountry;
			array_push($result,$temp);
		}
		mysqli_stmt_close($stmt);
		
		echo "<response>";
			echo "<result>";
				echo "取得成功";
			echo "</result>";	
			echo "<publishers>";
				foreach($result as $publisher){
					echo "<publisher>";
						echo "<publisherID>";
							echo $publisher["publisherID"];
						echo "</publisherID>";	
						echo "<publisherName>";
							echo $publisher["publisherName"];
						echo "</publisherName>";
						echo "<publisherCountry>";
							echo $publisher["publisherCountry"];
						echo "</publisherCountry>";					
					echo "</publisher>";
				}
			echo "</publishers>";				
		echo "</response>";
	}
	elseif($mode=="delete"){		
		
		$query="delete from publisher where publisherID=?";
		$stmt = mysqli_prepare($mysqli, $query);
		mysqli_stmt_bind_param($stmt, "s",$publisherID);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_close($stmt);
		
		echo "<response>";
			echo "<result>";
				echo "刪除成功";
			echo "</result>";		
		echo "</response>";
	}
?>