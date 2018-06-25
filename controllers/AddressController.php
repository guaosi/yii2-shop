<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/24/0024
 * Time: 21:48
 */
namespace app\controllers;
use app\models\Address;
use Yii;
class AddressController extends CommonController
{
    protected $ismustLogin=['add','del'];
    public function actionAdd()
    {
      $post=Yii::$app->request->post();
      $address=new Address();
      $address->firstname=$post['firstname'];
      $address->lastname=$post['lastname'];
      $address->address=$post['firstaddress'].$post['lastaddress'];
      $address->postcode=$post['postcode']?$post['postcode']:'';
      $address->telephone=$post['telephone'];
      $address->createtime=time();
      $address->userid=Yii::$app->user->id;
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if($address->save())
      {
          $id = $address->attributes['addressid'];
         return [
             'errorCode'=>1,
             'msg'=>'地址保存成功',
             'address'=>$id
         ];
      }
      else
      {
          return [
              'errorCode'=>0,
              'msg'=>'地址保存失败'
          ];
      }

    }
    public function actionDel()
    {
      $addressid=Yii::$app->request->post('addressid');
      $addressobj=Address::find()->where('addressid=:aid and userid=:id',['aid'=>$addressid,'id'=>Yii::$app->user->id])->one();
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      if(is_null($addressobj))
      {
          return [
              'errorCode'=>0,
              'msg'=>'无法删除他人地址或地址不存在'
          ];
      }
      else
      {
          $addressobj->deleteAll('addressid=:aid',['aid'=>$addressid]);
          return [
              'errorCode'=>1,
              'msg'=>'删除成功'
          ];
      }
    }
}