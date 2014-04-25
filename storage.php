<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAE控制台</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="css/local.css" />
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).on("click",".open-Modal",function(){
		var myModalSrc = $(this).data('url');
		$(".modal-body #imgSrc").attr('src',myModalSrc);
	});
	
	$(document).on("click",".open-musicModal",function(){
		var musicModalSrc = $(this).data('url');
		$(".modal-body #mp3value").attr('src',musicModalSrc);
	});
	
	function clsVideo(){
		$("#mp3value").pause();
	}
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
                            <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> 文件列表</h3>
                        </div>
                        <div class="panel-body">
                            <div id="shieldui-grid1">
								<table width="100%" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>扩展名</th>
											<th>类型</th>
											<!-- th>格式</th>
											<th>Domain</th -->
											<th>文件名</th>
											<th>大小</th>
											<th>创建时间</th>
											<!-- th>到期时间</th>
											<th>Md5Sum</th -->
											<th>操作</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$json = file_get_contents("http://8.xialu.sinaapp.com/FileManager/getfiles.php");
											$array = json_decode($json,true);
											for($i=0;$i<count($array);$i++){
										?>
										<tr>
											<td><?php echo $array[$i]['file_ext']; ?></td>
											<td><?php echo $array[$i]['format']; ?></td>
											<!-- td><?php echo $array[$i]['content_type']; ?></td>
											<td><?php echo $array[$i]['domain']; ?></td -->
											<td><?php echo $array[$i]['filename']; ?></td>
											<td><?php echo $array[$i]['length']; ?></td>
											<td><?php echo $array[$i]['datetime']; ?></td>
											<!-- td><?php echo $array[$i]['expires']; ?></td>
											<td><?php echo $array[$i]['md5sum']; ?></td -->
											<td>
												<?php if($array[$i]['format']=='image'){ ?>
												<button class="btn btn-default btn-xs open-Modal" data-toggle="modal" data-target="#myModal" data-url="<?php echo $array[$i]['url']; ?>">预览</button>
												<?php }else if($array[$i]['format']=='media'){ ?>
												<button class="btn btn-default btn-xs open-musicModal" data-toggle="modal" data-target="#musicModal" data-url="<?php echo $array[$i]['url']; ?>">影音</button>
												<?php }else{ ?>
												<a class="btn btn-default btn-xs" href="<?php echo $array[$i]['url']; ?>" target="_blank" >下载</button>
												<?php } ?>
												<a class="btn btn-danger btn-xs" href="<?php echo $array[$i]['url']; ?>" target="_blank" >删除</a>
											</td>
											<!-- td><?php echo "<a href='".$array[$i]['url']."' target='_blank' >预览</a>"; ?></td-->
										</tr>
										<?php 
											}
										?>
									</tbody>
								</table>
								<ul class="pagination">
									<li><a href="storage.php">&laquo;</a></li>
									<li><a href="storage.php">1</a></li>
									<li><a href="storage.php?page=2">2</a></li>
									<li><a href="storage.php?page=3">3</a></li>
									<li><a href="storage.php?page=4">4</a></li>
									<li><a href="storage.php?page=5">5</a></li>
									<li><a href="storage.php?page=2">&raquo;</a></li>
								</ul>
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
	
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		<img src="" id="imgSrc" style="max-width:560px" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">See you</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="musicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		<video src="" id="mp3value" controls="controls" style="width:560px">
			基友，你该换浏览器了
		</video>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="clsVideo()">Close</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">See you</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</body>
</html>
