# wangsitong/perfect-curl

[中文文档](./README_ZH.md)

### Easy for request,perfect for request</br>

> Support various request modes like get post put delete
>

> Various request content types are supported like json and x-www-form-urlencoded
>

> Elegant completion requirements
>

### Examples:

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
$curl = new PerfectCURL();
$result = $curl->setHeaders(["Authorization:Bearer " . 'efg',])
    ->setUrl('https://www.google.com')
    ->setType("post")
    ->setContentType("json")
    ->setProxy("127.0.0.1:1234")
    ->start();
    
var_dump($result);

$code = $curl->getHttpCode();
$info = $curl->getHttpInfo();
$error = $curl->getError();
var_dump($code);
var_dump($info);
var_dump($error);


