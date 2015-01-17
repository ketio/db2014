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
	#signIn_text{
		width: 200px;
		height: 30px;
		background-color: rgb(228, 228, 228);
		padding-top: 20px;
		padding-right: 15px;
		padding-bottom: 3px;
		text-align: right;
		text-decoration: underline;
		font-size: 25px;
		font-family: Verdana, Geneva, sans-serif;
		font-weight: bold;
	}
	#login_interface{
		padding-top: 40px;
		padding-left: 80px;
		width: 500px;
		height: 450px;
		border-left-style: dashed;
		border-left-width: 2px;
		margin-left: auto;
		margin-right: 70px;
	}
	#login_page{
		background:white;
		height:1000px;
	}
	#login_text{
		height: 20px;
		width: 150px;
		background-color: black;
		margin-left: auto;
		margin-right: 5px;
		margin-top:5px;
		margin-bottom:5px;
		color: white;
		font-family: 微軟正黑體;
		text-align: center;
		vertical-align: middle;
	}
	.text_css{
		font-family: Arial, Tahoma, 微軟正黑體;
		text-align: right;
		line-height: 300%;
	}

	</style>


	<body>
		<div id="content_wrapper">
			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="login_page" >
				<div style="height: 50px;">
				</div>
				<div id="login_interface">
					<div id="signIn_text">
						&nbsp&nbsp REGISTER
					</div>
					<div class="text_css">
						ACCOUNT | 會員帳號
						<input>
						</input>
					</div>
					<div class="text_css">
						PASSWORD | 登入密碼
						<input>
						</input>
					</div>
					<div class="text_css">
						USERNAME | 會員名稱
						<input>
						</input>
					</div>
					<div class="text_css">
						GENDER | 性別
						<input>
						</input>
					</div>
					<div class="text_css">
						BIRTHDAY | 生日
						<input>
						</input>
					</div>
					<div id="login_text">
						確認申請
					</div>
				</div>
				
			</div>
		</div>
	</body>

</html>