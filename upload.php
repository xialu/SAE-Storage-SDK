<?php 
$domain="test";
$file_name = $_FILES["imgFile"]["name"];
$allow_ext = array(
	'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp'),
	'flash' => array('swf', 'flv'),
	'media' => array('swf', 'flv', 'mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
	'file' => array('doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);//容许的文件扩展名
$file_ext = strtolower(trim(array_pop(explode(".", $file_name))));
$dir_name = empty($_GET['dir'])?'image':trim($_GET['dir']);
if(in_array($file_ext,$allow_ext[$dir_name])===false){
    alert("不支持的扩展名，目前我们仅支持以下扩展名：".implode(',',$allow_ext[$dir_name]));
    exit;
}
$new_file_name = 'image/'.date("Ymd") . '/' .time().'.'.$file_ext;
$s = new SaeStorage();
//$s->upload( 'imagefile',$_FILES["myfile"]["name"],$_FILES["myfile"]["name"]);
$aimage=$s->upload( 'test',$new_file_name,$_FILES["imgFile"]["tmp_name"]);
echo "<img src='".$aimage."' />";

function alert($msg) {
	header('Content-type: text/html; charset=UTF-8');
	var_dump(array('error' => 1, 'message' => $msg));
	exit;
}
