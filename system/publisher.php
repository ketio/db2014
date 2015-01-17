<html>
<head>
<script src="./js/jquery-1.11.2.min.js"></script>
</head>
<style>
#publisher_list_table{
	border-collapse:collapse;
}
.publisher_list_table_cell{
	border:1px solid black;
	
	}
</style>

<script>

$(document).ready(function(){

	get_list();

	$("#submit_button").click(function(){
	
		if($("#publisherName").val()==""){
			alert("有空白");
		}
		else if($("#publisherCountry").val()==""){
			alert("有空白");
		}
		else{
			
			$.ajax({
				async: true,
				type: "post",
				url: "./publisher_handle.php",
				dataType: "xml",
				data:{
					publisherName:$("#publisherName").val(),
					publisherCountry:$("#publisherCountry").val(),
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
	$("#publisher_list_table_container").empty();
	$("#publisher_list_table_container").append(
		"<table id='publisher_list_table'>"+
			"<tr id='publisher_list_table_row'>"+
				"<td class='publisher_list_table_cell'>出版</td>"+
				"<td class='publisher_list_table_cell'>國家</td>"+
				"<td class='publisher_list_table_cell'>刪除</td>"+
			"</tr>"+
		"</table>"
	);
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
				
				$("#publisher_list_table").append(
					"<tr id='"+publisher.publisherID +"'>"+
						"<td class='publisher_list_table_cell'>"+publisher.publisherName +"</td>"+
						"<td class='publisher_list_table_cell'>"+publisher.publisherCountry +"</td>"+
						"<td class='publisher_list_table_cell'>"+
							"<input class='publisher_delete_button' type='button' value='刪除'>"+
						"</td>"+
					"</tr>"
				);
				
			});
			
			
			$(".publisher_delete_button").click(function(){
				var publisherID=$(this).parent().parent().attr("id");
				
				delete_publisher(publisherID);				
			});
		}
		
	});
}
	
function delete_publisher(publisherID){
	if(confirm("確認刪除")){
		$.ajax({
			async: true,
			type: "post",
			url: "./publisher_handle.php",
			dataType: "xml",
			data:{
				publisherID:publisherID,
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
	<form name="publisher">
		<table id="publisher_add_table">
			<tr>
				<td>出版</td>
				<td>
					<input id="publisherName" name="publisherName" class="table_field" type="text" size=15/>
				</td>
			</tr>
			<tr>
				<td>國家</td>
				<td>
					<input id="publisherCountry" name="publisherCountry" class="table_field" type="text" size=15/>
				</td>
			</tr>
			<tr>
				<td>
					<input id="submit_button" type="button" value="送出">
				</td>
			</tr>
		</table>
	</form>
	<div id="publisher_list_table_container">

	</div>
</body>
</html>