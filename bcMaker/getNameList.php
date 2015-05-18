<?php

$array = scandir(".");
$listArray = array();
foreach($array as $row){
	$file = "./".$row;
	$row = iconv("BIG5", "UTF-8",$row);
	
	//回根目錄
	if($row != "." && $row != ".." && is_dir(urldecode($file))){

		if(isset($_GET['term'])){
			$term = iconv("BIG5", "UTF-8",$_GET['term']);
			if (strpos($row, $term) !== false){
				$listArray[] = $row;
			}
		}else{
			$listArray[] = $row;
		}
	}
}

echo json_encode($listArray);
?>
