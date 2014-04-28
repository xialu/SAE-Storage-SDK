<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>上传新文件-Storage管理-SAE控制台</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$("#submitform").click(function(){
			$("#fmupload").submit();
		});
	})
	</script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">            
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">仪表盘</a>
            </div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li><a href="index.php"><i class="fa fa-bullseye"></i> 控制面板</a></li>
					<li class="active"><a href="storage.php"><i class="fa fa-file-o"></i> Storage</a></li>
                    <li><a href="portfolio.php"><i class="fa fa-tasks"></i> 相册</a></li>
                    <li><a href="blog.php"><i class="fa fa-globe"></i> Blog</a></li>
                    <li><a href="forms.php"><i class="fa fa-list-ol"></i> 表单</a></li>
                    <li><a href="typography.php"><i class="fa fa-font"></i> 段落</a></li>
                    <li><a href="bootstrap-elements.php"><i class="fa fa-list-ul"></i> BS Elements </a></li>
                    <li><a href="bootstrap-grid.php"><i class="fa fa-table"></i > BS Grid</a></li>                    
                </ul>
                <ul class="nav navbar-nav navbar-right navbar-user">
                    <li class="dropdown messages-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> 通知 <span class="badge">2</span> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-header">2 条新消息</li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Security alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li class="message-preview">
                                <a href="#">
                                    <span class="avatar"><i class="fa fa-bell"></i></span>
                                    <span class="message">Security alert</span>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="#">消息中心 <span class="badge">2</span></a></li>
                        </ul>
                    </li>
                    <li class="dropdown user-dropdown">
                       <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Luke<b class="caret"></b></a>
                       <ul class="dropdown-menu">
                           <li><a href="#"><i class="fa fa-user"></i> 个人资料</a></li>
                           <li><a href="#"><i class="fa fa-gear"></i> 设置</a></li>
                           <li class="divider"></li>
                           <li><a href="#"><i class="fa fa-power-off"></i> 退出</a></li>
                       </ul>
                   </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> 上传新文件</h3>
                        </div>
                        <div class="panel-body">
							<div id="shieldui-grid1">
								<a href="storage.php" class="btn btn-info btn-sm btn-block">文件列表</a><br />
								<a href="upload.html" class="btn btn-info btn-sm btn-block">继续上传</a><br />
							</div>
							<div id="shieldui-grid1">
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
$dir_name = empty($_POST['dir'])?'image':trim($_POST['dir']);
if(in_array($file_ext,$allow_ext[$dir_name])===false){
	alert("不支持的扩展名，目前我们仅支持以下扩展名：".implode(',',$allow_ext[$dir_name]));
	exit;
}
$new_file_name = $dir_name.'/'.date("Ymd") . '/' .time().'.'.$file_ext;
$s = new SaeStorage();
//$s->upload( 'imagefile',$_FILES["myfile"]["name"],$_FILES["myfile"]["name"]);
$aimage=$s->upload( 'test',$new_file_name,$_FILES["imgFile"]["tmp_name"]);
alert("文件上传成功，路径为".$aimage);
function alert($msg) {
	$info = array('error' => 1, 'message' => $msg);
	echo $info['message'];
	exit;
}
?>
							</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>