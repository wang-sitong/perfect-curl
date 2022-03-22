# wangsitong/perfect-curl
[English](./README.md)
### 简单地请求,完美的请求

>支持各种请求模式，如get post put delete

>支持各种请求内容类型，如json和x-www-form-urlencoded

>优雅的完成需求
### 举个例子
```php 

use PerfectCURL\PerfectCURL;
// default get
$request = (new PerfectCURL())
    ->setUrl('https://www.moedict.tw/a/好.json')
    ->start();
var_dump($request);
```

```php
use PerfectCURL\PerfectCURL;
// post
$curl = (new PerfectCURL())
    ->setHeaders(["Authorization:Bearer " . 'efg',])
    ->setUrl('https://www.google.com')
    ->setType("post")
    ->setContentType("json")
    ->setProxy("127.0.0.1:1234")
    ->start();
$code = $curl->getHttpCode();
$info = $curl->getHttpInfo();
$error = $curl->getError();
var_dump($code);
var_dump($info);
var_dump($curl);
var_dump($error);


