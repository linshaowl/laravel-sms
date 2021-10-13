## 介绍

- 实现  `Lswl\Sms\Contracts\CacheInterface` 缓存接口
- 更多api参考  [lswl/sms](#https://github.com/linshaowl/sms)

## 安装配置

使用以下命令安装：
```
$ composer require lswl/laravel-sms
```
发布文件[可选]：
```
php artisan vendor:publish --tag=lswl-sms
```

## 快速使用

- 默认配置只需要配置 `CHUANGLAN_ACCOUNT` 、`CHUANGLAN_PASSWORD` 环境变量即可使用 `SmsHelper::getSms()` 发送创蓝的短信。
- 更多使用方式请查看  [lswl/sms](#https://github.com/linshaowl/sms)

```php
use Lswl\SmsHelper\SmsHelper;

$sms = SmsHelper::getSms();

$res = $sms->setPhone(13188888888)
    ->setCode(6379)
    ->setMessage([
        'content'  => '您的验证码为: 6379',
    ])
    ->send();

// input
var_dump($res);
// 下次发送需要等待时间（手机号 => 等待秒数）
// [
//     13188888888 => 60,
// ]
```
