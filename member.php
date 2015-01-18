<?php 
	include_once "./system/session.php"; 
	
	if(!isset($_SESSION["user"])){
		echo
			"<script>".
				"window.location.replace('/db2014/login.php');".
			"</script>";
	}
?>	
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/member.css"/>
	
	<script>
		$(document).ready(function () {

		});
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
					<div id="" class="member_option_item get_list_item">
						願望清單
					</div>
					<div id="" class="member_option_item get_list_item">
						購買清單
					</div>
					<div id="" class="member_option_item get_list_item">
						租借清單
					</div>
					<div id="" class="member_option_item get_info_item">
						會員資料
					</div>
				</div>
			
			
			
			</div>
			<?php 
				//include_once "footer	.php"; 
			?>	
		</div>
	</body>
</html>