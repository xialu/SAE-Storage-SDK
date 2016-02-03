# 新浪SAE Storage管理器 v2
## 说明：
更多说明请参照文件HBStorage...
## 接口文档
当前阶段，代码仅支持执行在新浪SAE
### 获取bucket列表
#### URL
```bucketList.php```
#### Method
```GET```
#### Request
```null```
#### Response

```javascript
{
status: 200,
message: "获取bucket成功",
data: [
{
count: 6,
bytes: 1201975,
name: "cities"
}
]
}
```

### 获取object（文件）列表
#### URL
```objectList.php```
#### Method
```GET```
#### Request
```null```
#### Response

```javascript
{
status: 200,
message: "获取bucket成功",
data: [
"http://array-cities.stor.sinaapp.com/city-beijing.jpg",
"http://array-cities.stor.sinaapp.com/city-chengdu.jpg",
"http://array-cities.stor.sinaapp.com/city-hongkong.jpg",
"http://array-cities.stor.sinaapp.com/city-macheng.jpg",
"http://array-cities.stor.sinaapp.com/city-shanghai.jpg",
"http://array-cities.stor.sinaapp.com/city-wuhan.jpg"
]
}
```



