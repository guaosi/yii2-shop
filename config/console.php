<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases'=>[
        '@guaosiyii/mailerqueue'=>'@vendor/guaosiyii/mailerqueue/src'
    ],
    'components' => [
//        'asyncLog' => [
//            'class' => '\\app\\models\\Kafka',
//            'broker_list' => '119.23.20.140:9092',
//            'topic' => 'test',
//        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '你的redis所在IP地址',
            'port' => 6379,
            'database' => 0,
        ],
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
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
            'itemTable'=>'{{%auth_item}}',
            'itemChildTable'=>'{{%auth_item_child}}',
            'assignmentTable'=>'{{%auth_assignment}}',
            'ruleTable'=>'{{%auth_rule}}',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
//                [
//                    'class' => 'yii\log\FileTarget',
//                    'levels' => ['info'],
//                    'categories' => ['testkafka'],
//                    'logVars' => [],
//                    'exportInterval' => 1,
//                    'logFile' => '@app/runtime/logs/Kafka.log',
//                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info', 'trace'],
                    'logFile' => '@app/runtime/logs/shop/info.log',
                    'categories' => ['myinfo'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
