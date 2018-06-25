<?php
use yii\helpers\Url;
$this->title='订单列表';
$this->params['breadcrumbs'][]='> '.$this->title;
?>

            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>订单列表</h3></div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <?php if(Yii::$app->session->hasFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span2 sortable">
                                        <span class="line"></span>订单编号</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>下单人</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>收货地址</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>快递方式</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>订单总价</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>商品列表</th>
                                    <th class="span3 sortable">
                                        <span class="line"></span>订单状态</th>
                                    <th class="span2 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <?php foreach ($orders as $order):?>
                                <tr class="first">
                                    <td><?=$order->order_no?></td>
                                    <td><?=$order->user->username?></td>
                                    <td><?=$order->address?></td>
                                    <td><?=Yii::$app->params['express'][$order->expressid]?></td>
                                    <td><?=number_format($order->amount,2)?> 元</td>
                                    <td>
                                        <?php foreach ($order->orderDetail as $key=>$val):?>
                                        <?=$val->productnum?> x
                                        <a href="<?=Yii::$app->urlManager->createAbsoluteUrl(['product/detail','productid'=>$val->productid])?>"><?=$val->title?></a>
                                        <?php if($key>=2){break;}?>
                                        <?php endforeach;?> <?php if($key>=2):?>等<?php endif?>
                                    </td>
                                    <td>
                                        <?php
                                        if (in_array($order->status, [0])) {
                                            $info = "error";
                                        }

                                        if (in_array($order->status, [202])) {
                                            $info = "info";
                                        }

                                        if (in_array($order->status, [101,201,301])) {
                                            $info = "warning";
                                        }

                                        if (in_array($order->status, [220,260])) {
                                            $info = "success";
                                        }
                                        ?>
                                    <span class="label label-<?=$info?>"> <?=Yii::$app->params['orderstatus'][$order->status]?></span>
                                    <?php if($order->isdelete==1):?>
                                        <span class="label label-success>">
                                            已删除
                                        </span>
                                    <?php endif;?>
                                    </td>
                                    <td class="align-right">
                                        <?php if ($order->status == 202): ?>
                                            <a href="<?=Url::to(['order/send', 'orderid' => $order->orderid]) ?>">发货</a>
                                        <?php endif; ?>
                                            <?php if ($order->status == 220): ?>
                                                <a href="<?=Url::to(['order/changeexpress', 'orderid' => $order->orderid]) ?>">修改快递</a>
                                        <?php endif; ?>
                                        <a href="<?=Url::to(['order/detail','orderid'=>$order->orderid])?>">查看</a></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>

                    </div>
                    <div class="pagination pull-right">                        <?=yii\widgets\LinkPager::widget(['pagination'=>$pager,'prevPageLabel'=>'&#8249','nextPageLabel'=>'&#8250'])?></div>
                    <!-- end users table --></div>
            </div>

