<?php 
header("Content-Type:text/html;charset='utf-8'");
$storage = new SaeStorage();
$glInfo = array(
	'domain'=>'test',
	'prefix'=>'',
	'limit'=>'100',
	'offset'=>0
);

$ret = $storage->getList($glInfo['domain'],$glInfo['prefix'],$glInfo['limit'],$glInfo['offset']);

$allow_ext = array(
	'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'psd'),
	'flash' => array('swf', 'flv'),
	'media' => array('mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
	'file' => array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
);//容许的文件扩展名

$fileInfo = null;
for($i=0;$i<count($ret);$i++){
	if(substr($ret[$i],"-".strlen('/.placeholder'))!='/.placeholder'){
		$file_ext = strtolower(trim(array_pop(explode(".", $ret[$i]))));
		if(in_array($file_ext,$allow_ext['image'])===true){
			$format = 'image';
		}else if(in_array($file_ext,$allow_ext['flash'])===true){
			$format = 'flash';
		}else if(in_array($file_ext,$allow_ext['media'])===true){
			$format = 'media';
		}else if(in_array($file_ext,$allow_ext['file'])===true){
			$format = 'file';
		}else{
			$format = 'unknown';
		}
		
		$baseInfo = $storage->getAttr($glInfo['domain'] , $ret[$i]);
		
		$fileInfo[$i]['file_ext'] = $file_ext;
		$fileInfo[$i]['format'] = $format;
		$fileInfo[$i]['content_type'] = $baseInfo['content_type'];
		$fileInfo[$i]['domain'] = $glInfo['domain'];
		$fileInfo[$i]['filename'] = $baseInfo['fileName'];
		$fileInfo[$i]['url'] = $storage->getUrl($glInfo['domain'] , $ret[$i]);
		$fileInfo[$i]['length'] = $baseInfo['length'];
		$fileInfo[$i]['datetime'] = $baseInfo['datetime'];
		$fileInfo[$i]['md5sum'] = $baseInfo['md5sum'];
		$fileInfo[$i]['expires'] = $baseInfo['expires'];
	}
}
echo json_encode($fileInfo);