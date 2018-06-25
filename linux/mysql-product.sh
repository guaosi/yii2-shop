#!/bin/sh

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
bin=${DIR}/../bin
lib=${DIR}/../lib

echo '
{
    "type" : "jdbc",
    "jdbc" : {
        "url" : "jdbc:mysql://你的mysql地址:3306/shopyii",
        "schedule" : "0 0-59 0-23 ? * *",
        "user" : "mysql用户名",
        "password" : "mysql密码",
        "sql":"select productid,title,descr,productid as _id from shop_product where ison!='1'",
        "index" : "shopyii",
        "type" : "products",
        "elasticsearch" : {
             "cluster" : "yii2-search",
             "host" : "你的ElasticSearch日常地址",
             "port" : 9300
        }
    }
}
' | java \
    -cp "${lib}/*" \
    -Dlog4j.configurationFile=${bin}/log4j2.xml \
    org.xbib.tools.Runner \
    org.xbib.tools.JDBCImporter
