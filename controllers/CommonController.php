<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/22/0022
 * Time: 22:41
 */
namespace app\controllers;
use app\models\Cart;
use app\models\Category;
use app\models\Product;
use app\models\User;
use function foo\func;
use yii\web\Controller;
use Yii;
class CommonController extends Controller
{
    protected $only=['*'];
    protected $except=[];
    protected $ismustLogin=[];
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'only'=>$this->only,
                'except'=>$this->except,
                'rules'=>[
                    [
                        'allow'=>false,
                        'actions'=>$this->ismustLogin,
                        'roles'=>['?']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>$this->ismustLogin,
                        'roles'=>['@']
                    ]
                ]
            ]
        ];
    }
    public function init()
    {

        $cache=Yii::$app->cache;
        $key='categorymenu';

        $categorymenu=$cache->get($key);
        if(!$categorymenu)
        {
            $categorys=Category::getCategorys();
            $cache->set($key,$categorys,3600*2);
        }
        else
        {
            $categorys=$categorymenu;
        }
        $this->view->params['menu']=$categorys;
//        购物车
        if(!Yii::$app->user->isGuest)
        {
            $userid = Yii::$app->user->identity->userid;
//            $cartkey1='cart'.$userid;
//            $cartkey2='cartcount'.$userid;
//            $cartkey3='carttotalprice'.$userid;
//            $cartcache=$cache->get($cartkey1);
//            if(!$cartcache)
//            {
                $products=Cart::find()->joinWith('product')->where('userid=:id',['id'=>$userid])->all();
                $data['cart']=$products;
//        计算总件数
                $count=0;
//        计算所有总价格
                $totalprice=0;
                foreach ($products as $val)
                {
                    $count+=$val->productnum;
                    $price=$val->product[0]->issale?$val->product[0]->saleprice:$val->product[0]->price;
                    $totalprice+=$price*$val->productnum;
                }
                $data['cartcount']=$count;
                $data['carttotalprice']=$totalprice;
//                $dep=new \yii\caching\DbDependency([
//                    'sql'=>'select max(updatetime) from {{%cart}} where userid=:uid',
//                    'params'=>[':uid'=>Yii::$app->user->id]
//                ]);

//                $cache->set($cartkey1,$data['cart'],60,$dep);
//                $cache->set($cartkey2,$data['cartcount'],60,$dep);
//                $cache->set($cartkey3,$data['carttotalprice'],60,$dep);
//            }
//            else
//            {
//                $data['cart']=$cartcache;
//                $data['cartcount']=$cache->get($cartkey2);
//                $data['carttotalprice']=$cache->get($cartkey3);
//
//            }


        }
        $dep=new \yii\caching\DbDependency([
            'sql'=>'select max(updatetime) from {{%product}} where ison="1"'
        ]);
//        底部栏目数据
        $data['sale']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1' and issale='1'")->limit(3)->orderBy('createtime desc')->all();
        },60*5,$dep);

        $data['tui']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1' and istui='1'")->orderBy('createtime desc')->limit(3)->all();
        },60*5,$dep);
        $data['new']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1'")->orderBy('createtime desc')->limit(3)->all();
        },60*5,$dep);
        $data['hot']=Product::getDb()->cache(function (){
            return Product::find()->where("ison='1' and ishot='1'")->orderBy('createtime desc')->limit(8)->all();
        },60*5,$dep);

        $cookie = \Yii::$app->request->cookies;
        if($cookie->has('producthistory'))
        {
            $prohistory=implode(',',json_decode($cookie->getValue('producthistory',[])));
            $sql="SELECT * FROM `shop_product` WHERE productid in ($prohistory) and ison='1'  ORDER BY field(productid, $prohistory)";
            $data['historyproduct']=\Yii::$app->getDb()->cache(function()use($sql){
                return \Yii::$app->getDb()->createCommand($sql)->queryAll();
            },60*5,$dep);
        }
        $this->view->params['footer']=$data;
    }
}