<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/18/0018
 * Time: 16:10
 */

namespace app\controllers;

use app\models\Address;
use app\models\Cart;
use app\models\Order;
use app\models\OrderDetail;
use app\models\Product;
use Yii;
use yii\data\Pagination;
use dzer\express\Express;
use yii\db\Exception;

class OrderController extends CommonController
{
    protected $ismustLogin = ['index', 'check', 'add', 'payorder', 'getexpress', 'orderconfirm', 'orderdel'];


    public $layout = false;

    public function actionIndex()
    {
        $this->layout = 'layout2';
        $admins = Order::find()->with(['orderDetail'])->where('shop_order.userid=:uid and isdelete=0', ['uid' => Yii::$app->user->id]);
//        先获得总数；
        $count = $admins->count();
//        可以从配置文件中获得分页大小
        $pageSize = Yii::$app->params['pageSize']['orderIndexSize'];
//        实例化分类
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $orders = $admins->offset($pager->offset)->limit($pager->pageSize)->orderBy('createtime desc')->all();
        return $this->render('index', compact('orders', 'pager'));
    }

    public function actionCheck()
    {
        $this->layout = 'layout1';
        if (Yii::$app->request->isPost) {
            $carts = Cart::find()->where('userid=:id', ['id' => Yii::$app->user->id])->all();

            if (!$carts) {
                $this->redirect(['cart/index']);
                Yii::$app->session->setFlash('checknum', '您还没有添加商品，无法进行结算');
                Yii::$app->end();
            }
            if (!Product::checknum($carts)) {
                Yii::$app->session->setFlash('checknum', '部分商品库存量不足，请检查后再进行结算');
                $this->redirect(['cart/index']);
            }
            $products = Cart::find()->joinWith('product')->where('userid=:uid', ['uid' => Yii::$app->user->id])->all();
            $addresses = Address::find()->where('userid=:id', ['id' => Yii::$app->user->id])->all();
            return $this->render('check', compact('products', 'addresses'));


        } else if (Yii::$app->request->isGet) {
            if (empty(Yii::$app->request->get('orderid'))) {
                $this->redirect(['index/index']);
                Yii::$app->end();
            }
            $orderid = Yii::$app->request->get('orderid');
            $order = Order::find()->where('userid=:uid and orderid=:oid', ['uid' => Yii::$app->user->id, 'oid' => $orderid])->one();

            if (!$order || $order->isdelete == 1) {
                throw new Exception('订单状态错误');
            }
            $orders = Order::find()->innerjoinWith(['orderDetail'])->where('shop_order.userid=:uid and shop_order.orderid=:oid', ['uid' => Yii::$app->user->id, 'oid' => $orderid])->one();
            return $this->render('detail', compact('orders'));
        }

    }

//    检验两次  一次是插入订单的时候 还有一次是支付的时候
    public function actionAdd()
    {
        if (Yii::$app->request->isPost) {
            $carts = Cart::find()->where('userid=:id', ['id' => Yii::$app->user->id])->all();
            if (is_null($carts)) {
                Yii::$app->session->setFlash('checknum', '购物车中没有商品，无法提交订单');
                $this->redirect(['cart/index']);
                Yii::$app->end();
            }
            $addressid = Yii::$app->request->post('submitaddressid');
            $addressobj = Address::find()->where('userid=:id and addressid=:aid', ['id' => Yii::$app->user->id, 'aid' => $addressid])->one();
            $express = Yii::$app->request->post();
            $express = $express['express'];
            if (!$addressid || is_null($addressobj)) {
                $this->redirect(['cart/index']);
                Yii::$app->session->setFlash('checknum', '没有收货地址，不允许提交订单');
                Yii::$app->end();
            }
            if (empty(Yii::$app->params['expressPrice'][$express])) {
                $this->redirect(['cart/index']);
                Yii::$app->session->setFlash('checknum', '快递参数状态不正确');
                Yii::$app->end();
            }

            //            开启事务锁机制
            $transaction = Yii::$app->db->beginTransaction();
            try {
                //           检查库存量
                $result = Product::checknum($carts);
                if (!$result) {
                    throw new \Exception('部分商品库存量不足，请检查后再进行结算');
                } //                库存量充足时，插入数据
                else {
                    //减少商品库存量
                    for ($i = 0; $i < count($result) - 1; $i++) {
                        if (!Product::updateAll(['num' => $result[$i]['pproductnum'] - $result[$i]['productnum'], 'updatetime' => time()], 'productid=:pid', ['pid' => $result[$i]['productid']])) {
                            throw new Exception('购买失败');
                        }
                    }


//                 添加订单表
                    $data1['order_no'] = Order::makeOrderNo();
                    $data1['userid'] = Yii::$app->user->id;
//                 个人信息也要写入

                    $data1['address'] = $addressobj->address;
                    $data1['receiver'] = $addressobj->firstname . $addressobj->lastname;
                    $data1['telephone'] = $addressobj->telephone;

                    $data1['expressid'] = $express;
                    $expressPrice = Yii::$app->params['expressPrice'][(int)$express];
                    $data1['amount'] = $result['totalPrice'] + $expressPrice;

                    $data1['status'] = Order::CREATEORDER;
                    $data1['createtime'] = time();
                    $orderData['Order'] = $data1;
                    $orderModel = new Order();
                    $newid = $orderModel->add($orderData);
                    if (!$newid) {
                        throw new \Exception('购买失败');
                    }
//                   添加到订单-商品表

                    for ($i = 0; $i < count($result) - 1; $i++) {
                        $data2['OrderDetail']['productid'] = $result[$i]['productid'];
                        $data2['OrderDetail']['title'] = $result[$i]['title'];
                        $data2['OrderDetail']['cover'] = $result[$i]['cover'];
                        $data2['OrderDetail']['price'] = $result[$i]['price'];
                        $data2['OrderDetail']['productnum'] = $result[$i]['productnum'];
                        $data2['OrderDetail']['orderid'] = $newid;
                        $data2['OrderDetail']['createtime'] = time();
                        $orderDetailModel = new OrderDetail();
                        if (!$orderDetailModel->add($data2)) {
                            throw new \Exception('购买失败');
                        }

                        //              清空购物车，等成功付款后再
                        Cart::deleteAll('productid=:pid and userid=:uid', ['pid' => $result[$i]['productid'], 'uid' => Yii::$app->user->id]);
//                      订单未支付，半小时过期
                        $redis = Yii::$app->redis;
                        $redis->select(5);
                        $redis->setex($data1['order_no'], Yii::$app->params['orderExpire'], $data1['order_no']);
                        $this->redirect(['order/payorder', 'orderid' => $newid]);
                    }
                }
                $transaction->commit();
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('checknum', $e->getMessage());
                $transaction->rollBack();
                $this->redirect(['cart/index']);
            }
        }
    }

