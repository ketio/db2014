<html>
<head>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
</head>
<style>
html body{
	margin:0px;
	background: black;
	padding:20px;
	padding-left:80px;
	padding-right:80px;
}
#myHeader{
	margin: 0px auto;
	background: white;
	width:100%;
	height:100%;
}
</style>
<script>

$(document).ready(function(){

	$("#myHeader").click(function(){
	
		$(this).append("<div>hi</div>");
	});
});

</script>
<body>

	<div id="myHeader" >Click me!</div>


</body>
</html>