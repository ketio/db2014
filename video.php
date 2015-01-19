<?php 
	include_once "./system/session.php"; 
	$isLogin=0;
	if(isset($_SESSION["user"])){
		$isLogin=1;
	}
?>	
<?php
	$videoID=$_GET["videoid"];
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script src="system/js/jquery-1.11.2.min.js"></script>
	<script src="system/js/ui/jquery-ui.min.js"></script>
	<link type="text/css" rel="stylesheet" href="css/video.css"/>
	<link type="text/css" rel="stylesheet" href="system/js/ui/jquery-ui.min.css"/>
	
	<script>
		var videoID = <?php echo "'".$videoID."'";  ?>;
		var isLogin = <?php echo $isLogin; ?>;
		var video;	
		
		var sending = null;
		
		$(document).ready(function () {
			getVideo(videoID);			
		});
		
		function dialog_set(){

			$("#buyDialog").dialog({
				autoOpen: false,
				title: "確認購買",
				close: function(){
					$(".mask").css({"display":"none"});
				},
			});
			$("#rentDialog").dialog({
				autoOpen: false,
				title: "確認租賃",
				close: function(){
					$(".mask").css({"display":"none"});
				},
			});
			$("#putDialog").dialog({
				autoOpen: false,
				title: "放入清單確認",
				close: function(){
					$(".mask").css({"display":"none"});
				},
			});
			
			$(".dialogCancle").click(function(){
				$(".transactionDialog").dialog("close");
			});
			
			$("#buyConfirm").click(function(){
				$(this).unbind("click");
				
				if (sending !== null) {
					clearTimeout(sending);
					sending = null;
				}
				sending = setTimeout(function(){
					$.ajax({
						async: true,
						type: "post",
						url: "ajax/videotransaction.php",
						dataType: "xml",
						data:{
							videoID:videoID,
							mode:"buy",
						},
						success: function(response){
							console.log(response);
							var result=$(response).find("result").text()
							if(result=="SUCCESS"){
								$("#buyDialog").empty();
								$("#buyDialog").append(
									"購買成功"+
									"<table>"+
										"<tr>"+
											"<td>會員名稱</td>"+
											"<td>"+$(response).find("userName").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>原儲值金額</td>"+
											"<td>"+$(response).find("depositSum").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>購買商品</td>"+
											"<td>"+$(response).find("videoName").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>商品價錢</td>"+
											"<td>"+$(response).find("buyPrice").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>剩餘儲值金額</td>"+
											"<td>"+$(response).find("retainDeposit").text()+"</td>"+
										"</tr>"+		
									"</table>"+
									"<div class='transactionConfirm dialogConfirm'>確認</div>"
								);
								
								$(".transactionConfirm").click(function(){
									$(".transactionDialog").dialog("close");
								});		
								
							}
							else if(result=="FAIL"){
								$("#buyDialog").empty();
								$("#buyDialog").append(
									"<div>"+$(response).find("reason").text()+"</div>"								
								);
							}
							getVideo(videoID);
						}
					});	
				}, 300);
			});
			
			$("#rentConfirm").click(function(){
				$(this).unbind("click");
				
				if (sending !== null) {
					clearTimeout(sending);
					sending = null;
				}
				sending = setTimeout(function(){
					$.ajax({
						async: true,
						type: "post",
						url: "ajax/videotransaction.php",
						dataType: "xml",
						data:{
							videoID:videoID,
							mode:"rent",
						},
						success: function(response){
							console.log(response);
							var result=$(response).find("result").text()
							if(result=="SUCCESS"){
								$("#rentDialog").empty();
								$("#rentDialog").append(
									"租借成功"+
									"<table>"+
										"<tr>"+
											"<td>會員名稱</td>"+
											"<td>"+$(response).find("userName").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>原儲值金額</td>"+
											"<td>"+$(response).find("depositSum").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>租借商品</td>"+
											"<td>"+$(response).find("videoName").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>租借時間</td>"+
											"<td>"+$(response).find("startTime").text().substr(0,10)+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>到期時間</td>"+
											"<td>"+$(response).find("endTime").text().substr(0,10)+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>商品價錢</td>"+
											"<td>"+$(response).find("rentPrice").text()+"</td>"+
										"</tr>"+
										"<tr>"+
											"<td>剩餘儲值金額</td>"+
											"<td>"+$(response).find("retainDeposit").text()+"</td>"+
										"</tr>"+		
									"</table>"+
									"<div class='transactionConfirm dialogConfirm'>確認</div>"
								);
								
								$(".transactionConfirm").click(function(){
									$(".transactionDialog").dialog("close");
								});						
							}
							else if(result=="FAIL"){
								$("#buyDialog").append(
									"<div>"+$(response).find("reason").text()+"</div>"								
								);
							}
							getVideo(videoID);
						}
					});	
				}, 300);
				
			});
		}
		
		function putVideoClick(){		
		
			if (sending !== null) {
				clearTimeout(sending);
				sending = null;
			}
			sending = setTimeout(function(){
				$.ajax({
					async: true,
					type: "post",
					url: "ajax/videotransaction.php",
					dataType: "xml",
					data:{
						videoID:videoID,
						mode:"put",
					},
					success: function(response){
						console.log(response);
						var result=$(response).find("result").text()
						if(result=="SUCCESS"){
							$("#putDialog").empty();
							$("#putDialog").append(
								"已成功將 "+$(response).find("videoName").text()+" 放入願望清單"+
								"<div class='transactionConfirm dialogConfirm'>確認</div>"
							);
								
							$(".transactionConfirm").click(function(){
								$(".transactionDialog").dialog("close");
							});
						}
						else if(result=="FAIL"){
							$("#buyDialog").empty();
							$("#buyDialog").append(
								"<div>"+$(response).find("reason").text()+"</div>"								
							);
						}
						getVideo(videoID);
					}
				});	
			}, 300);
		
		}		
		
		function getVideo(videoID){
			
			$("#video_interface").empty();
			
			$.ajax({
				async: true,
				type: "post",
				url: "ajax/getvideo.php",
				dataType: "xml",
				data:{
					videoID:videoID,
					mode:"item",
				},
				success: function(response){
				
					$("#video_interface").empty();
					//alert($(response).find("result").text());
					console.log(response);
					
					$(response).find("video").each(function(){
			
						video={
							videoID:$(this).children("videoID").text(),
							videoName:$(this).children("videoName").text(),
							videoType:$(this).children("videoType").text(),
							rentPrice:$(this).children("rentPrice").text(),
							buyPrice:$(this).children("buyPrice").text(),
							publishDate:$(this).children("publishDate").text(),
							publisher:$(this).children("publisher").text(),
							lang:$(this).children("lang").text(),
							intro:$(this).children("intro").text(),
							isHaving:$(this).children("isHaving").text(),
							isRent:$(this).children("isRent").text(),
							isPut:$(this).children("isPut").text()
						}
						
						$("#video_interface").append(
							"<table id='"+video.videoID +"' class='video_table'>"+
								"<tr>"+
									"<td id='img_"+video.videoID+" class=''>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td>"+
										"<table class='video_inner_table'>"+
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>影片名稱</td>"+
												"<td class='video_inner_table_cell'>"+video.videoName+"</td>"+
											"</tr>"+
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>影片名稱</td>"+
												"<td class='video_inner_table_cell'>"+video.videoType+"</td>"+
											"</tr>"+
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>購買價格</td>"+
												"<td class='video_inner_table_cell'>"+video.buyPrice+"</td>"+
											"</tr>"+
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>租借價格</td>"+
												"<td class='video_inner_table_cell'>"+video.rentPrice+"</td>"+
											"</tr>"+										
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>出版</td>"+
												"<td class='video_inner_table_cell'>"+video.publisher+"</td>"+
											"</tr>"+
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>出版日期</td>"+
												"<td class='video_inner_table_cell'>"+video.publishDate.substr(0,10)+"</td>"+
											"</tr>"+										
											"<tr class='video_inner_table_row'>"+
												"<td class='video_inner_table_cell video_inner_table_title'>影片語言</td>"+
												"<td class='video_inner_table_cell'>"+video.lang+"</td>"+
											"</tr>"+
										"</table>"+
										"<div class='transaction_row'>"+
											"<div class='transactionButton' id='buyVideo'>購買</div>"+
											"<div class='transactionButton' id='rentVideo'>租借</div>"+
											"<div class='transactionButton' id='putVideo'>放入清單</div>"+
										"</div>"+
									"</td>"+
								"</tr>"+
							"</table>"+
							"<div class='video_intro'>"+video.intro+"</div>"
						);
						
						dialog_set();
						
						if(isLogin==0){
							$(".transactionButton").click(function(){
								alert("請先登入");
							});
						}
						else if(isLogin==1){
						
							if(video.isHaving>=1){
								$("#buyVideo").html("您已經購買此商品");	
							}
							else{								
								$("#buyVideo").click(function(){
									$(".transactionDialog").dialog("close");
									$(".mask").css({"display":"block"});
									$("#buyDialog").dialog("open");
								});		
							}
							
							if(video.isRent>=1){
								$("#rentVideo").html("你已經承租此商品");
							}
							else{
								$("#rentVideo").click(function(){
									$(".transactionDialog").dialog("close");
									$(".mask").css({"display":"block"});
									$("#rentDialog").dialog("open");
								});
							}
							
							if(video.isPut>=1){
								$("#putVideo").html("已將此商品放入清單");
							}
							else{
								$("#putVideo").click(function(){
									$(".transactionDialog").dialog("close");
									$(".mask").css({"display":"block"});
									$(this).unbind("click");
									putVideoClick();
									$("#putDialog").dialog("open");
									
								});
							}

							$(".dialogName").html(video.videoName);
							$("#buyDialogPrice").html(video.buyPrice);
							$("#rentDialogPrice").html(video.rentPrice);
						}
					});		
				}
				
			});
		}
		
	</script>	
	</head>
	
	<style>
	</style>
	
	<body>
		<div id="content_wrapper">
			<div class="mask"></div>
			<!-- header -->
			<?php 
				include_once "header.php"; 
			?>	
			<div id="video_page">
				<div id="video_interface">
					
				</div>
				<div id = "dialogs">
					<div id = "buyDialog" class="transactionDialog">
						<table>
							<tr>
								<td class="dialogTableCell dialogTableCellTitle" >名稱</td>
								<td class="dialogTableCell dialogTableCellContent dialogName" id="buyDialogName" ></td>
							</tr>
							<tr>
								<td class="dialogTableCell dialogTableCellTitle" >價錢</td>
								<td class="dialogTableCell dialogTableCellContent dialogPrice" id="buyDialogPrice" ></td>
							</tr>
							<tr>
								<td><div id="buyConfirm" class="dialogConfirm" >確認</div></td>
								<td><div class="dialogCancle" >取消</div></td>
							</tr>
						</table>
				
					</div>
					<div id = "rentDialog" class="transactionDialog">
						<table>
							<tr>
								<td class="dialogTableCell dialogTableCellTitle" >名稱</td>
								<td class="dialogTableCell dialogTableCellContent dialogName" id="rentDialogName" ></td>
							</tr>
							<tr>
								<td class="dialogTableCell dialogTableCellTitle" >價錢</td>
								<td class="dialogTableCell dialogTableCellContent dialogPrice" id="rentDialogPrice" ></td>
							</tr>
							<tr>
								<td><div id="rentConfirm" class="dialogConfirm" >確認</div></td>
								<td><div class="dialogCancle" >取消</div></td>
							</tr>
						</table>
					</div>		
					
					<div id = "putDialog" class="transactionDialog"></div>
				</div>
			</div>
			<?php 
				//include_once "footer	.php"; 
			?>	
		</div>
	</body>
</html>