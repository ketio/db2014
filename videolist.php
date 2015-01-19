<?php 
	include_once "./system/session.php"; 
?>	
<?php
	$videoTypeName=$_GET["vediotypename"];
	
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script src="system/js/jquery-1.11.2.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/videolist.css"/>
	<script type="text/javascript" src="system/js/raty/lib/jquery.raty.js"></script>
	<link type="text/css" rel="stylesheet" href="system/js/raty/lib/jquery.raty.css"/>
	
	<script>
		var videoTypeName = <?php echo "'".$videoTypeName."'";  ?>;
		if(videoTypeName=="movie"){
			videoTypeName="電影";
		}else if(videoTypeName=="animax"){
			videoTypeName="動畫";
		}else if(videoTypeName=="tvseries"){
			videoTypeName="影集";
		}
		orderBy="default";
		
		
		$(document).ready(function () {
			$(".orderByItem[orderByValue='"+orderBy+"']").addClass("orderByItem_choose");
		
			getVideoList(videoTypeName,"default",orderBy);
			
			$(".orderByItem").click(function(){
				$(".orderByItem[orderByValue='"+orderBy+"']").removeClass("orderByItem_choose");				
				orderBy = $(this).attr("orderByValue");
				$(this).addClass("orderByItem_choose");
				getVideoList(videoTypeName,"default",orderBy);
			});
			
			$("#toTheTop").click(function(){
				 $("html, body").animate({
					 scrollTop:0
				 },100);
			});
			
		});
				
		function getVideoList(videoTypeName,videoTypeMode,orderBy){
					
			$.ajax({
				async: true,
				type: "post",
				url: "ajax/getvideo.php",
				dataType: "xml",
				data:{
					videoTypeName:videoTypeName,
					videoTypeMode:videoTypeMode,
					orderBy:orderBy,
					mode:"list",
				},
				success: function(response){
				
					$("#videolist_interface").empty();
					//alert($(response).find("result").text());
					console.log(response);
					
					$(response).find("video").each(function(){
			
						var video={
							videoID:$(this).children("videoID").text(),
							videoName:$(this).children("videoName").text(),
							videoType:$(this).children("videoType").text(),
							rentPrice:$(this).children("rentPrice").text(),
							buyPrice:$(this).children("buyPrice").text(),
							publishDate:$(this).children("publishDate").text(),
							publisher:$(this).children("publisher").text(),
							lang:$(this).children("lang").text(),
							intro:$(this).children("intro").text(),
							rating:$(this).children("rating").text()
						}
						
						$("#videolist_interface").append(
							"<div class='videolist_item'>"+
								"<div class='video_rating_star_cell' id='Rating_"+video.videoID+"' data-number='"+video.rating+"' ></div>"+
								"<div class='videolist_item_image_cell'>"+
									"<a href='video.php?videoid="+video.videoID+"'>"+
										"<img class='videolist_item_image' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</a>"+
								"</div>"+
								"<div class='videolist_item_name'>"+video.videoName+"</div>"+
								"<div class='videolist_item_price'>"+
									"<div class='videolist_item_rentPrice'>售&nbsp;NT."+video.buyPrice+" 元</div>"+
									"<div class='videolist_item_buyPrice'>租&nbsp;NT."+video.rentPrice+" 元</div>"+
								"</div>"+
							"</div>"
						);	
						
						if(video.rating==0){
							$("#Rating_"+video.videoID).append(
								"<img alt='1' src='system/js/raty/lib/images/star-no.png' title='regular'>"+
								"<img alt='2' src='system/js/raty/lib/images/star-no.png' title='regular'>"+
								"<img alt='3' src='system/js/raty/lib/images/star-no.png' title='regular'>"+
								"<img alt='4' src='system/js/raty/lib/images/star-no.png' title='regular'>"+
								"<img alt='5' src='system/js/raty/lib/images/star-no.png' title='regular'>"							
							);
						}
						else{
							$("#Rating_"+video.videoID).raty({
								path:"system/js/raty/lib/images",
								readOnly: true,
								half: true,
								score:video.rating,
							});		
						}
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
			<div id="videolist_page">
				<div id="orderByrow">
					<div class="orderByItem" orderByValue="default">預設排序</div> | 
					<div class="orderByItem" orderByValue="rating">依評價排序</div> | 
					<div class="orderByItem" orderByValue="buyPrice">依價格排序</div> | 
					<div class="orderByItem" orderByValue="having">依購買人次</div> | 
					<div class="orderByItem" orderByValue="publishDate">依出版時間</div> 
				</div>
				<div id="videolist_interface">
					
				</div>
				<div id="toTheTop"></div>
			</div>
			<?php 
				include_once "footer.php"; 
			?>	
		</div>
	</body>
</html>