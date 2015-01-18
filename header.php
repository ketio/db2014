<link type="text/css" rel="stylesheet" href="css/common.css"/>
<script>
$(document).ready(function(){
	$("#logout").click(function(){
		$("#logout_form").submit();			
	});
	
	
	$("#header_search_input").focus(function(){
		if($(this).val()=="請輸入影片名稱"){
			$(this).val("");
		}
	});
	$("#header_search_input").blur(function(){
		
		if($(this).val()==""){
			$(this).val("請輸入影片名稱");
		}
	});
});
</script>

<div id="header">
	<div id="header1">
		<div class="header1_logo float_left">
			<a href="index.php"><img id="title_logo" src="data/title.png"/></a>
		</div>
		<div class="header1_item float_right">&nbsp;|&nbsp;&nbsp;&nbsp;</div>
		<div class="header1_item float_right">
			<a href="member.php">會員專區</a>
		</div>
		<div class="header1_item float_right">&nbsp;|&nbsp;</div>
		
		<?php if(isset($_SESSION["user"])){	?>
			<form id="logout_form" action="login_handle.php" method="post">
				<input type="hidden" name="mode" value="logout"> </input>
			</form>
			<div  id="logout" class="header1_item float_right">
				登出
			</div>
			<div class="header1_item float_right">&nbsp;|&nbsp;</div>
			<div class="header1_item float_right">
				<?php echo $_SESSION["user"]["userName"]; ?> ，你好！ &nbsp; 
			</div>	
		<?php } ?>		
		
		<div id="header_search_block">
			<input id="header_search_input" type="text" name="fname" value="請輸入影片名稱">
			<div id="header_search_button">
				SEARCH
			</div>
		</div>
	</div>
	<div id="header2">
		<div class="header2_item">|</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=animax">動畫</a>
		</div>
		<div class="header2_item">|</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=movie">電影</a>
		</div>
		<div class="header2_item">|</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=tvseries">影集</a>
		</div>
		<div class="header2_item">|</div>
		<div class="header2_item">	
			<a href="rank.php">排行榜</a>
		</div>
		<div class="header2_item">|</div>
	</div>
</div>



