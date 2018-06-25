<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/18/0018
 * Time: 16:02
 */

namespace app\controllers;

use app\models\Order;
use Yii;

require_once '../vendor/Alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
require_once '../vendor/Alipay/pagepay/service/AlipayTradeService.php';
class PayController extends CommonController
{
    protected $except=['returnurl','notifyurl'];
    public $enableCsrfValidation=false;
    public function actionReturnurl(){
        if(Yii::$app->request->isGet)
        {
            $this->layout = 'layout1';
            $data=Yii::$app->request->get();
            if(!empty($data['sign']))
            {
                $config=Yii::$app->params['AlipayConfig'];
                $serviceobj=new \AlipayTradeService($config);
                $result=$serviceobj->check($data);
                if($result)
                {
                    $status='ok';
                }
                else
                {
                    $status='fail';
                }
                return $this->render('status',compact('status'));
            }
            else
            {
                $this->redirect(['index/index']);
                Yii::$app->end();
            }
        }

    }
    public function actionNotifyurl()
    {
        if(Yii::$app->request->isPost)
        {
            $data=Yii::$app->request->post();
            $config=Yii::$app->params['AlipayConfig'];
            $serviceobj=new \AlipayTradeService($config);
            $result=$serviceobj->check($data);
            if($result)
            {
                if($data['trade_status']=='TRADE_SUCCESS')
                {
                    //总金额
                    $TotalAmount=$data['total_amount'];
                    //商户订单号
                    $out_trade_no = $data['out_trade_no'];
                    //支付宝交易号
                    $trade_no = $data['trade_no'];

                    $order=Order::find()->where('order_no=:no',['no'=>$out_trade_no])->one();

                    if($order->amount==$TotalAmount)
                    {
                        $status=202;
                        $redis=Yii::$app->redis;
                        $redis->select(5);
                        if(empty($redis->get($out_trade_no)))
                        {
                            $status=201;
//                            证明已经过期，直接退款
                            if(!Order::onceRefund($trade_no,$TotalAmount,$out_trade_no))
                            {
                                Yii::info('退款失败','myinfo');
                            }
                        }
                    }
                    else
                    {
                        $status=201;
                    }
                    Order::updateAll(['status'=>$status,'tradeno'=>$trade_no],'order_no=:no',['no'=>$out_trade_no]);
                        $redis=Yii::$app->redis;
                        $redis->select(5);
                        $redis->del($out_trade_no);
                }
                echo 'success';
            }
            else
            {
                echo '非法操作';
            }
        }
        else
        {
            $this->redirect(['index/index']);
            Yii::$app->end();
        }

    }
}