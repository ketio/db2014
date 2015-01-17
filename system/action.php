<?php

	$pics=$_POST["videoID"];
	//上传图片 
    $picname = $_FILES['mypic']['name']; 
    $picsize = $_FILES['mypic']['size']; 
    if ($picname != "") { 
        if ($picsize > 5120000) { //限制上传大小 
            echo '图片大小不能超过500k'; 
            exit; 
        } 
        //$type = strstr($picname, '.'); //限制上传格式 
       // if ($type != ".png" && $type != ".jpg") { 
       //     echo '图片格式不对！'; 
       //     exit; 
       // } 
	   
        $pics.=".png";
        //上传路径 
        $pic_path = "../data/cover/". $pics; 
	      

        move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path); 
		
		
		$src = imagecreatefromjpeg($pic_path);
	   
		// 取得來源圖片長寬
		$src_w = imagesx($src);
		$src_h = imagesy($src);

		// 假設要長寬不超過90
		if($src_w > $src_h){
		  $thumb_w = 300;
		  $thumb_h = intval($src_h / $src_w * 300);
		}else{
		  $thumb_h = 300;
		  $thumb_w = intval($src_w / $src_h * 300);
		}   
	   
	   	// 建立縮圖
		$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
		
	   // 開始縮圖
		imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);
	   
	   
	   // 儲存縮圖到指定 thumb 目錄
		imagejpeg($thumb, $pic_path);
		
		
		
		// 複製上傳圖片到指定 images 目錄
		//copy($_FILES['file']['tmp_name'],$pic_path ); 
    } 
	
    $size = round($picsize/1024,2); //转换成kb 
    $arr = array( 
        'name'=>$picname, 
        'pic'=>$pics, 
        'size'=>$size 
    ); 
    echo json_encode($arr); //输出json数据 	

?>