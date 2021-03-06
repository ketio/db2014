<?php 
	include_once "./system/session.php"; 
	
	if(!isset($_SESSION["user"])){
		echo
			"<script>".
				"window.location.replace('/db2014/login.php');".
			"</script>";
		exit;
	}else{
		$userID=$_SESSION["user"]["userID"];
	}
?>	
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>NTUIM CLOULD THEATER雲端影城</title>
	<script type="text/javascript" src="system/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="system/js/raty/lib/jquery.raty.js"></script>
	<link type="text/css" rel="stylesheet" href="system/js/raty/lib/jquery.raty.css"/>
	<link type="text/css" rel="stylesheet" href="css/member.css"/>

	
	
	<script>
		var userID=<?php echo "'".$userID."'"; ?>;
		
		var optionValue="wanted";
		
		$(document).ready(function(){
		
			get_list(optionValue);		
			$(".member_option_item[optionValue='"+optionValue+"']").addClass("member_option_item_choose");
			
			$(".member_option_item").click(function(){			
				$(".member_option_item[optionValue='"+optionValue+"']").removeClass("member_option_item_choose");				
				optionValue = $(this).attr("optionValue");
				$(this).addClass("member_option_item_choose");
				get_list(optionValue);
			});
			$("#toTheTop").click(function(){
				 $("html, body").animate({
					 scrollTop:0
				 },100);
			});
		});
		
		function get_list(mode){
			$("#member_interface").empty();
			if(mode=="wanted"){
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"wanted"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='wanted_list' class='video_list_table'>"+
								"<tr class='video_list_table_row video_list_table_title'> "+
									"<td class='video_list_table_title_img'>"+
										"圖片"+
									"</td>"+
									"<td class='video_list_table_title_name'>"+
										"影片名稱"+
									"</td>"+
									"<td class='video_list_table_title_date'>"+
										"加入時間"+
									"</td>"+
									"<td class='video_list_table_title_delete'>"+
										"刪除"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("video").each(function(){
						
							var video={
								videoID:$(this).children("videoID").text(),
								videoName:$(this).children("videoName").text(),
								time:$(this).children("time").text()
							};
							console.log(video);
							$("#wanted_list").append(
								"<tr id='"+video.videoID+"' class='video_list_table_row'>"+
									"<td class='video_list_table_cell'>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										"<a href='video.php?videoid="+video.videoID+"' >"+
											video.videoName+
										"</a>"+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										video.time.substr(0, 10)+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										"<div class='video_list_table_delete_button' videoid='"+video.videoID+"'>"+
											"刪除"+
										"</div>"+
									"</td>"+
								"</tr>"
							);
						
						});		

						$(".video_list_table_delete_button").click(function(){
							var videoID=$(this).attr("videoid");
							deleteWanted(videoID);
						});
					}					
				});
			}
			else if(mode=="buy"){
			
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"buy"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='buy_list' class='video_list_table'>"+
								"<tr class='video_list_table_row video_list_table_title'>"+
									"<td class='video_list_table_title_img'>"+
										"圖片"+
									"</td>"+
									"<td class='video_list_table_title_name'>"+
										"影片名稱"+
									"</td>"+
									"<td class='video_list_table_title_date'>"+
										"購買時間"+
									"</td>"+
									"<td class='video_list_table_title_stars'>"+
										"評價"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("video").each(function(){
						
							var video={
								videoID:$(this).children("videoID").text(),
								videoName:$(this).children("videoName").text(),
								time:$(this).children("time").text(),
								rating:$(this).children("rating").text(),
							};
							
							$("#buy_list").append(
								"<tr id='"+video.videoID+"' class='video_list_table_row'>"+
									"<td class='video_list_table_cell'>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										"<a href='video.php?videoid="+video.videoID+"' >"+
											video.videoName+
										"</a>"+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										video.time.substr(0, 10)+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										"<div id='Rating_"+video.videoID+"' data-number='"+video.rating+"' >"+
										
										"</div>"+
									"</td>"+
								"</tr>"
							);
							
							$("#Rating_"+video.videoID).raty({
								path:"system/js/raty/lib/images",
								score:video.rating,
								click: function(score) {
									setRating(video.videoID,score);
								},
							});
						
						});								
					}			
				});
			}
			else if(mode=="rent"){			
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"rent"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<table id='buy_list' class='video_list_table'>"+
								"<tr class='video_list_table_row video_list_table_title'>"+
									"<td class='video_list_table_title_img'>"+
										"圖片"+
									"</td>"+
									"<td class='video_list_table_title_name'>"+
										"影片名稱"+
									"</td>"+
									"<td class='video_list_table_title_date'>"+
										"起租時間"+
									"</td>"+
									"<td class='video_list_table_title_date'>"+
										"到期時間"+
									"</td>"+
									"<td class='video_list_table_title_stars'>"+
										"評價"+
									"</td>"+
								"</tr>"+
							"</table>"					
						);
									

						$(response).find("video").each(function(){
						
							var video={
								videoID:$(this).children("videoID").text(),
								videoName:$(this).children("videoName").text(),
								startTime:$(this).children("startTime").text(),
								endTime:$(this).children("endTime").text(),
								rating:$(this).children("rating").text()
							};
							console.log(video);
							$("#buy_list").append(
								"<tr id='"+video.videoID+"' class='video_list_table_row'>"+
									"<td class='video_list_table_cell'>"+
										"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										"<a href='video.php?videoid="+video.videoID+"' >"+
											video.videoName+
										"</a>"+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										video.startTime.substr(0, 10)+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										video.endTime.substr(0, 10)+
									"</td>"+
									"<td class='video_list_table_cell'>"+
										"<div id='Rating_"+video.videoID+"' data-number='"+video.rating+"' >"+
										"</div>"+
									"</td>"+
								"</tr>"
							);
						
							$("#Rating_"+video.videoID).raty({
								path:"system/js/raty/lib/images",
								score:video.rating,
								click: function(score) {
									setRating(video.videoID,score);
								},
							});
							
						});						
					}			
				});
			}
			else if(mode=="member"){
		
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						mode:"member"
					},
					success: function(response){
						console.log(response);
						$("#member_interface").empty();
						$("#member_interface").append(
							"<div id='member_interface_div'>"+
								"<table id='member_data_table'>"+
									"<tr>"+
										"<th colspan=2 id='member_data_table_memberData'>會員資料</th>"+
									"</tr>"+
									"<tr class='member_data_table_row member_data_table_row_odd'>"+
										"<td class='member_data_table_col_fst'>帳號名稱</td>"+
										"<td id='member_account' class='member_data_table_col_snd'></td>"+
									"</tr>"+	
									"<tr class='member_data_table_row member_data_table_row_even'>"+								
										"<td class='member_data_table_col_fst'>使用者名稱</td>"+
										"<td id='member_userName' class='member_data_table_col_snd'></td>"+
									"</tr>"+	
									"<tr class='member_data_table_row member_data_table_row_odd'>"+
										"<td class='member_data_table_col_fst'>性別"+
										"</td><td id='member_gender' class='member_data_table_col_snd'></td>"+
									"</tr>"+	
									"<tr class='member_data_table_row member_data_table_row_even'>"+
										"<td class='member_data_table_col_fst'>生日</td>"+
										"<td id='member_birthday' class='member_data_table_col_snd'></td>"+
									"</tr>"+	
									"<tr class='member_data_table_row member_data_table_row_odd'>"+
										"<td class='member_data_table_col_fst'>帳戶餘額</td>"+
										"<td id='member_depositSum' class='member_data_table_col_snd'><td></td>"+
									"</tr>"+
								"</table>"+
								"<div id='member_data_table_revise_button_interface'>"+
									"<div id='member_data_table_revise_button' class='member_data_table_button'>"+
										"更改會員資料"+
									"</div>"+
								"</div>"+
							"</div>"
						);
									

						$(response).find("member").each(function(){
						
							var member={
								userID:$(this).children("userID").text(),
								account:$(this).children("account").text(),
								userName:$(this).children("userName").text(),
								gender:$(this).children("gender").text(),
								birthday:$(this).children("birthday").text(),
								depositSum:$(this).children("depositSum").text()
								
							};
							$("#member_account").append(member.account);
							$("#member_userName").append(member.userName);
							$("#member_gender").append(member.gender);
							$("#member_birthday").append(member.birthday.substr(0,10));
							$("#member_depositSum").append(member.depositSum);
						
						});				

						$("#member_data_table_revise_button").click(function(){
							var userName=$("#member_userName").html();
							$("#member_userName").html(
								"<input id='member_userName_input' type='text' name='userName' value='"+userName+"' size='6'>"
							);
							$("#member_data_table_revise_button_interface").html(
								"<div id='member_data_table_revise_check_button' class='member_data_table_button'>"+
									"保存變更"+
								"</div>"+
								"<div id='member_data_table_revise_cancle_button'class='member_data_table_button'>"+
									"取消變更"+
								"</div>"
							);
							
							$("#member_data_table_revise_cancle_button").click(function(){
								get_list("member");
							});
							$("#member_data_table_revise_check_button").click(function(){
								reviseMemberData();
							});
						});
					}			
				});
			}
		}
		
		function reviseMemberData(){
			
						
			$.ajax({
				async: true,
				type: "post",
				url: "./ajax/memberdata.php",
				dataType: "xml",
				data:{
					userName:$("#member_userName_input").val(),
					mode:"revise",
				},
				success: function(response){
					alert("修改成功");
					get_list("member");
				}
			});
		
			get_list("member");
		}
		function deleteWanted(videoID){
			if(confirm("確認刪除?")){
				$.ajax({
					async: true,
					type: "post",
					url: "./ajax/memberdata.php",
					dataType: "xml",
					data:{
						videoID:videoID,
						mode:"deleteWanted"
					},
					success: function(response){
						alert("刪除成功");
						get_list("wanted");
					}
				});	
			}
		}
		function setRating(videoID,score){
		
			$.ajax({
				async: true,
				type: "post",
				url: "./ajax/setrating.php",
				dataType: "xml",
				data:{
					score:score,
					videoID:videoID
				},
				success: function(response){
				
				}
			});
		
		}
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
					<div id="wanted_list_option" class="member_option_item get_list_item" optionValue="wanted">
						願望清單
					</div>&nbsp;|
					<div id="buy_list_option" class="member_option_item get_list_item" optionValue="buy">
						購買清單
					</div>&nbsp;|
					<div id="rent_list_option" class="member_option_item get_list_item" optionValue="rent">
						租借清單
					</div>&nbsp;|
					<div id="get_info_option" class="member_option_item get_info_item" optionValue="member">
						會員資料
					</div>
				</div>
				<div id="member_interface">
					請選擇
				</div>
				<div id="toTheTop"></div>
			</div>
			<?php 
				include_once "footer.php"; 
			?>	
		</div>
	</body>
</html>