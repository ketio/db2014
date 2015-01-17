<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
<script src="./js/jquery.form.min.js"></script>

</head>
<style>
#video_list_table{
	border-collapse:collapse;
}
.video_list_table_cell{
	border:1px solid black;
}
.video_list_table_cell div{
	height:80px;
	width:200px;
	overflow:auto;
	
}
.video_picture{
	width:80px;
	height:80px;
}
</style>

<script>
$(document).ready(function(){

	get_videoType();
	get_publisher();
	
	get_list();

	$("#submit_button").click(function(){
	
		if($("#videoName").val()==""){
			alert("有空白");
		}
		else if($("#rentPrice").val()==""){
			alert("有空白");
		}
		else if($("#buyPrice").val()==""){
			alert("有空白");
		}
		else if($("#publishDate_year").val()==""||$("#publishDate_month").val()==""||$("#publishDate_day").val()==""){
			alert("有空白");
		}
		else{
			var publishDate= $("#publishDate_year").val() +"-"+$("#publishDate_month").val()+"-"+$("#publishDate_day").val()+" 00:00:00";
			
			$.ajax({
				async: true,
				type: "post",
				url: "./video_handle.php",
				dataType: "xml",
				data:{
					videoName:$("#videoName").val(),
					videoType:$("#videoType").val(),
					rentPrice:$("#rentPrice").val(),
					buyPrice:$("#buyPrice").val(),
					publishDate:publishDate,
					publisher:$("#publisher").val(),
					lang:$("#lang option:selected").html(),
					intro:$("#intro").val(),
					mode:"new"
				},
				success: function(response){
					alert($(response).find("result").text());
					get_list();
				}
				
			});
			
		}
	});
});

function get_videoType(){
		$.ajax({
			async: true,
			type: "post",
			url: "./videoType_handle.php",
			dataType: "text",
			data:{
				mode:"get"
			},
			success: function(response){
			
				$(response).find("videoType").each(function(){
					
					var videoType={
						videoTypeID:$(this).children("videoTypeID").text(),
						videoTypeName:$(this).children("videoTypeName").text(),
						videoTypeMode:$(this).children("videoTypeMode").text()
					}
					
					$("#videoType").append(
						"<option value='"+videoType.videoTypeID+"'>"+
							videoType.videoTypeName+"/"+videoType.videoTypeMode+
						"</option>"
					);
					
				});
								
			}			
		});
	}
