基于Yii2制作的电子商城，做了挺多优化，支持PHP7.
===========
> 🚀 基于`PHP7`加速Yii2，使用异步以及缓存，第三方cdn来加速页面速度，让网站起飞

## 特性

- redis生产消费者模式异步30分钟自动取消未支付订单

- 前台使用缓存:普通缓存，缓存依赖，查询缓存

- 使用ElasticSearch作为搜索引擎，结果高亮显示

- redis队列异步发送邮件

- 接入 sentry发送异常日志

- 加入 Kafka异步记录日志(自行开启)

- 后台RBAC权限控制

- 接入 支付宝

- 接入 七牛云,ueditor(图片自动上传七牛云)

- 接入 QQ互联，可以使用QQ登陆

> qq和支付宝都是开发者模式，只能允许开发者使用，请自行修改成自己的再进行体验。

## 体验地址

> http://shopyii.guaosi.com

## 要求

| 依赖 | 说明 |
| -------- | -------- |
| PHP| >=`7`|
| Yii| `2.0.12` |
| MySQL| >=`5.5` |
| nginx |用于网址代理解析|
| ElasticSearch|`2.4.1`|
| Redis|`3.2.10`|
| 集成环境[可选的] | LNMP`>=1.5` |

## 注意

1. 自行导入数据库。为了下载后能正常使用，我内置了一部分数据，不过七牛云我做了防盗链，所以图片是无法显示的。

2. Kafka需要到配置文件里自行开启，我换成Sentry已经注释了Kafka。

3. 做了一次网站迁移上传的,应该没有什么问题,有关问题下面会说明。

## 安装

