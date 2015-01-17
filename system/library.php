<?php

function connect_database(){
	$mysqli = new mysqli('localhost', 'root', '', 'db2014');
	mysqli_query($mysqli, 'SET CHARACTER SET utf8');
	return $mysqli;
}

function get_id($id_prefix,$table,$attribute,$db_link){
	$id_num=1;
	while($id_num>0){
		$id=$id_prefix."-".md5(uniqid(rand()));
		$query=sprintf("select * from `%s` where %s='%s'",$table,$attribute,$id);
		$query_result=mysqli_query($db_link,$query);
		$id_num=mysqli_num_rows($query_result);
	}
	return $id;
}
?>
