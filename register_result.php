<?php 
	include_once "./system/session.php"; 
?>	
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min"></script>
	<link type="text/css" rel="stylesheet" href="css/register_result.css"/>
	
	<script>
		$(document).ready(function (){

		});
	</script>	
	<style>
		#register_result_page{
			margin:0 auto;
			width:100%;
			height:400px;
			background:white;
		}
		#register_success_interface{
			text-align:center;
			padding-top:100px;
		}
		#register_success_link_block{
			margin-top:20px;
		}
		
	</style>
	</head>

	<body>
		<div id="content_wrapper">

			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="register_result_page">
				<div id="register_success_interface">
					<div>感謝您的註冊，新會員將免費享有一千元購物金。</div>
					<div id="register_success_link_block">
						<a href="index.php">
							返回首頁
						</a>
					</div>
				</div>
			</div>
			<?php 
				include_once "footer.php"; 
			?>	
		</div>
	</body>
</html>