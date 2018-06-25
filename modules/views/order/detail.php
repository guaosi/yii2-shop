<?php
use yii\helpers\Url;
$this->title='订单详情';
$this->params['breadcrumbs'][]=['label'=>' > 订单列表','url'=>'/admin/order/list.html'];
$this->params['breadcrumbs'][]='> '.$this->title;
?>
        <!-- end sidebar -->
        <!-- main container -->

            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>订单详情</h3></div>
                    <div class="row-fluid">
                        <p>订单编号：<?=$order->order_no?></p>
                        <p>下单用户：<?=$order->user->username?></p>
                        <p>收货人名：<?=$order->receiver?></p>
                        <p>收货地址：<?=$order->address?></p>
                        <p>订单总价：<?=$order->amount?></p>
                        <p>快递方式：<?=Yii::$app->params['express'][$order->expressid]?></p>
                        <?php if ($order->status == 220): ?>
                        <p>快递编号：<?=$order->expressno?></p>
                        <?php endif; ?>
                        <p>订单状态：<?=Yii::$app->params['orderstatus'][$order->status]?></p>
                        <p>商品列表：</p>
                        <p>
                        <?php foreach ($order->orderDetail as $val):?>
                            <div style="display:inline">
                        <img src="http://<?=$val->cover?>-cobersamall"><?=$val->productnum?> x <a href="<?=Url::to(['/product/detail','productid'=>$val->productid])?>" target="_blank"><?=$val->title?></a>
                            </div>
                        <?php endforeach;?>
                        </p>
                    </div>
                </div>
            </div>

        <!-- scripts -->
