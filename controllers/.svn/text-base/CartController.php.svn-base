<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/18/0018
 * Time: 16:02
 */

namespace app\controllers;

use app\models\Cart;
use app\models\User;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class CartController extends CommonController
{
    protected $ismustLogin=['index','add','del','mod'];

    public $layout = false;

    public function actionIndex()
    {

        $this->layout = 'layout1';
        return $this->render('index');
    }

    public function actionAdd()
    {

        $userid=Yii::$app->user->id;
        $data['Cart']['userid'] = $userid;

        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $data['Cart']['productid'] = $post['productid'];
            $data['Cart']['productnum'] = $post['productnum'];


        } else if (Yii::$app->request->isGet) {
            if(empty(Yii::$app->request->get('productid')))
            {
                $this->redirect(['index/index']);
               Yii::$app->end();
            }
            $data['Cart']['productid'] = Yii::$app->request->get('productid');
            $data['Cart']['productnum'] = 1;
        }

        $cart = Cart::find()->where('productid=:id and userid=:userid', ['id' => $data['Cart']['productid'], 'userid' => $userid])->one();
        if (is_null($cart)) {
//            表示购物车里没有这件商品
            $cart = new Cart;
        } else {
//        true 表示购物车里有这件商品
            $data['Cart']['productnum'] += $cart->productnum;
        }
        $cart->load($data);
        $cart->save();
        $this->redirect(['cart/index']);


    }
    public function actionMod()
    {

        $post=Yii::$app->request->post();
        $cartid=$post['cartid'];
        $type=$post['type'];
        $userid=Yii::$app->user->id;
        $cart=Cart::find()->where('cartid=:cid and userid=:uid',['cid'=>$cartid,'uid'=>$userid])->one();
        $flag=1;
        if(is_null($cart))
        {
          $flag=0;
        }
        else
        {
           if($type=='add')
           {
             if($cart->productnum>=99)
             {
                $flag=0;
             }
             else
             {
                $num=$cart->productnum+1;
             }
           }
           else if($type='del')
           {
               if($cart->productnum<=1)
               {
                   $flag=0;
               }
               else
               {
                   $num=$cart->productnum-1;
               }
           }
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($flag)
        {
           $cart->productnum=$num;
           $cart->save();
//            Cart::updateAll(['productnum'=>$num],'cartid=:cid and userid=:uid',['cid'=>$cartid,'uid'=>$userid]);
            return [
                'errorCode'=>1,
                'msg'=>'修改成功'
            ];
        }
        else
        {

            return [
               'errorCode'=>0,
                'msg'=>'修改失败'
            ];
        }



    }
    public function actionDel()
    {

        $post=Yii::$app->request->post();
        $cartid=$post['cartid'];
        $userid=Yii::$app->user->id;
        $cart=Cart::find()->where('cartid=:cid and userid=:uid',['cid'=>$cartid,'uid'=>$userid])->one();
        $flag=1;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(is_null($cart))
        {

            return [
                'errorCode'=>0,
                'msg'=>'删除失败'
            ];
        }
        else
        {
            Cart::deleteAll('cartid=:cid and userid=:uid',['cid'=>$cartid,'uid'=>$userid]);
            return [
                'errorCode'=>1,
                'msg'=>'删除成功'
            ];
        }

    }
}