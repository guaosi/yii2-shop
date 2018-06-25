<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/25/0025
 * Time: 20:13
 */
namespace app\modules\controllers;
use app\models\Order;
use yii\data\Pagination;
use yii\web\Controller;
use Yii;
class OrderController extends CommonController
{
    protected $ismustLogin=['detail','list','send','changeexpress'];

    public function actionDetail()
    {
        $orderid=Yii::$app->request->get('orderid');
        if(empty($orderid))
        {
            $this->redirect(['default/index']);
            Yii::$app->end();
        }
        $this->layout='layout1';
        $order=Order::find()->where('shop_order.orderid=:oid',['oid'=>$orderid])->joinWith(['user','orderDetail'])->one();
        return $this->render('detail',compact('order'));
    }
    public function actionList()
    {
        $this->layout='layout1';
        $admins=Order::find();
//        先获得总数；
        $count=$admins->count();
//        可以从配置文件中获得分页大小
        $pageSize=Yii::$app->params['pageSize']['orderSize'];
//        实例化分类
        $pager=new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
        $orders=$admins->offset($pager->offset)->limit($pager->pageSize)->joinWith(['user','orderDetail'])->orderBy('updatetime desc')->all();
        return $this->render('list',compact('orders','pager'));

    }
    public function actionSend()
    {
     if(Yii::$app->request->isPost)
     {
         $post=Yii::$app->request->post();
         $orderid=$post['Order']['orderid'];
         $type='send';
         if (!Order::checkSend($orderid,$type))
         {
             $this->redirect(['order/list']);
             Yii::$app->end();
         }
         $order=new Order();
         if($order->send($post))
         {
             Yii::$app->session->setFlash('info','快递单号添加成功');
             $this->redirect(['order/list']);
             Yii::$app->end();
         }
         else
         {
             Yii::$app->session->setFlash('info','快递单号添加失败');
             $this->redirect(['order/send','orderid'=>$orderid]);
             Yii::$app->end();
         }
     }
     else {
         $orderid = Yii::$app->request->get('orderid');
         $type='send';
         if (!Order::checkSend($orderid,$type))
         {
             $this->redirect(['order/list']);
             Yii::$app->end();
         }
         $order=new Order();
         $this->layout='layout1';
         return $this->render('send',compact('order','orderid'));
     }

    }
    public function actionChangeexpress()
    {
        if(Yii::$app->request->isPost)
        {
            $post=Yii::$app->request->post();
            $orderid=$post['Order']['orderid'];
            $type='change';
            if (!Order::checkSend($orderid,$type))
            {
                $this->redirect(['order/list']);
                Yii::$app->end();
            }
            $order=new Order();
            if($order->send($post))
            {
                Yii::$app->session->setFlash('info','快递单号修改成功');
                $this->redirect(['order/changeexpress','orderid'=>$orderid]);
                Yii::$app->end();
            }
            else
            {
                Yii::$app->session->setFlash('info','快递单号修改失败');
                $this->redirect(['order/changeexpress','orderid'=>$orderid]);
                Yii::$app->end();
            }
        }
        else {
            $orderid = Yii::$app->request->get('orderid');
            $type='change';
            if (!Order::checkSend($orderid,$type))
            {
                $this->redirect(['order/list']);
                Yii::$app->end();
            }
            $order=Order::find()->where('orderid=:oid',['oid'=>$orderid])->one();
            $orderid=$order->orderid;
            $this->layout='layout1';
            return $this->render('change',compact('order','orderid'));
        }

    }
}