通过[Github](https://github.com/guaosi/yii2-shop),fork到自己的项目下
```
git clone git@github.com:<你的用户名>/yii2-shop.git
```

## 数据库

> 创建shopyii数据库，自行导入`shopyii.sql`文件

## Redis

### 下载

在 /usr/local 下执行

```
wget http://download.redis.io/releases/redis-3.2.10.tar.gz
tar -zxvf redis-3.2.10.tar.gz
cd redis-3.2.10.tar.gz
```

### 安装

```
make PREFIX=/usr/local/redis install
```

### 配置

```
cp /usr/local/redis-3.2.10/redis.conf /etc/redis/6379.conf
vim /etc/redis/6379.conf 
# 参考 /linux/6379.conf 的配置详情

vim /usr/local/redis-3.2.10/utils/redis_init_script
# 参考 /linux/redis_init_script 的配置详情
cp /usr/local/redis-3.2.10/utils/redis_init_script /etc/init.d/redis 
```

### 启动

> /etc/init.d/redis start 或者 /usr/local/redis/bin/redis-server ../etc/redis.conf

### 注意

我的学生机配置太低，redis启动后几个小时有几率自动被杀进程，配置高的没试过，亲执行尝试，如果重启服务器，请按照上面的启动章节，自行启动redis

## ElasticSearch

> 需要自行添加java环境以及maven

> java环境安装请参考 https://blog.csdn.net/hg_harvey/article/details/73824084 的yum部分

> maven 环境安装请参考 https://www.cnblogs.com/jimisun/p/8054819.html

### 安装

> yum -y install elasticsearch-2.4.1.rpm 

### 配置

> vim /etc/elasticsearch/elasticsearch.yml (参考 /linux/elasticsearch.yml)

### 启动

> service elasticsearch start

### 分词器

在 /usr/elasticsearch 下

```
git clone https://github.com/medcl/elasticsearch-analysis-ik.git
cd /usr/elasticsearch/elasticsearch-analysis-ik
git checkout tags/v1.10.1
mv /usr/elastiicsearch/elasticsearch-analysis-ik/target/releases/elasticsearch-analysis-ik-1.10.1.zip /usr/share/elasticsearch/plugins/
```

在/usr/share/elasticsearch/plugins 下

>  mkdir ik

将`elasticsearch-analysis-ik-1.10.1.zip`压缩包移动到`ik`下进行解压

> unzip elasticsearch-analysis-ik-1.10.1.zip

#### 启动

> service elasticsearch restart

#### 索引

在 /usr/elasticsearch 下

```
wget http://xbib.org/repository/org/xbib/elasticsearch/importer/elasticsearch-jdbc/2.3.4.1/elasticsearch-jdbc-2.3.4.1-dist.zip
unzip elasticsearch-jdbc-2.3.4.1-dist.zip
```

1. 创建索引

> curl -XPUT "http://114.67.143.31:9200/shopyii" -d'@createindex.json'

2. 配置文件加入(/linux/mysql-product.sh)
>  /usr/elasticsearch/elasticsearch-jdbc-2.3.4.1/bin/ 下的 mysql-product.sh(自行修改)

3. 运行自动更新索引

> nohup /usr/elasticsearch/elasticsearch-jdbc-2.3.4.1/bin/mysql-product.sh > nohup.out1 2>&1 &

### 注意

如果重启服务器后，需要执行以下命令

> service elasticsearch restart

> nohup /usr/elasticsearch/elasticsearch-jdbc-2.3.4.1/bin/mysql-product.sh > nohup.out1 2>&1 &

## Application配置

### 指令

1. commands/OrderController.php 

```
public function actionRecover($host='你的redis所在IP地址',$port=6379)
``` 

2. config/console.php

```
'redis' => [
        'class' => 'yii\redis\Connection',
        'hostname' => '你的redis所在IP地址',
        'port' => 6379,
        'database' => 0,
    ],
'mailer' => [
        'class'=>'guaosiyii\mailerqueue\MailerQueue',
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => "邮箱smtp地址",
            'username' => '邮箱账号',
            'password' => '邮箱密码',
            'port' => '邮箱端口',
            'encryption' => '加密方式',
        ],
```
### 配置

1. config/db.php

```
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=127.0.0.1;dbname=shopyii',
    'username' => '数据库用户名',
    'password' => '数据库密码',
    'charset' => 'utf8',
    'tablePrefix'=>'shop_'
];
```

2. config/params.php
```
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
```    
3. config/web.php
```
   'mailer' => [
            'class'=>'guaosiyii\mailerqueue\MailerQueue',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => "邮箱smtp地址",
                'username' => '邮箱账号',
                'password' => '邮箱密码',
                'port' => '邮箱端口',
                'encryption' => '加密方式',
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
 'cache' => [
//            'class' => 'yii\caching\FileCache',
                'class' => 'yii\redis\Cache',
                 'redis' => [
                 'hostname' => '你的redis所在IP地址',
                 'port' => 6379,
                 'database' => 2,
             ]
        ],
如果想使用 sentry
请配置
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
```
5. web/admin/lib/ueditor_qiniu/php/config.php
```
/* 七牛云存储信息配置 */
'bucket'      => '存储空间的名称', // 七牛Bucket的名称
'host'        => '存储空间的网址',
'access_key'  => '七牛云的AccessKey',
'secret_key'  => '七牛云的SecretKey',
```

### QQ互联
1. 在QQ互联官网创建应用  

2. 下载SDK配置
> http://wiki.connect.qq.com/sdk%E4%B8%8B%E8%BD%BD

3. 替换vendor下的qqlogin整个文件夹

### 后台运行与定时任务

1. 在项目目录下

> nohup ./yii order/recover > nohup.out1 2>&1 &

2. 添加定时任务
```
crontab -e 
*/3 * * * * /你的项目目录/yii mailer/send
```
## Nginx配置

这个需求应该不大，就不写了.

## 测试账号与密码

以上都完成后
前后台登录账号密码

> guaosi  a123654

后台地址:
> http://你的网址/admin/public/login.html

## 指令总结

> 指令有点多，总结一下

1. 在项目目录下

```
./yii rbac/init
# 根据控制器名称和方法生成对应的权限名，遍历入库
./yii order/recover
# 监听redis，半小时未支付订单自动取消
./yii mailer/send
# 开启redis队列异步发送邮件
```

2. 服务

```
/usr/local/redis/bin/redis-server ../etc/redis.conf
# 开启redis服务
service elasticsearch start
# 开启ElasticSearch服务
nohup /usr/elasticsearch/elasticsearch-jdbc-2.3.4.1/bin/mysql-product.sh > nohup.out1 2>&1 &
# 开启自动更新商品索引
```

3. 重启后需要执行的指令

```
service elasticsearch start
nohup /usr/elasticsearch/elasticsearch-jdbc-2.3.4.1/bin/mysql-product.sh > nohup.out1 2>&1 &
nohup /你的项目目录/yii order/recover > nohup.out1 2>&1 &
/usr/local/redis/bin/redis-server ../etc/redis.conf
```