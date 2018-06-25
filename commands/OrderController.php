<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Product;
use yii\console\Controller;
use yii\db\Exception;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class OrderController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionRecover($host='你的redis所在IP地址',$port=6379)
    {
        $redis=new \Redis();
        $redis->connect($host,$port);
        $redis->select(5);
        $redis->setOption(\Redis::OPT_READ_TIMEOUT,-1);
        $redis->psubscribe(array('__keyevent@5__:expired'),array($this,'tcallback'));
    }
    public function tcallback($redis, $pattern, $chan, $msg)
    {
        $order=Order::find()->where('order_no=:order',['order'=>$msg])->one();
        if($order->status==0)
        {
            $orderdetails=OrderDetail::find()->where('orderid=:oid',['oid'=>$order->orderid])->all();

            $trans=\Yii::$app->db->beginTransaction();
//            开始事务
            try{
                foreach ($orderdetails as $orderdetail)
                {
                    $product=Product::find()->where('productid=:pid',['pid'=>$orderdetail->productid])->one();
                    if(!Product::updateAll(['num'=>$product->num+$orderdetail->productnum,'updatetime'=>time()],'productid=:pid',['pid'=>$orderdetail->productid]))
                    {
                       throw new Exception('订单'.$msg.'中的商品更新失败');
                    }
                }
//                商品恢复成功,订单状态改为101(订单过期);
                Order::updateAll(['status'=>101],'order_no=:order',['order'=>$msg]);
                $trans->commit();
            }catch (\Exception $e)
            {
//                更新失败，回退
                $trans->rollBack();
            }
        }
    }
}
