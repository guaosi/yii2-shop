<?php
use yii\helpers\Url;
$this->title='订单列表';
?>
    <!-- ============================================================= HEADER : END ============================================================= -->		<div id="single-product">

        <div class="container" style="padding-top:10px">
            <?php if(Yii::$app->session->hasFlash('order')){echo Yii::$app->session->getFlash('order');}?>
             <?foreach ($orders as $order):?>
            <div style="margin-bottom:30px;">
                <div class="trade-order-mainClose">
                    <div>
                        <table style="width:100%;border-collapse:collapse;border-spacing:0px;">
                            <colgroup>
                                <col style="width:40%;">
                                <col style="width:12%;">
                                <col style="width:7%;">
                                <col style="width:14%;">
                                <col style="width:14%;">
                                <col style="width:13%;">
<!--                                <col style="width:12%;">-->
                            </colgroup>
                            <tbody>
                            <tr style="background-color:#F5F5F5;width:100%">
                                <td style="padding:10px 20px;text-align:left;">
                                    <label>
                                        <input type="checkbox" disabled="" style="margin-right:8px;">
                                        <strong title="<?=date('Y-m-d H:i:s',$order->createtime)?>" style="margin-right:8px;font-weight:bold;">
                                            <?=date('Y-m-d H:i:s',$order->createtime)?>
                                        </strong>
                                    </label>
                                    <span>
                订单号：
              </span>
                                    <span>
              </span>
                                    <span>
                <?=$order->order_no?>
              </span>
                                </td>

                            </tr>
                            </tbody>
                        </table>
                        <table style="width:100%;border-collapse:collapse;border-spacing:0px;">
                            <colgroup>
                                <col style="width:40%;">
                                <col style="width:12%;">
                                <col style="width:7%;">
                                <col style="width:14%;">
                                <col style="width:14%;">
                                <col style="width:13%;">
<!--                                <col style="width:12%;">-->
                            </colgroup>
                            <tbody>
                            <?php foreach ($order->orderDetail as $key=>$val):?>
                            <tr>
                                <td style="text-align:left;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;padding-left:20px;">
                                    <div style="overflow:hidden;">
                                        <a class="tp-tag-a" href="<?=Url::to(['product/detail','productid'=>$val->productid])?>" style="float:left;width:27%;margin-right:2%;text-align:center;" target="_blank">
                                            <img src="http://<?=$val->cover?>-cobersamall" style="border:1px solid #E8E8E8;max-width:80px;">
                                        </a>
                                        <div style="float:left;width:71%;word-wrap:break-word;">
                                            <div style="margin:0px;">
                                                <a class="tp-tag-a" href="<?=Url::to(['product/detail','productid'=>$val->productid])?>" target="_blank">
                      <span>
                        <?=$val->title?>
                      </span>
                                                </a>
                                                <span>
                    </span>
                                            </div>
                                            <div style="margin-top:8px;margin-bottom:0;color:#9C9C9C;">
<!--                    <span style="margin-right:6px;">-->
<!--                      <span>-->
<!--                        颜色分类-->
<!--                      </span>-->
<!--                      <span>-->
<!--                        ：-->
<!--                      </span>-->
<!--                      <span>-->
<!--                        红银战争机器-英国-->
<!--                      </span>-->
<!--                    </span>-->
                                            </div>

                                            <span>
                  </span>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;">
                                    <div style="font-family:verdana;font-style:normal;">
<!--                                        <p>-->
<!--                                            <del style="color:#9C9C9C;">-->
<!--                                                198.00-->
<!--                                            </del>-->
<!--                                        </p>-->
                                        <p>
                                            <?=number_format($val->price,2)?>
                                        </p>
                                        <span>
                </span>
                                        <span>
                </span>
                                    </div>
                                </td>
                                <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;">
                                    <div>
                                        <div>
                                           数量: <?=$val->productnum?>
                                        </div>
                                    </div>
                                </td>
                                <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:1px;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;" >
                                    <div>
                                        <div style="margin-bottom:3px;">
                  <span>
                    <span class="trade-ajax">
                      <span class="trade-tooltip-wrap">
                        <span>
                          <span class="trade-operate-text">
                               单位:个

                          </span>
                        </span>
                      </span>
                      <noscript>
                      </noscript>
                    </span>
                  </span>
                                        </div>

                                    </div>
                                </td>

                                <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:1px;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;" >
                                <?php if($key==0):?>
                                    <div>
                                        <div style="font-family:verdana;font-style:normal;">
                  <span>
                  </span>
                                            <span>
                  </span>
                                            <p>
                                                <strong>
                                                    <?=number_format($order->amount,'2')?>
                                                </strong>
                                            </p>
                                            <span>
                  </span>
                                        </div>
                                        <p>
                  <span>
                    (含运费：
                  </span>
                                            <span>
                    <?=number_format(Yii::$app->params['expressPrice'][$order->expressid],'2')?>
                  </span>
                                            <span>
                  </span>
                                            <span>
                  </span>
                                            <span>
                    )
                  </span>
                                        </p>

                                        <div>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </td>
                                <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:1px;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;" >
                                    <?php if($key==0):?>
                                        <div>

                                        <div style="margin-bottom:3px;">
                                               <span><?=Yii::$app->params['orderstatus'][$order->status]?></span>

                                        </div>
                                            <?php if($order->status==220):?>
                                                <div style="margin-bottom:3px;margin-top: 7px">
                                                    <a class="tp-tag-a" href="javaScript:;" onclick="if(confirm('确定要确认收货吗?')){window.location.href='<?=Url::to(['order/orderconfirm','orderid'=>$order->orderid])?>'}">确认收货</a>

                                                </div>
                                            <?php endif;?>
                                        <?php if($order->status==0||$order->status==201):?>
                                        <div style="margin-bottom:3px;margin-top: 7px">
                                            <a class="tp-tag-a" href="<?=Url::to(['order/payorder','orderid'=>$order->orderid])?>" target="_blank">去支付</a>
                                        </div>
                                        <?endif;?>
                                        <div style="margin-bottom:3px;margin-top: 7px">

                                            <a class="tp-tag-a" href="<?=Url::to(['order/check','orderid'=>$order->orderid])?>" target="_blank">
                                                查看订单
                                            </a>

                                        </div>

                                        <?php if($order->status==220||$order->status==260):?>
                                        <div>
                                            <div style="margin-bottom:3px;margin-top: 7px">
                    <span>
                     <a data="<?=$order->expressno?>" class="tp-tag-a express" href="javaScript:;" target="_blank">
                        <span class="trade-operate-text">
                          查看物流
                        </span>
