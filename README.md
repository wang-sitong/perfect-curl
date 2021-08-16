# wangsitong/perfect-curl
### Easy for request,perfect for request</br>
### 简单地请求,完美的请求
>Support various request modes like get post put delete
> 
>支持各种请求模式，如get post put delete

>Various request content types are supported like json and x-www-form-urlencoded
> 
>支持各种请求内容类型，如json和x-www-form-urlencoded

>Elegant completion requirements
> 
>优雅的完成需求
### Examples:
### 举个例子
```php 

use PerfectCURL\PerfectCURL;
//default get
$request = new PerfectCURL();
$request->setUrl('https://www.moedict.tw/a/好.json');
$result = $request->start();
```

```php
use PerfectCURL\PerfectCURL;
//post
$curl = new PerfectCURL();
$curl->setHeaders(["Authorization:Bearer " . 'efg',]);
$curl->setUrl('https://www.google.com');
$curl->setType("post");
$curl->setContentType("json");
$curl->setProxy("127.0.0.1:1234");
$result = $curl->start();
$code = $curl->getHttpCode();
$info = $curl->getHttpInfo();
$error = $curl->getError();
var_dump($code);
var_dump($info);
var_dump($result);
var_dump($error);


