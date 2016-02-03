<?php
include 'HBStorage.php';

$storage = new HBStorage();

$buckets = $storage->listBuckets(true);

echo json_encode(['status'=>200, 'message'=>'获取bucket成功', 'data'=>$buckets]);