</a>
                        <div class="expressshow" style="overflow:auto;text-align:left;font-size:12px;width:200px;height:300px;position:absolute;border:1px solid #ccc;padding:15px;background-color:#eee" flag="false"><span style="color: #e74c3c">查询中...</span></div>

                    </span>
                                            </div>

                                        </div>
                                        <?endif;?>
                                            <?php if(in_array($order->status,[0,101,201,202,260,301])):?>
                                            <?php if(in_array($order->status,[0,201,202])){
                                                $info='取消订单';
                                                $info1='取消这个订单';
                                            }else if(in_array($order->status,[101,260,301])){$info='删除订单';$info1='删除这个订单';}?>

                                                <div>
                                                    <div style="margin-bottom:3px;margin-top: 7px">
                    <span>
                      <a class="tp-tag-a" href="javaScript:;" target="_blank"  onclick="if(confirm('确定要删除这个订单吗?')){window.location.href='<?=Url::to(['order/orderdel','orderid'=>$order->orderid])?>'}">
                        <span class="trade-operate-text">
                          <?=$info?>
                        </span>
                      </a>
                    </span>
                                                    </div>

                                                </div>
                                            <?endif;?>
                                            <?endif;?>
                                    </div>
                                </td>



<!--                                <td style="text-align:center;vertical-align:top;padding-top:10px;padding-bottom:10px;border-right-width:0;border-right-style:solid;border-right-color:#E8E8E8;border-top-width:0;border-top-style:solid;border-top-color:#E8E8E8;" >-->
<!--                                    <div>-->
<!--                                        <div style="margin-bottom:3px;">-->
<!--                  <span>-->
<!--                    <a class="tp-tag-a" href="" target="_blank">-->
<!--                      <span class="trade-operate-text">-->
<!--                        评论-->
<!--                      </span>-->
<!--                    </a>-->
<!--                  </span>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </td>-->


                            </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>

                        <div>
                        </div>
                    </div>
                </div>
            </div>
               <?php endforeach;?>
            <div class="pagination-holder">
                <div class="row">

                    <div class="col-xs-12 col-sm-6 text-left">
                        <?php echo yii\widgets\LinkPager::widget([
                            'pagination' => $pager,
                            'options' => ['class' => 'pagination '],
                            'prevPageLabel' => '上一页',
                            'nextPageLabel' => '下一页',
                        ]); ?>
                    </div>

                </div><!-- /.row -->
            </div>
        </div>
    <script>
        $(function () {
            $('body').click(function () {
                $(".expressshow").hide();
            });
            $(".expressshow").hide();
            $('.express').hover(function (event) {
                that=$(this);
                event.stopPropagation();
                if(that.next().attr('flag')=='false')
                {
                    var csrfToken = $('meta[name="csrf-token"]').attr("content");

                    var express=that.attr('data');
                    $.ajax({
                        url:"<?=Url::to(['order/getexpress'])?>",
                        type:'post',
                        data:{express:express,_csrf:csrfToken},
                        dataType:'json',
                        success:function (res) {
                            var str='';
                            if(res.message=='fail')
                            {
                                str += "<p>物流信息获取失败...</p>";
                            }
                            else
                            {

                                for(var i = 0;i<res.data.length;i++) {
                                    str += "<p>" + res.data[i].context + " " + res.data[i].time + " </p>";
                                    that.next().attr('flag','true');
                                }
                            }
                            that.next().children('span').html(str);
                            that.next().show();
                        }
                    })
                }
                else
                {
                    that.next().show();
                }

            });
        })

    </script>