<?php 
	include_once "./system/session.php"; 
	
	if(!isset($_SESSION["user"])){
		echo
			"<script>".
				"window.location.replace('/db2014/login.php');".
			"</script>";
	}
	$userID=$_SESSION["user"]["userID"];
?>	
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="system/js/raty/lib/jquery.raty.js"></script>
	<link type="text/css" rel="stylesheet" href="css/member.css"/>
	<link type="text/css" rel="stylesheet" href="system/js/raty/lib/jquery.raty.css"/>

	
	
	<script>
		var userID=<?php echo "'".$userID."'"; ?>;
		$(document).ready(function(){
			$("#wanted_list_option").click(function(){
				get_list("wanted");
			});
			$("#buy_list_option").click(function(){
				get_list("buy");
			});
			$("#rent_list_option").click(function(){
				get_list("rent");
			});
			$("#get_info_option").click(function(){
				get_list("member");
			});
		});
		
		function get_list(mode){
			$("#member_interface").empty();
			if(mode=="wanted"){
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"wanted"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='wanted_list'>"+
								"<tr>"+
									"<td>"+
										"圖片"+
									"</td>"+
									"<td>"+
										"影片名稱"+
									"</td>"+
									"<td>"+
										"加入時間"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("video").each(function(){
						
							var video={
								videoID:$(this).children("videoID").text(),
								videoName:$(this).children("videoName").text(),
								time:$(this).children("time").text()
							};
							console.log(video);
							$("#wanted_list").append(
								"<tr id='"+video.videoID+"'>"+
									"<td>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td>"+
										video.videoName+
									"</td>"+
									"<td>"+
										video.time+
									"</td>"+
								"</tr>"
							);
						
						});						
					}					
				});
			}
			else if(mode=="buy"){
			
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"buy"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='buy_list'>"+
								"<tr>"+
									"<td>"+
										"圖片"+
									"</td>"+
									"<td>"+
										"影片名稱"+
									"</td>"+
									"<td>"+
										"加入時間"+
									"</td>"+
									"<td>"+
										"評價"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("video").each(function(){
						
							var video={
								videoID:$(this).children("videoID").text(),
								videoName:$(this).children("videoName").text(),
								time:$(this).children("time").text(),
								rating:$(this).children("rating").text(),
							};
							
							$("#buy_list").append(
								"<tr id='"+video.videoID+"'>"+
									"<td>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td>"+
										video.videoName+
									"</td>"+
									"<td>"+
										video.time+
									"</td>"+
									"<td>"+
										"<div id='Rating_"+video.videoID+"' data-number='"+video.rating+"' >"+
										
										"</div>"+
									"</td>"+
								"</tr>"
							);
							
							$("#Rating_"+video.videoID).raty({
								path:"system/js/raty/lib/images",
								score:video.rating,
								click: function(score) {
									setRating(video.videoID,score);
								},
							});
						
						});								
					}			
				});
			}
			else if(mode=="rent"){			
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"rent"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='buy_list'>"+
								"<tr>"+
									"<td>"+
										"圖片"+
									"</td>"+
									"<td>"+
										"影片名稱"+
									"</td>"+
									"<td>"+
										"起租時間"+
									"</td>"+
									"<td>"+
										"到期時間"+
									"</td>"+
									"<td>"+
										"評價"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("video").each(function(){
						
							var video={
								videoID:$(this).children("videoID").text(),
								videoName:$(this).children("videoName").text(),
								startTime:$(this).children("startTime").text(),
								endTime:$(this).children("endTime").text(),
								rating:$(this).children("rating").text()
							};
							console.log(video);
							$("#buy_list").append(
								"<tr id='"+video.videoID+"'>"+
									"<td>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td>"+
										video.videoName+
									"</td>"+
									"<td>"+
										video.startTime+
									"</td>"+
									"<td>"+
										video.endTime+
									"</td>"+
									"<td>"+
										"<div id='Rating_"+video.videoID+"' data-number='"+video.rating+"' >"+
										
										"</div>"+
									"</td>"+
								"</tr>"
							);
						
							$("#Rating_"+video.videoID).raty({
								path:"system/js/raty/lib/images",
								score:video.rating,
								click: function(score) {
									setRating(video.videoID,score);
								},
							});
							
						});						
					}			
				});
			}
			else if(mode=="member"){
		
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"member"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='member_data_table'>"+
								"<tr>"+
									"<td>"+
										"帳號名稱"+
									"</td>"+
									"<td>"+
										"使用者名稱"+
									"</td>"+
									"<td>"+
										"性別"+
									"</td>"+
									"<td>"+
										"生日"+
									"</td>"+
									"<td>"+
										"帳戶餘額"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("member").each(function(){
						
							var member={
								userID:$(this).children("userID").text(),
								account:$(this).children("account").text(),
								userName:$(this).children("userName").text(),
								gender:$(this).children("gender").text(),
								birthday:$(this).children("birthday").text(),
								depositSum:$(this).children("depositSum").text()
								
							};
							console.log(member);
							$("#member_data_table").append(
								"<tr id='"+member.userID+"'>"+
									"<td>"+
										member.account+
									"</td>"+
									"<td>"+
										member.userName+
									"</td>"+
									"<td>"+
										member.gender+
									"</td>"+
									"<td>"+
										member.birthday+
									"</td>"+
									"<td>"+
										member.depositSum+
									"</td>"+
								"</tr>"
							);
						
						});						
					}			
				});
			}
		}
		
		function setRating(videoID,score){
		
			$.ajax({
				async: true,
				type: "post",
				url: "./ajax/setrating.php",
				dataType: "xml",
				data:{
					score:score,
					videoID:videoID
				},
				success: function(response){
				
				}
			});
		
		}
	</script>	
	</head>

	<body>
		<div id="content_wrapper">

			<!-- header -->
			<?php 
				include_once "header.php"; 
				
			?>	
			<div id="member_page">
				<div id="member_option_row">
					<div id="wanted_list_option" class="member_option_item get_list_item">
						願望清單
					</div>
					<div id="buy_list_option" class="member_option_item get_list_item">
						購買清單
					</div>
					<div id="rent_list_option" class="member_option_item get_list_item">
						租借清單
					</div>
					<div id="get_info_option" class="member_option_item get_info_item">
						會員資料
					</div>
				</div>
				<div id="member_interface">
					請選擇
				</div>
			</div>
			<?php 
				//include_once "footer	.php"; 
			?>	
		</div>
	</body>
</html>