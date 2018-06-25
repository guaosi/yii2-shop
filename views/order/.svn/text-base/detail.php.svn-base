<?php
use yii\helpers\Url;
$this->title='订单详情';
?>
    <!-- ============================================================= HEADER : END ============================================================= -->		<!-- ========================================= CONTENT ========================================= -->

    <section id="checkout-page">
        <div class="container">
            <div class="col-xs-12 no-margin">
                <section id="shipping-address" style="margin-bottom:100px;margin-top:-10px">
                    <h2 class="border h1">订单信息</h2>
                    <div class="row field-row" style="margin-top:10px">

                        <div class="col-xs-12">
                            <span class="simple-link bold" ">订单编号:   <span class="simple-link bold" "><?=$orders->order_no?></span></span><br><br>
                            <span class="simple-link bold" ">下单时间:  <span class="simple-link bold" "><?=date('Y-m-d H:i:s',$orders->createtime)?></span></span><br><br>
                            <?php if($orders->status==220||$orders->status==260):?>
                                <span class="simple-link bold" ">快递类型:  <span class="simple-link bold" "><?=Yii::$app->params['express'][$orders->expressid]?></span></span><br><br>
                                <span class="simple-link bold" ">快递单号:  <span class="simple-link bold" "><?=$orders->expressno?></span></span><br><br>
                            <?endif;?>
                            <span class="simple-link bold" ">收货信息:  <span class="simple-link bold" "><?=$orders->address?>&nbsp;&nbsp;<?=$orders->receiver?>&nbsp;&nbsp;<?=hidtel($orders->telephone)?></span></span><br><br>
                            <span class="simple-link bold" ">订单状态:  <span class="simple-link bold" "><?=Yii::$app->params['orderstatus'][$orders->status]?></span></span><br><br>


                        </div>
                    </div><!-- /.field-row -->
                </section>

                <section id="your-order">
                    <h2 class="border h1">您的订单详情</h2>
                    <?php foreach ($orders->orderDetail as $val):?>
                        <div class="row no-margin order-item">
                            <div class="col-xs-12 col-sm-1 no-margin">
                                <a href="javaScript:;" class="qty"><?=$val->productnum?> x</a>
                            </div>

                            <div class="col-xs-12 col-sm-9 ">
                                <div class="title">
                                    <a href="<?=Url::to(['product/detail','productid'=>$val->productid])?>" target="_blank" class="thumb-holder">
                                        <img class="lazy" alt="<?=$val->title?>" src="http://<?=$val->cover?>-cobersamall" />
                                    </a>
                                    <a  target="_blank" style="margin-left:50px" href="<?=Url::to(['product/detail','productid'=>$val->productid])?>"><?=$val->title?></a>
                                    <!--                                <div class="brand">sony</div>-->
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-2 no-margin">
                                <div class="price"> ￥ <?=$val->price?></div>
                            </div>
                        </div><!-- /.order-item -->
                    <?php endforeach;?>
                </section><!-- /#your-order -->

                <div id="total-area" class="row no-margin">
                    <div class="col-xs-12 col-lg-4 col-lg-offset-8 no-margin-right">
                        <div id="subtotal-holder">
                            <ul class="tabled-data inverse-bold no-border">
                                <li>
                                    <label>商品总价</label>
                                    <div style="width:100%;text-align:right" class="value ordervalue">￥ <span><?=number_format($orders->amount-Yii::$app->params['expressPrice'][$orders->expressid], 2)?></span></div>
                                </li>
                                <li>
                                    <label>快递</label>
                                    <div style="width:100%;text-align:right" class="value">
                                        <div class="radio-group">
                                            <input checked="checked" class="le-radio" type="radio" name="expresstype">
                                                <div class="radio-label bold">
                                                    <?=Yii::$app->params['express'][$orders->expressid]?>
                                                    <span class="bold"> ￥                                                                      <span class="ordertotalprice"><?=number_format(Yii::$app->params['expressPrice'][$orders->expressid],'2')?></span>
                                                </span>
                                                </div>
                                                <br>
                                        </div>
                                    </div>
                                </li>
                            </ul><!-- /.tabled-data -->
                            <ul id="total-field" class="tabled-data inverse-bold ">
                                <li>
                                    <label>订单总额</label>
                                    <div class="value" style="width:100%;text-align:right">￥ <span class="orderallprice"><?=number_format($orders->amount, 2)?></span></div>
                                </li>
                            </ul><!-- /.tabled-data -->

                        </div><!-- /#subtotal-holder -->
                    </div><!-- /.col -->
                </div><!-- /#total-area -->

                <div id="payment-method-options">
                    <div class="payment-method-option">
                        <input checked="checked" class="le-radio" type="radio" name="paytype">
                        <div class="radio-label bold ">支付宝支付</div>
                    </div><!-- /.payment-method-option -->
                </div><!-- /#payment-method-options -->

                <div class="place-order-button">
                    <?php if($orders->status==0||$orders->status==201):?>
                        <a href="<?=Url::to(['order/payorder','orderid'=>$orders->orderid])?>" class="le-button big">去支付</a>
                    <?php else:?>
                        <a href="<?=Url::to(['order/index'])?>" class="le-button big">返回订单</a>
                    <?endif;?>
                </div><!-- /.place-order-button -->
            </div><!-- /.col -->
        </div><!-- /.container -->
    </section><!-- /#checkout-page -->


    <!-- ========================================= CONTENT : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->
