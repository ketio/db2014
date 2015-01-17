<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
</head>
<style>
#videoType_list_table{
	border-collapse:collapse;
}
.videoType_list_table_cell{
	border:1px solid black;
	
	}
</style>

<script>

$(document).ready(function(){

	get_list();

	$("#submit_button").click(function(){
	
		if($("#videoTypeName").val()==""){
			alert("有空白");
		}
		else if($("#videoTypeMode").val()==""){
			alert("有空白");
		}
		else{
			$.ajax({
				async: true,
				type: "post",
				url: "./videotype_handle.php",
				dataType: "xml",
				data:{
					videoTypeName:$("#videoTypeName option:selected").html(),
					videoTypeMode:$("#videoTypeMode").val(),
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

function get_list(){
	$("#videoType_list_table_container").empty();
	$("#videoType_list_table_container").append(
		"<table id='videoType_list_table'>"+
			"<tr id='videoType_list_table_row'>"+
				"<td class='videoType_list_table_cell'>種類</td>"+
				"<td class='videoType_list_table_cell'>類型</td>"+
				"<td class='videoType_list_table_cell'>刪除</td>"+
			"</tr>"+
		"</table>"
	);
	$.ajax({
		async: true,
		type: "post",
		url: "./videotype_handle.php",
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
				
				$("#videoType_list_table").append(
					"<tr id='"+videoType.videoTypeID +"'>"+
						"<td class='videoType_list_table_cell'>"+videoType.videoTypeName +"</td>"+
						"<td class='videoType_list_table_cell'>"+videoType.videoTypeMode +"</td>"+
						"<td class='videoType_list_table_cell'>"+
							"<input class='videoType_delete_button' type='button' value='刪除'>"+
						"</td>"+
					"</tr>"
				);
				
			});
			
			
			$(".videoType_delete_button").click(function(){
				var videoTypeID=$(this).parent().parent().attr("id");
				
				delete_videoType(videoTypeID);				
			});
		}
		
	});
}

function delete_videoType(videoTypeID){
	if(confirm("確認刪除")){
		$.ajax({
			async: true,
			type: "post",
			url: "./videotype_handle.php",
			dataType: "xml",
			data:{
				videoTypeID:videoTypeID,
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
	<form name="videoType">
		<table id="videoType_add_table">
			<tr>
				<td>種類</td>
				<td>
					<select id="videoTypeName">
						<option value="movie">電影</option>
						<option value="tvseries">影集</option>
						<option value="animax">動畫</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>類型</td>
				<td>
					<input id="videoTypeMode" name="videoTypeMode" class="table_field" type="text" size=15/>
				</td>
			</tr>
			<tr>
				<td>
					<input id="submit_button" type="button" value="送出">
				</td>
			</tr>
		</table>
	</form>
	<div id="videoType_list_table_container">

	</div>
</body>
</html>