    public function actionPayorder()
    {
        $orderid = Yii::$app->request->get('orderid');
        if (empty($orderid)) {
            $this->redirect(['index/index']);
            Yii::$app->end();
        }
        $order = Order::find()->joinWith('orderDetail')->where('userid=:uid and shop_order.orderid=:oid', ['uid' => Yii::$app->user->id, 'oid' => $orderid])->one();
        if (!$order) {
            $this->redirect(['index/index']);
            Yii::$app->end();
        }
//        检测order是否需要支付，不需要则跳回购物车
        if ($order->status != 0) {
            Yii::$app->session->setFlash('checknum', '订单状态不正确');
            $this->redirect(['cart/index']);
            Yii::$app->end();
        }
//       全部通过后再行付款
        $giftname = "渣渣商城";
        $orderno = $order->order_no;
        $amount = $order->amount;
        $title = '';

        foreach ($order->orderDetail as $key => $val) {
            $title .= $val->title . ',';
        }
        $title = rtrim($title, ',');
        if ($key >= 2) {
            $title .= $title . ' 等商品';
        }
        $showUrl = "http://shopyii.guaosi.com.cn";
        $this->Alipay($orderno, $giftname, $amount, $title);
    }


    private function Alipay($orderno, $subject, $amount, $body)
    {
        require_once '../vendor/Alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php';
        require_once '../vendor/Alipay/pagepay/service/AlipayTradeService.php';
        $alipay = new \AlipayTradePagePayContentBuilder();
        $alipay->setOutTradeNo($orderno);
        $alipay->setBody($body);
        $alipay->setSubject($subject);
        $alipay->setTotalAmount($amount);
        $config = Yii::$app->params['AlipayConfig'];
        $serviceObj = new \AlipayTradeService($config);
        $result = $serviceObj->pagePay($alipay, $config['return_url'], $config['notify_url']);
        var_dump($result);
    }

