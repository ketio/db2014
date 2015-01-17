<link type="text/css" rel="stylesheet" href="css/common.css"/>
<script>
$(document).ready(function(){
	$("#logout").click(function(){
		$("#logout_form").submit();			
	});
});
</script>

<div id="header">
	<div id="header1">
		<div class="header1_logo float_left">
			<a href="index.php">首頁LOGO</a>
		</div>
		<div class="header1_item float_right">
			願望清單
		</div>
		<div class="header1_item float_right">
			<a href="member.php">會員專區</a>
		</div>
		
		<?php if(isset($_SESSION["user"])){	?>
			<form id="logout_form" action="login_handle.php" method="post">
				<input type="hidden" name="mode" value="logout"> </input>
			</form>
			<div  id="logout" class="header1_item float_right">
				登出
			</div>
			<div class="header1_item float_right">
				<?php echo $_SESSION["user"]["userName"]; ?> 你好 &nbsp;
			</div>	
		<?php } ?>		

	</div>
	<div id="header2">
		<div class="header2_item">
			<a href="videolist.php?vediotypename=animax">動畫</a>
		</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=movie">電影</a>
		</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=tvseries">影集</a>
		</div>
		<div class="header2_item">	
			<a href="rank.php">排行榜</a>
		</div>
	</div>
</div>



