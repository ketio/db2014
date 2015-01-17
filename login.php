<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min"></script>
	<link type="text/css" rel="stylesheet" href="css/login.css"/>
	
	<script>
		$(document).ready(function () {

		});
	</script>	
	</head>

	<style>
	#title{
		width: 150px;
		height: 30px;
		background-color: rgb(179, 178, 178);
		
		text-align: right;
		font-size: 25px;
		font-family: Arial, Tahoma;
	}
	#login_page{
		background:white;
		height:1000px;
	}

	</style>


	<body>
		<div id="content_wrapper">
			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="login_page">
				<div style="width: 500px; height: 400px">
					<div id="title">
						Sign In
					</div>
					
					<div>
						ACCOUNT | 會員帳號
						<input>
						</input>
					</div>
					<div>
						PASSWORD | 會員密碼
						<input>
						</input>
					</div>
					<div>
						登入
					</div>
				</div>
			</div>
		</div>
	</body>

</html>