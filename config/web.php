<?php

$params = require(__DIR__ . '/params.php');
$adminmenu = require(__DIR__ . '/adminmenu.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute'=>'index',
    'language'=>'zh-cn',
    'charset'=>'utf-8',
    'aliases'=>[
      '@guaosiyii/mailerqueue'=>'@vendor/guaosiyii/mailerqueue/src'
    ],
    'components' => [
        'mailer' => [
//            'class' => 'yii\swiftmailer\Mailer',
            'class'=>'guaosiyii\mailerqueue\MailerQueue',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => "邮箱smtp地址",
                'username' => '邮箱账号',
                'password' => '邮箱密码',
                'port' => '邮箱端口',
                'encryption' => '加密方式',
            ],

        ],
//        'asyncLog' => [
//            'class' => '\\app\\models\\Kafka',
//            'broker_list' => 你的Kafka:9092',
//            'topic' => 'test',
//        ],
        'sentry' => [
            'class' => 'mito\sentry\Component',
            'dsn' => 'sentry的私有cdn', // private DSN
            'publicDsn'=>'sentry的公有cnd',
            'environment' => 'staging', // if not set, the default is `production`
            'jsNotifier' => true, // to collect JS errors. Default value is `false`
            'jsOptions' => [ // raven-js config parameter
                'whitelistUrls' => [ // collect JS errors from these urls
                ],
            ],
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '你的redis所在IP地址',
            'port' => 6379,
            'database' => 0,
        ],
        'session' => [
            'class' => 'yii\redis\Session',
            'redis' => [
                'hostname' => '你的redis所在IP地址',
                'port' => 6379,
                'database' => 3,
             ],
            'keyPrefix'=>'shopyii_session_'
          ],
        'elasticsearch' => [
            'class' => 'yii\elasticsearch\Connection',
            'nodes' => [
                ['http_address' => '你的elasticsearch所在IP地址:9200'],
                // configure more hosts if you have a cluster
            ],
            'autodetectCluster' => false
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'itemTable'=>'{{%auth_item}}',
            'itemChildTable'=>'{{%auth_item_child}}',
            'assignmentTable'=>'{{%auth_assignment}}',
            'ruleTable'=>'{{%auth_rule}}',
            'defaultRoles'=>['default']
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
                    ],
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css',
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
                    ]
                ]
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,  //是否启用美化url
            'showScriptName' => false,  //是否显示脚本名
            'suffix' => '.html',
            'rules' => [
                'product-cate-<cateid:\d+>'=>'product/index',
                '<controller:(index|cart|order|product)>'=>'<controller>/index',
                'auth'=>'member/auth',
                'product-<productid:\d+>'=>'product/detail',
                'order-<orderid:\d+>'=>'order/check',
                'order-check'=>'order/check',
                'search'=>'product/search',
                'payorder-<orderid:\d+>'=>'order/payorder',
                'payresult'=>'pay/returnurl',

            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ihZKY3Cy0cjlW3eJlV11Uu97S4Dsps0_',
        ],
        'cache' => [
//            'class' => 'yii\caching\FileCache',
                'class' => 'yii\redis\Cache',
                 'redis' => [
                 'hostname' => '你的redis所在IP地址',
                 'port' => 6379,
                 'database' => 2,
             ]
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'idParam'=>'__user',
            'identityCookie'=>['name'=>'__user__identity','httpOnly'=>true],
            'loginUrl'=>['/member/auth']
        ],
        'admin' => [
            'class'=>'yii\web\User',
            'identityClass' => 'app\modules\models\Admin',
            'enableAutoLogin' => true,
            'idParam'=>'__admin',
            'identityCookie'=>['name'=>'__admin__identity','httpOnly'=>true],
            'loginUrl'=>['/admin/public/login']
        ],
        'errorHandler' => [
            'errorAction' => 'error/error',
        ],

        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
//                [
//                    'class' => 'mito\sentry\Target',
//                    'levels' => ['error', 'warning'],
//                    'except' => [
//                        'yii\web\HttpException:404',
//                    ],
//                ],  老发邮件先停一下，启用时，当发生错误sentry平台发送邮件
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/shop/application.log',
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'trace'],
                    'logFile' => '@app/runtime/logs/shop/info.log',
                    'categories' => ['myinfo'],
                ],
//                [
//                    'class' => 'yii\log\EmailTarget',
//                    'mailer' =>'mailer',
//                    'levels' => ['error', 'warning'],
//                    'message' => [
//                        'from' => ['guaosi@sina.cn'],
//                        'to' => ['guaosi@vip.qq.com'],
//                        'subject' => 'shopyii的日志',
//                    ],
//                ],
            ],
        ],
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => array_merge($params,['adminmenu'=>$adminmenu]),

];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1'],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['modules']['admin']=[
        'class'=>'app\modules\admin'
    ];
}

return $config;