function get_publisher(){
	$.ajax({
		async: true,
		type: "post",
		url: "./publisher_handle.php",
		dataType: "text",
		data:{
			mode:"get"
		},
		success: function(response){
			
			$(response).find("publisher").each(function(){
				
				var publisher={
					publisherID:$(this).children("publisherID").text(),
					publisherName:$(this).children("publisherName").text(),
					publisherCountry:$(this).children("publisherCountry").text()
				}
				
				$("#publisher").append(
					"<option value='"+publisher.publisherID+"'>"+
						publisher.publisherName+"/"+publisher.publisherCountry+
					"</option>"
				);					
			});
			
		}
		
	});

}	
function get_list(){
	$("#video_list_table_container").empty();
	$("#video_list_table_container").append(
		"<table id='video_list_table'>"+
			"<tr id='video_list_table_row'>"+
				"<td class='video_list_table_cell'>圖片</td>"+
				"<td class='video_list_table_cell'>名稱</td>"+
				"<td class='video_list_table_cell'>類型</td>"+
				"<td class='video_list_table_cell'>租借價格</td>"+
				"<td class='video_list_table_cell'>購買價格</td>"+
				"<td class='video_list_table_cell'>上市日期</td>"+
				"<td class='video_list_table_cell'>發行公司</td>"+
				"<td class='video_list_table_cell'>影片語言</td>"+
				"<td class='video_list_table_cell'>簡介</td>"+
				"<td class='video_list_table_cell'>上傳圖片</td>"+	
				"<td class='video_list_table_cell'>刪除</td>"+				
			"</tr>"+
		"</table>"
	);
	$.ajax({
		async: true,
		type: "post",
		url: "./video_handle.php",
		dataType: "text",
		data:{
			mode:"get"
		},
		success: function(response){
			
			$(response).find("video").each(function(){
				
				var video={
					videoID:$(this).children("videoID").text(),
					videoName:$(this).children("videoName").text(),
					videoType:$(this).children("videoType").text(),
					rentPrice:$(this).children("rentPrice").text(),
					buyPrice:$(this).children("buyPrice").text(),
					publishDate:$(this).children("publishDate").text(),
					publisher:$(this).children("publisher").text(),
					lang:$(this).children("lang").text(),
					intro:$(this).children("intro").text()
				}
				
				$("#video_list_table").append(
					"<tr id='"+video.videoID +"'>"+
						"<td id='img"+video.videoID+"class='video_list_table_cell'>"+
							"<img class='video_picture' src='http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+video.videoID+".png'>"+
						"</td>"+
						"<td class='video_list_table_cell'>"+video.videoName +"</td>"+
						"<td class='video_list_table_cell'>"+video.videoType +"</td>"+
						"<td class='video_list_table_cell'>"+video.rentPrice +"</td>"+
						"<td class='video_list_table_cell'>"+video.buyPrice +"</td>"+
						"<td class='video_list_table_cell'>"+video.publishDate +"</td>"+
						"<td class='video_list_table_cell'>"+video.publisher +"</td>"+
						"<td class='video_list_table_cell'>"+video.lang +"</td>"+	
						"<td class='video_list_table_cell'>"+
							"<div>"+
								video.intro+
							"</div>"+
						"</td>"+	
						"<td class='video_list_table_cell'>"+
							"<form id='upload"+video.videoID+"' action='action.php' method='post' enctype='multipart/form-data'>"+
								"<input class='fileupload' videoId='"+video.videoID+"' type='file' name='mypic'> "+
							"</form>"+
						"</td>"+						
						"<td class='video_list_table_cell'>"+
							"<input class='video_delete_button' type='button' value='刪除'>"+
						"</td>"+
					"</tr>"
				);				
			});
			
			
			$(".video_delete_button").click(function(){
				var videoID=$(this).parent().parent().attr("id");
				
				delete_video(videoID);				
			});
			
			$(".fileupload").change(function(){ //选择文件 
				var videoID= $(this).attr("videoId");
				
				$("#upload"+videoID).ajaxSubmit({ 
					dataType:  'json', //数据格式为json 
					data:{
						videoID:videoID
					},
					beforeSend: function() {
					}, 
					uploadProgress: function(event, position, total, percentComplete) { 
					}, 
					success: function(data) { //成功 
						
						var img = "http://"+<?php echo '"'.$_SERVER['HTTP_HOST'].'"'; ?>+"/db2014/data/cover/"+data.pic; 
						$("#img"+videoID).html("<img class='video_picture' src='"+img+"'>"); 

					}, 
					error:function(xhr){ //上传失败 
						alert("fail");
					} 
				}); 
			}); 
		}
		
	});
}
function delete_video(videoID){
	if(confirm("確認刪除")){
		$.ajax({
			async: true,
			type: "post",
			url: "./video_handle.php",
			dataType: "xml",
			data:{
				videoID:videoID,
				mode:"delete"
			},
			success: function(response){
				alert($(response).find("result").text());
				get_list();
			}
		});	
	}
}



</script>
<body>
	<form name="video">
		<table id="video_add_table">
			<tr>
				<td>名稱</td>
				<td>
					<input id="videoName" name="videoName" class="table_field" type="text" size=15/>
				</td>
			</tr>
			<tr>
				<td>類型</td>
				<td>
					<select id="videoType">

					</select>
				</td>
			</tr>
			<tr>
				<td>租借價格</td>
				<td>
					<input id="rentPrice" name="rentPrice" class="table_field" type="text" size=5/>
				</td>
			</tr>
			<tr>
				<td>購買價格</td>
				<td>
					<input id="buyPrice" name="buyPrice" class="table_field" type="text" size=5/>
				</td>
			</tr>		
			<tr>
				<td>上市日期</td>
				<td>
					<input id="publishDate_year" name="publishDate_year" class="table_field" type="text" size=5/>年
					<input id="publishDate_month" name="publishDate_month" class="table_field" type="text" size=2/>月
					<input id="publishDate_day" name="publishDate_day" class="table_field" type="text" size=2/>日
				</td>
			</tr>	
			<tr>
				<td>發行公司</td>
				<td>
					<select id="publisher">

					</select>
				</td>
			</tr>	
			<tr>
				<td>影片語言</td>
				<td>
					<select id="lang">
						<option value="1">中文</option>
						<option value="2">日文</option>
						<option value="3">英文</option>
						<option value="4">韓文</option>
						<option value="5">法文</option>
						<option value="6">泰文</option>
						<option value="7">印度文</option>
						<option value="8">西班牙文</option>
						<option value="9">葡萄牙文</option>
						<option value="10">阿拉伯文</option>
						<option value="11">其他</option>
					</select>
				</td>
			</tr>		
			<tr>
				<td>簡介</td>
				<td>
					<textarea name="intro" id="intro" cols="40" rows="6"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<input id="submit_button" type="button" value="送出">
				</td>
			</tr>
		</table>
	</form>
	<div id="video_list_table_container">

	</div>
</body>
</html>