<?php
/**
* SAE Storage文件处理类
* 这是一个用来处理新郎SAE储存的类，类没有实现什么复杂的功能。所有功能全部来自SAE官方。如果可以，建议直接读取官方的文档去实现，官方文档如下：
* http://apidoc.sinaapp.com/class-sinacloud.sae.Storage.html
* 
* 背景：
* 大概是两年前，我个人写了一个SAE的简易文件管理系统，包含了UI，地址为：https://github.com/httpbin/SAE-Storage-SDK
* 但是该管理器只是一个十分简单几个文件，甚至不能成为管理器。老实说，那个管理器只是一个半成品。因此在使用上，存在了很大的问题。
*
* 两年过去了，最近还有人问我关于SAE存储的一些问题。
* 于是就大致看了一下SAE存储的一些东西，发现SAE在Storage方面，改版了不少，两年前的那个半成品应该是不能用了。
* 本着一个要写就写，不写就不要把过时的代码拿出来贻害人间的原则，准备重新造个轮子。
* 
* 但是，这次，不再以产品的形势出现了。即，代码不再提供界面化的工具！
* 既然这样，那么这个代码库有存在的必要吗？
* 
* 答案是肯定的:
* 1, 这里的代码可以用来作为你项目当中的Model层来获取SAE存储的数据对象。你要做的，只需要简单的引入文件，在你的代码当中接收到这里返回的数据，然后在View层展现即可。
* 2, 有不少朋友是做移动段开发的，这里会封装出一套完整的读取移动端接口。移动端移动可以直接把SAE Storage作为相册后台来使用。
* 3, 没了……
* 
* 理论上，不建议再去使用两年前那份代码，因为它是过时的、该被摒弃的！当然，如果你还是执意要看，我也没办法，毕竟也有那么一丁点的参考价值。
* 
* 上面提到有接口，所以势必会有接口文档，具体细节请参考文件：说明.md
* 
* 
* 
* 
* 
*/
use sinacloud\sae\Storage;

class HBStorage {
	private $storage;

	/**
	* 构造器
	* 初始化Storage对象
	*/
	public function __construct($isDebug = false) {
		$this->storage = new Storage();
		$this->storage->setExceptions($isDebug); //开启调试
	}

	// Bucket操作
	/**
	* 创建一个新的bucket
	* $bucketName 为bucket名字
	*
	* 需要扩展（设置ACL和头信息）的，请参照官方方法
	* http://apidoc.sinaapp.com/source-class-sinacloud.sae.Storage.html#367-396
	*/
	public function putBucket($bucketName) {
		return $this->storage->putBucket($bucketName);
	}

	/**
	* 列出所有的buckets
	* $detailed 是否需要返回附加数据：Bucket中Object数量和Bucket的大小
	*/
	public function listBuckets($detailed = false) {
		return $this->storage->listBuckets($detailed);
	}

	/**
	* 获取bucket当中的文件列表
	* $bucketName bucket名
	* $prefix 对象名前缀
	* $marker 返回$marker之后的对象列表（不包含marker）
	* $limit 最大返回对象数目
	* $delimiter分隔符
	*/
	public function getBucket($bucketName, $prefix = null, $marker = null, $limit = 1000, $delimiter = null) {
		return $this->storage->getBucket($bucketName, $prefix, $marker, $limit, $delimiter);
	}

	/**
	* 删除空的bucket
	* $bucketName bucket名
	*/
	public function deleteBucket($bucketName = '') {
		return $this->storage->deleteBucket($bucketName);
	}

	/**
	* 获取object内容
	* $bucketName bucket名
	* $uri对象名称
	* $saveTo 文件保存到的文件名或者句柄
	*/
	public function getObject($bucketName, $uri, $saveTo = false) {
		return $this->storage->getObject($bucketName, $uri, $saveTo);
	}

	public function deleteObject($bucketName, $uri) {
		return $this->storage->deleteObject($bucketName, $uri);
	}

	/**
	* 对象复制
	* $srcBucketName 源bucket名
	* $srcUri 源地址
	* $targetBucketName 目标bucketName
	* $targetName 目标地址
	*
	* 扩展参考 http://apidoc.sinaapp.com/source-class-sinacloud.sae.Storage.html#729-762
	*/
	public function copyObject($srcBucketName, $srcUri, $targetBucketName, $targetUri) {
		return $this->storage->copy($srcBucketName, $srcUri, $targetBucketName, $targetUri);
	}

	/**
	* 获取对象的临时访问地址
	* $bucketName bucket名
	* $uri 对象地址
	* $method 访问方式
	* $seconds 过期时间（秒）
	*/
	public function getTempUrl($bucketName, $uri, $method, $seconds) {
		return $this->storage->getTempUrl($bucketName, $uri, $method, $seconds);
	}

	/**
	* 获取对象的CDN访问地址
	* $bucketName 对象所在bucket
	* $uri 文件名
	*/
	public function getCdnUrl($bucketName, $uri) {
		return $this->storage->getCdnUrl($bucketName, $uri);
	}

	/*
	* 获取对象外部访问路径
	*/
	public function getUrl($bucketName, $uri) {
		return $this->storage->getUrl($bucketName, $uri);
	}
}
