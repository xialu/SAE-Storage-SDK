<?php 
header("Content-Type:text/html;charset='utf-8'");
class GetFiles{
	public $domain;
	public $prefix;
	public $limit;
	public $offset;
	static $allow_ext = array(
		'image' => array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'psd'),
		'flash' => array('swf', 'flv'),
		'media' => array('mp3', 'wav', 'wma', 'wmv', 'mid', 'avi', 'mpg', 'asf', 'rm', 'rmvb'),
		'file' => array('pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'htm', 'html', 'txt', 'zip', 'rar', 'gz', 'bz2'),
	);//容许的文件扩展名
	
	public function __construct($domain,$offset,$limit,$prefix){
		$this->stor = new SaeStorage();
		$this->domain = $domain;
		$this->prefix = $prefix;
		$this->limit = $limit;
		$this->offset = $offset;
		$this->allow_ext = self::$allow_ext;
	}
	
	public function fileList(){
		$ret = $this->stor->getList($this->domain,$this->prefix,$this->limit,$this->offset);
		$fileInfo = null;
		for($i=0;$i<count($ret);$i++){
			if(substr($ret[$i],"-".strlen('/.placeholder'))!='/.placeholder'){
				$file_ext = strtolower(trim(array_pop(explode(".", $ret[$i]))));
				if(in_array($file_ext,$this->allow_ext['image'])===true){
					$format = 'image';
				}else if(in_array($file_ext,$this->allow_ext['flash'])===true){
					$format = 'flash';
				}else if(in_array($file_ext,$this->allow_ext['media'])===true){
					$format = 'media';
				}else if(in_array($file_ext,$this->allow_ext['file'])===true){
					$format = 'file';
				}else{
					$format = 'unknown';
				}
				
				$baseInfo = $this->stor->getAttr($this->domain , $ret[$i]);
				$fileInfo[$i]['file_ext'] = $file_ext;
				$fileInfo[$i]['format'] = $format;
				$fileInfo[$i]['content_type'] = $baseInfo['content_type'];
				$fileInfo[$i]['domain'] = $this->domain;
				$fileInfo[$i]['filename'] = $baseInfo['fileName'];
				$fileInfo[$i]['url'] = $this->stor->getUrl($this->domain , $ret[$i]);
				$fileInfo[$i]['length'] = $baseInfo['length'];
				$fileInfo[$i]['datetime'] = date("Y-M-d H:i:s",$baseInfo['datetime']);
				$fileInfo[$i]['md5sum'] = $baseInfo['md5sum'];
				$fileInfo[$i]['expires'] = $baseInfo['expires'];
			}
		}
		return json_encode($fileInfo);
	}
}

$domain = empty($_GET['domain'])?'test':trim($_GET['domain']);
$prefix = empty($_GET['prefix'])?'':trim($_GET['prefix']);
$limit = empty($_GET['limit'])?'20':trim($_GET['limit']);
$page = empty($_GET['page'])?'1':intval(trim($_GET['page']));
if($page<2){
	$offset = 0;
}else{
	$offset = $limit*($page-1);
}

$gf = new GetFiles($domain,$offset,$limit,$prefix);
echo $gf->fileList();