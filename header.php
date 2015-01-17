<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>
<link type="text/css" rel="stylesheet" href="css/common.css"/>
<script>
$(document).ready(function(){
	$("#activities").mouseover(function(){
		$("#active_list").css("visibility","visible");
	});
	
	$("#activities").mouseleave(function(){
		$("#active_list").css("visibility","hidden");
	});

	$(".top_category").hover(function() {
		$(this).find(".top_category_item").addClass("top_category_item_hover");
		$(this).find(".category_bar").addClass("category_bar_hover");	
	  }, function() {
		$(this).find(".top_category_item").removeClass("top_category_item_hover");
		$(this).find(".category_bar").removeClass("category_bar_hover");
	  }
	);
});
</script>

<link type="text/css" rel="stylesheet" href="css/header_style.css"/>
<div id="header">
	<div id="header1">
			願望清單
			<a href="member.php">會員專區</a>

	</div>
	<div id="header2">
			<a href="video.php">動畫</a>
		
			<a href="video.php">電影</a>
	
			<a href="video.php">影集</a>
	
			<a href="rank.php">排行榜</a>
	</div>
</div>



