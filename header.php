<link type="text/css" rel="stylesheet" href="css/common.css"/>
<script>
$(document).ready(function(){
	$("#logout").click(function(){
		$("#logout_form").submit();			
	});
	$("#header_search_button").click(function(){
		$("#header_search_form").submit();			
	});
	
	$("#header_search_input").focus(function(){
		if($(this).val()=="請輸入影片名稱"){
			$(this).val("");
		}
		$(this).addClass("header_search_input_focus");
	});
	$("#header_search_input").blur(function(){
		
		if($(this).val()==""){
			$(this).val("請輸入影片名稱");
		}
		$(this).removeClass("header_search_input_focus");
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
		<?php } else {?>	
			<div class="header1_item float_right">
				<a href="login.php">立即登入</a>
			</div>
			<div class="header1_item float_right">&nbsp;|&nbsp;</div>
			<div class="header1_item float_right">
				<a href="register.php">註冊會員</a>
			</div>
			<div class="header1_item float_right">&nbsp;|&nbsp;</div>		
		<?php }?>			
		
		<div id="header_search_block">
			<form id="header_search_form" action="search.php" method="GET" >
				<select id="searchBy" name="searchBy">
					<option value="videoName">名稱</option>
					<option value="videoType">類型</option>
					<option value="publisher">出版</option>	
					<option value="lang">語言</option>					
				</select>
				<img id="search_icon" src="data/spotlight001.png"/>
				<input id="header_search_input" class="header_search_input" type="text" name="keyword" value="請輸入影片名稱">
				<div id="header_search_button">
					SEARCH
				</div>
			</form>
		</div>
	</div>
	<div id="header2">
		<div class="header2_item">|</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=tvseries">影集</a>
		</div>
		<div class="header2_item">|</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=movie">電影</a>
		</div>
		<div class="header2_item">|</div>
		<div class="header2_item">
			<a href="videolist.php?vediotypename=animax">動畫</a>
		</div>
		<div class="header2_item">|</div>
	</div>
</div>



