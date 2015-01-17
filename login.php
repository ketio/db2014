<?php 
	include_once "./system/session.php"; 
?>	
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/login.css"/>	
	</head>
	<script>
		$(document).ready(function () {
			$("#login_text").click(function(){
				$("#login_form").submit();			
			});
		});
	</script>
	<body>
		<div id="content_wrapper">
			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="login_page" >
				<div style="height: 100px;">
				</div>
				<div id="login_interface">
					<form id="login_form" action="login_handle.php" method="post">
						<div id="signIn_text">
							&nbsp;&nbsp; SIGN IN
						</div>
						<div class="text_css">
							ACCOUNT | 會員帳號
							<input type="text" name="account"> </input>
						</div>
						<div class="text_css">
							PASSWORD | 會員密碼
							<input type="text" name="password"> </input>
						</div>
						<input type="hidden" name="mode" value="login"> </input>
						<div id="login_text">
							登入
						</div>
					</form>
				</div>
				
			</div>
		</div>
	</body>

</html>