<script type="text/javascript" src="js/jquery-1.9.1.min.js"></script>

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
	<div id="logo">
		<a href="index.php"><img alt="大內藝術節" src="img/Web_logo.png" height="100"></a>
	</div>
	<div class="top_category">
		<a href="abouts.php">
			<div class="top_category_item">
				關於
				<br>
				ABOUT
			</div>
			<div class="category_bar"></div>
		</a>
	</div>
	<div class="top_category">
		<a href="map.php">
			<div class="top_category_item">
				TAD 地圖
				<br>
				TAD MAP
			</div>
			<div class="category_bar"></div>
		</a>
	</div>
	<div id="activities" class="top_category">
		<div class="top_category_item">
			活動
			<br>
			ACTIVITIES
		</div>
		<div class="category_bar"></div>
		<!--活動下拉式選單-->
		<div id="active_list" class="active_list" >
			<a href="theme_exhibit.php">
				<div class="active_list_item">
					年度主題展
				</div>
			</a>
			<a href="guide.php">
				<div class="active_list_item">
				藝術導覽
				</div>
			</a>
			<a href="workshop.php">
				<div class="active_list_item">
					大內講堂
				</div>
			</a>
		</div>
	</div>
	<div class="top_category">
		<a href="news.php">
			<div class="top_category_item">
				媒體報導
				<br>
				ARTICLES
			</div>
			<div class="category_bar"></div>
		</a>
	</div>
</div>



