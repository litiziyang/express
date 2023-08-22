<h1 align="center"> Express </h1>

<p align="center">简单便捷查询运单快递信息</p>


[![Build Status](https://travis-ci.org/uuk020/logistics.svg?branch=master)](https://travis-ci.org/uuk020/logistics)
![StyleCI build status](https://github.styleci.io/repos/163085695/shield)
[![Latest Stable Version](https://poser.pugx.org/wythe/logistics/v/stable)](https://packagist.org/packages/wythe/logistics)
[![Total Downloads](https://poser.pugx.org/wythe/logistics/downloads)](https://packagist.org/packages/wythe/logistics)
[![Latest Unstable Version](https://poser.pugx.org/wythe/logistics/v/unstable)](https://packagist.org/packages/wythe/logistics)
[![License](https://poser.pugx.org/wythe/logistics/license)](https://packagist.org/packages/wythe/logistics)

### 支持快递鸟，快递100

#### 此包是在别人开发基础上开发[原作者](https://github.com/inbjo/express/blob/master/README.md),由于和laravel9以上的guzzle版本冲突，所以做此修改

## 安装

```shell 
$composer require liziyang/express
```

## 配置

在使用本扩展之前，你需要去 [快递100](https://www.kuaidi100.com/openapi/applyapi.shtml)
或者 [快递鸟](http://www.kdniao.com/reg) 注册申请，获取到APP_id和APP_key。

## 快递100

```php
    use Lzy\Express\Kuaidi100Express;

    $express = new Kuaidi100('api_id','api_key')
    $express->query('$tracking_code', '$shipping_code','phone')//快递单号，快递公司编码，如果是顺丰快运，顺丰速运，丰网快运需要手机号
```

## 返回

```json
{
    "message": "ok",
    "nu": "888888888888",
    "ischeck": "1",
    "condition": "F00",
    "com": "shunfeng",
    "status": "200",
    "state": "3",
    "data": [
        {
            "time": "2019-03-08 19:11:51",
            "ftime": "2019-03-08 19:11:51",
            "context": "[安高广场速运营业点]快件已发车"
        },
        {
            "time": "2019-03-08 18:56:12",
            "ftime": "2019-03-08 18:56:12",
            "context": "[安高广场速运营业点]快件在【合肥蜀山区安高广场营业点】已装车,准备发往 【合肥经开集散中心】"
        },
        {
            "time": "2019-03-08 18:50:52",
            "ftime": "2019-03-08 18:50:52",
            "context": "[安高广场速运营业点]顺丰速运 已收取快件"
        }
    ]
}
```

### 快递鸟使用方法和快递100一样

```php
    use Lzy\Express\KuaidiBirdExpress;

    $express = new KuaidiBirdExpress('api_id','api_key')
    $express->query('$tracking_code', '$shipping_code','phone')//快递单号，快递公司编码，如果是顺丰快运，顺丰速运，丰网快运需要手机号
```

## 快递鸟返回

``` json
{
    "LogisticCode": "8888888888888888",
    "ShipperCode": "YTO",
    "Traces": [
        {
            "AcceptStation": "【四川省直营市场部公司】 取件人: 四川省直营市场部41 已收件",
            "AcceptTime": "2019-03-21 11:03:40"
        },
        {
            "AcceptStation": "【四川省直营市场部公司】 已收件",
            "AcceptTime": "2019-03-21 13:45:01"
        },
        {
            "AcceptStation": "【成都转运中心】 已收入",
            "AcceptTime": "2019-03-21 22:40:01"
        }
    ],
    "State": "3",
    "OrderCode": "",
    "EBusinessID": "100000",
    "Success": true
}
```

### 通用方法

```php
    use Lzy\Express\Express;

    $express = new Express($app_id,$app_key,$type); //$type支持类型'express100'、'expressbird'
    && 
    $express = app('express');

    $express->track('xxxxxxxxxxx','xxxx')////快递单号，快递公司编码
```

### 在 Laravel 中使用

需要在`config/services.php`配置

```php
.
.
.
'express' => [
'id' => env('EXPRESS_ID'),
'key' => env('EXPRESS_KEY'),
'type' => env('EXPRESS_TYPE'),
],
 ```

然后在 `.env` 中配置 `EXPRESS_ID`、`EXPRESS_KEY`、`EXPRESS_TYPE`；

 ```env
 EXPRESS_ID=xxxxxxxxxxxxxxxxxxxxx
 EXPRESS_KEY=xxxxxxxxxxxxxxxxxxxxx
 EXPRESS_TYPE=express100
 ```

### 注意

    文档中 $shipping_code 为快递编码，

        示例
            '顺丰'        => 'shunfeng',
            '顺丰速运'     => 'shunfeng',
            '顺丰快运'     => 'shunfengkuaiyun',
            '韵达快递'     => 'yunda',
            '韵达'         => 'yunda',

## 参考

- [快递100接口文档](https://www.kuaidi100.com/openapi/api_post.shtml)
- [快递100快递公司编码](https://blog.csdn.net/u011816231/article/details/53063611)
- [快递鸟接口文档](http://www.kdniao.com/documents)
- [快递鸟快递公司编码](http://www.kdniao.com/documents)

## License

MIT