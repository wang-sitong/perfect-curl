# wangsitong/perfect-curl
### Easy for request,perfect for request</br>
>Support various request modes like get post put delete

>Various request content types are supported like json and x-www-form-urlencoded

>Elegant completion requirements

### Examples:
```php
use PerfectCURL\PerfectCURL;

$curl = new PerfectCURL();
$curl->setHeaders(["Authorization:Bearer " . 'efg',]);
$curl->setUrl('https://www.google.com');
$curl->setType("post");
$curl->setContentType("json");
$result = $curl->start();
$code = $curl->getHttpCode();
$info = $curl->getHttpInfo();
var_dump($code);
var_dump($info);
var_dump($result);


