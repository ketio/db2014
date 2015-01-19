<?php 
	include_once "./system/session.php"; 
?>	
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/register.css"/>
	
	<script>
		$(document).ready(function () {

		});
	</script>	
	</head>

	<style>
	#register_text{
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
	#register_interface{
		padding-top: 40px;
		padding-left: 80px;
		width: 500px;
		height: 450px;
		border-left-style: dashed;
		border-left-width: 2px;
		margin-left: auto;
		margin-right: 70px;
	}
	#register_page{
		background:white;
		height:1000px;
	}
	#confirm_text{
		height: 23px;
		width: 150px;
		background-color: black;
		margin-left: auto;
		margin-right: 5px;
		margin-top:5px;
		margin-bottom:5px;
		color: white;
		font-family: 微軟正黑體;
		text-align: center;
		line-height: 23px;
		
		cursor:pointer;
	}
	.text_css{
		font-family: Arial, Tahoma, 微軟正黑體;
		text-align: right;
		line-height: 300%;
	}
	</style>
	<script>
		$(document).ready(function () {
			$("#confirm_text").click(function(){
				$("#register_form").submit();			
			});
		});
	</script>

	<body>
		<div id="content_wrapper">
			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="register_page" >
				<div style="height: 50px;">
				</div>
				<div id="register_interface">
					<form id="register_form" action="register_handle.php" method="post">
						<div id="register_text">
							REGISTER
						</div>
						<div class="text_css" style="margin-top:10px">
							ACCOUNT | 會員帳號
							<input type="text" name="account">
							</input>
						</div>
						<div class="text_css" >
							PASSWORD | 登入密碼
							<input type="text" name="password">
							</input>
						</div>
						<div class="text_css">
							USERNAME | 會員名稱
							<input type="text" name="username">
							</input>
						</div>
						<div class="text_css">
							GENDER | 性別
							<select id="gender" name="gender" style="width: 175px">
								  <option value="F">女性 Female</option>
								  <option value="N">男性 Male</option>
								  <option value="N">中性 Neutral</option>
								</select>
							</input>
						</div>
						<div class="text_css">
							BIRTHDAY | 生日
							<input id="birthday_y" name="birthday_y" type="text" size=5/>&nbsp;年
							<input id="birthday_m" name="birthday_m" type="text" size=2/>&nbsp;月
							<input id="birthday_d" name="birthday_d" type="text" size=2/>&nbsp;日
						</div>
						<div id="confirm_text">
							確認申請
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</body>

</html>