<?php
include 'HBStorage.php';

$storage = new HBStorage();

$bucketName = "cities";

$objects = $storage->getBucket($bucketName);

$files = [];
foreach ($objects as $k => $v) {
	$files[] = $storage->getUrl($bucketName, $v['name']);
}

echo json_encode(['status'=>200, 'message'=>'获取bucket成功', 'data'=>$files]);