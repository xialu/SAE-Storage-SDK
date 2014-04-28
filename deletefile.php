<?php 
header("Content-Type:text/html;charset='utf-8'");
class DeleteFile{
	public $domain;
	public $filename;
	
	public function __construct($domain,$filename){
		$this->stor = new SaeStorage();
		$this->domain = $domain;
		$this->filename = $filename;
	}
	
	public function deleteSingle(){
		if($this->stor->fileExists($this->domain,$this->filename)===true){
			if($this->stor->delete($this->domain,$this->filename)===true){
				$this->alert(0,"File Deleted Success");
			}else{
				$this->alert(1,"Failed to Delete File");
			}
		}else{
			$this->alert(1,"No such file");
		}
	}
	
	public function alert($errorFlag,$msgContent){
		$callback = array('errorFlag' => $errorFlag, 'msgContent' => $msgContent);
		$alertInfo = json_encode($callback);
		echo $alertInfo;
		exit;
	}
}

$domain = $_GET['domain'];
$filename = $_GET['filename'];
$df = new DeleteFile($domain,$filename);
$df->deleteSingle();