    public function actionGetexpress()
    {
        $this->layout = false;
        if (Yii::$app->request->isPost) {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if (Yii::$app->user->isGuest) {
                return [
                    'errorCode' => 0,
                    'msg' => '不允许未登录查询物流信息',
                    'message' => 'fail'
                ];
            } else {
                $express = Yii::$app->request->post('express');
                $expressno = Order::find()->where('expressno=:exp and userid=:uid', ['exp' => $express, 'uid' => Yii::$app->user->id])->one();
                if (empty($expressno)) {

                    return [
                        'errorCode' => 0,
                        'msg' => '不允许获取非本人的快递物流',
                        'message' => 'fail'
                    ];
                } else {
                    $rs = Express::search($express);
                    echo $rs;
                }
            }

        }
    }

    public function actionOrderconfirm()
    {
        $orderid = Yii::$app->request->get('orderid');
        if (Order::checkordermyself($orderid)) {

            if (Order::find()->where('orderid=:oid', ['oid' => $orderid])->one()->status == 220) {

                if (Order::updateAll(['status' => 260], 'orderid=:oid', ['oid' => $orderid])) {
                    Yii::$app->session->setFlash('order', '确认收货成功');
                } else {
                    Yii::$app->session->setFlash('order', '确认收货失败');
                }
            } else {
                Yii::$app->session->setFlash('order', '订单状态不正确');
            }

        } else {
            Yii::$app->session->setFlash('order', '不允许操作他人的订单');
        }
        $this->redirect(Yii::$app->request->referrer);
    }

    public function actionOrderdel()
    {
        $orderid = Yii::$app->request->get('orderid');
        if (Order::checkordermyself($orderid)) {
            $ordermodel = Order::find()->where('orderid=:oid', ['oid' => $orderid])->one();
            if (!$ordermodel || $ordermodel->isdelete == 1) {
                throw new Exception('订单状态错误');
            }
            $status = $ordermodel->status;
            if (in_array($status, [0, 101, 201, 202, 260, 301])) {
                if (in_array($status, [0, 201, 202])) {
//                    需要将订单里的商品恢复，并且状态改为301
//                        已过期状态，证明商品数量已经恢复,只需要修改状态
//                         其他的都需要恢复商品库存量
                    $msg = $ordermodel->order_no;
                    $orderdetails = OrderDetail::find()->where('orderid=:oid', ['oid' => $orderid])->all();
                    $trans = \Yii::$app->db->beginTransaction();
//            开始事务
                    try {

                        foreach ($orderdetails as $orderdetail) {
                            $product = Product::find()->where('productid=:pid', ['pid' => $orderdetail->productid])->one();

                            if (!Product::updateAll(['num' => $product->num + $orderdetail->productnum, 'updatetime' => time()], 'productid=:pid', ['pid' => $orderdetail->productid])) {
                                throw new Exception('订单' . $msg . '取消失败');
                            }

                        }
                        //                商品恢复成功,订单状态改为301(已取消);
                        Order::updateAll(['status' => 301], 'order_no=:order', ['order' => $msg]);
                        $trans->commit();
                    } catch (\Exception $e) {
//                更新失败，回退
                        $trans->rollBack();
                    }
//                    状态是    201, 202 可以进行退款

                    if ($status !== 0) {
                        if (!Order::onceRefund($ordermodel->tradeno, $ordermodel->amount, $msg)) {
                            throw new Exception("退款失败，请联系客服~");
                        }
                    }
                } else {
                    if (Order::updateAll(['isdelete' => 1], 'orderid=:oid', ['oid' => $orderid])) {
                        Yii::$app->session->setFlash('order', '删除订单成功');
                    } else {
                        Yii::$app->session->setFlash('order', '删除订单失败');
                    }
                }
            } else {
                Yii::$app->session->setFlash('order', '订单状态不正确');
            }
        } else {
            Yii::$app->session->setFlash('order', '不允许操作他人的订单');
        }
        $this->redirect(Yii::$app->request->referrer);
    }
}