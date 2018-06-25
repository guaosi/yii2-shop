<?php

return [
    'EmailFrom'=>'同邮箱账号',
    'adminEmail' => 'guaosi100@gmail.com',
    'pageSize'=>[
        'managerSize'=>3,
        'userSize'=>3,
        'productSize'=>6,
        'IndexProductSize'=>9,
        'orderSize'=>10,
        'orderIndexSize'=>6,
        'commentIndexSize'=>5,
        'commentAdminSize'=>9,
        'pageShowNum'=>3
    ],
    'defaultAvatab'=>'/admin/img/contact-img.png',
    'mailerqueue'=>[
        'db'=>'1',
        'key'=>'mails'
    ],
    'qiniu'=>[
        'AK'=>'七牛云的AccessKey',
        'SK'=>'七牛云的SecretKey',
        'DOMAIN'=>'存储空间的网址',
        'BUCKET'=>'存储空间的名称'
    ],
    'express'=>[
        '0'=>'普通快递',
        '1'=>'顺丰快递'
    ],
    'expressPrice'=>[
        '0'=>12,
        '1'=>20
    ],
    'orderstatus'=>[
        '0'=>'待支付',
        '101'=>'订单过期',
        '201'=>'支付失败',
        '202'=>'等待发货',
        '220'=>'已发货',
        '260'=>'订单完成',
        '301'=>'取消订单',
     ],
    'orderExpire'=>30*60, //订单过期时间设置，单位:秒
    'AlipayConfig'=>[
//应用ID,您的APPID。
        'app_id' => "",

        //商户私钥
        'merchant_private_key' => "",

        //异步通知地址

        'notify_url' => "http://你的网址/pay/notifyurl.html",

        //同步跳转
        'return_url' => "http://你的网址/pay/returnurl.html",

        //编码格式
        'charset' => "UTF-8",

        //签名方式
        'sign_type'=>"RSA2",

        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

        //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
        'alipay_public_key' => "",
    ]
];
