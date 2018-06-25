<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/18/0018
 * Time: 14:57
 */
namespace app\controllers;
use app\models\Brand;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Product;
use Yii;
use yii\db\Exception;

class IndexController extends CommonController
{
    protected $except=['index'];
    public function actionIndex()
    {
//        Yii::error('this is error');
//        Yii::info('this is info','myinfo');
//        Yii::$app->asyncLog->send(['this is kafka']);
        $this->layout="layout1";
        $dep=new \yii\caching\DbDependency([
            'sql'=>'select max(updatetime) from {{%product}} where ison="1"'
        ]);

        $data['sale']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1' and issale='1'")->limit(4)->orderBy('createtime desc')->all();
        },60,$dep);
        $data['tui']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1' and istui='1'")->orderBy('createtime desc')->limit(4)->all();
        },60,$dep);
        $data['new']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1'")->orderBy('createtime desc')->limit(7)->all();
        },60,$dep);
        $data['hot']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1' and ishot='1'")->orderBy('createtime desc')->limit(4)->all();
        },60,$dep);
//        浏览历史
        $cookie = \Yii::$app->request->cookies;
        if($cookie->has('producthistory'))
        {
            $prohistory=implode(',',json_decode($cookie->getValue('producthistory',[])));
            $sql="SELECT * FROM `shop_product` WHERE productid in ($prohistory) and ison='1'  ORDER BY field(productid, $prohistory)";
            $data['historyproduct']=\Yii::$app->getDb()->cache(function()use($sql){
                return \Yii::$app->getDb()->createCommand($sql)->queryAll();
            },60*5,$dep);
        }
//        品牌
        $data['brand']=Product::getDb()->cache(function (){
            return Brand::find()->where("isshow='1'")->orderBy('createtime desc')->limit(7)->all();
        },60,$dep);
        return $this->render('index',compact('data'));
    }
}