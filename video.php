<?php 
	include_once "./system/session.php"; 
?>	
<?php
	$videoID=$_GET["videoid"];
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script src="system/js/jquery-1.11.2.min.js"></script>
	<script src="system/js/ui/jquery-ui.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/video.css"/>
	<link type="text/css" rel="stylesheet" href="system/js/ui/jquery-ui.min.css"/>
	
	<script>
		var videoID = <?php echo "'".$videoID."'";  ?>;
		var video;	
		
		$(document).ready(function () {
			getVideo(videoID);
			dialog_set();			
		});
		
		function dialog_set(){
		
			$("#buyDialog").dialog({
				autoOpen: false,
				title: "確認購買",
				buttons: {
					"Ok": function() {
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
			$("#rentDialog").dialog({
				autoOpen: false,
				title: "確認租賃",
				buttons: {
					"Ok": function() {
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
			$("#putDialog").dialog({
				autoOpen: false,
				title: "已放入清單",
				buttons: {
					"Ok": function() {
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
		}
		
		function getVideo(videoID){
			
			$("#video_interface").empty();
			
			$.ajax({
				async: true,
				type: "post",
				url: "ajax/getvideo.php",
				dataType: "xml",
				data:{
					videoID:videoID,
					mode:"item",
				},
				success: function(response){
					//alert($(response).find("result").text());
					console.log(response);
					
					$(response).find("video").each(function(){
			
						video={
							videoID:$(this).children("videoID").text(),
							videoName:$(this).children("videoName").text(),
							videoType:$(this).children("videoType").text(),
							rentPrice:$(this).children("rentPrice").text(),
							buyPrice:$(this).children("buyPrice").text(),
							publishDate:$(this).children("publishDate").text(),
							publisher:$(this).children("publisher").text(),
							lang:$(this).children("lang").text(),
							intro:$(this).children("intro").text()
						}
						
					
						
						$("#video_interface").append(
							"<table id='"+video.videoID +"' class='video_table'>"+
								"<tr>"+
								"<td id='img_"+video.videoID+" class=''>"+
									"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
								"</td>"+
								"<td>"+
									"<div class=''>"+video.videoName +"</div>"+
									"<div class=''>"+video.videoType +"</div>"+
									"<div class=''>"+video.rentPrice +"</div>"+
									"<div class=''>"+video.buyPrice +"</div>"+
									"<div class=''>"+video.publishDate +"</div>"+
									"<div class=''>"+video.publisher +"</div>"+
									"<div class=''>"+video.lang +"</div>"+	
									"<div class=''>"+
										"<div id='buyVideo'>購買</div>"+
										"<div id='rentVideo'>租賃</div>"+
										"<div id='putVideo'>放入清單</div>"+
									"</div>"+
								"</td>"+
								"</tr>"+
							"</div>"
						);				
					});
					
					$("#buyVideo").click(function(){
						$("#buyDialog").dialog("open");
					});									
					$("#rentVideo").click(function(){
						$("#rentDialog").dialog("open");
					});
					$("#putVideo").click(function(){
						$("#putDialog").dialog("open");
					
					});
					
					
					
				}
				
			});
		}
		
	</script>	
	</head>
	
	<style>
	</style>
	
	<body>
		<div id="content_wrapper">

			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="video_page">
				<div id="video_interface">
					
				</div>
				<div id = "dialogs">
					<div id = "buyDialog"></div>
					<div id = "rentDialog"></div>
					<div id = "putDialog"></div>
				</div>
			</div>
			<?php 
				//include_once "footer	.php"; 
			?>	
		</div>
	</body>
</html>