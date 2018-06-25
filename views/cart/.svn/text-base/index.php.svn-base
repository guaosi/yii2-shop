<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title='购物车';
?>

    <!-- ============================================================= HEADER : END ============================================================= -->		<section id="cart-page">

        <div class="container">
            <?php if(Yii::$app->session->hasFlash('checknum')):?>
            <span style="color: red"><?=Yii::$app->session->getFlash('checknum')?></span>
            <?php endif;?>

            <?php $form = ActiveForm::begin([
                'action' => yii\helpers\Url::to(['order/check']),
            ]) ?>
            <!-- ========================================= CONTENT ========================================= -->
            <div class="col-xs-12 col-md-9 items-holder no-margin">
                <?php if($this->params['footer']['cart']):?>

                    <?php foreach($this->params['footer']['cart'] as $key=>$val):?>

                <div class="row no-margin cart-item">
                    <div class="col-xs-12 col-sm-2 no-margin">
                        <a href="<?=Url::to(['product/detail','productid'=>$val->product['0']->productid])?>" class="thumb-holder">
                            <img class="lazy" alt="<?=$val->product['0']->title?>" src="http://<?=$val->product['0']->cover?>-cobersamall" />
                        </a>
                    </div>

                    <div class="col-xs-12 col-sm-5 ">
                        <div class="title">
                            <a href="<?=Url::to(['product/detail','productid'=>$val->product['0']->productid])?>"><?=$val->product['0']->title?></a>
                        </div>
<!--                        <div class="brand">sony</div>-->
                    </div>
                    <?php $price=$val->product['0']->issale?$val->product['0']->saleprice:$val->product['0']->price?>
                    <div class="col-xs-12 col-sm-3 no-margin">
                        <div class="quantity">
                            <div class="le-quantity">

                                    <a class="minus" href="#reduce"></a>
                                    <input  class="productc<?=$val->cartid?>" price-id="<?=$price?>" cart-id="<?=$val->cartid?>" name="productnum" readonly="readonly" type="text" value="<?=$val->productnum?>" />
                                    <a class="plus" href="#add"></a>

                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-2 no-margin">
                        <div class="price">

                            ￥<?=$price?>
                        </div>
                        <a class="close-btn" href="javaScript:;"></a>
                    </div>
                </div><!-- /.cart-item -->
                        <?php endforeach;?>
                <?php endif;?>
            </div>
            <!-- ========================================= CONTENT : END ========================================= -->

            <!-- ========================================= SIDEBAR ========================================= -->

            <div class="col-xs-12 col-md-3 no-margin sidebar ">
                <div class="widget cart-summary">
                    <h1 class="border">商品购物车</h1>
                    <div class="body">
                        <ul class="tabled-data no-border inverse-bold">
                            <li>
                                <label>购物车总价</label>
                                <div class="value pull-right">￥<span><?=number_format($this->params['footer']['carttotalprice'], 2)?></span></div>
                            </li>
                        </ul>
                        <ul id="total-price" class="tabled-data inverse-bold no-border">
                            <li>
                                <label>订单总价</label>
                                <div class="value pull-right">￥<span><?=number_format($this->params['footer']['carttotalprice'], 2)?></span></div>
                            </li>
                        </ul>
                        <div class="buttons-holder">
                            <input type='submit' class="le-button big" value="去结算">
                            <a class="simple-link block" href="<?=Url::to(['index/index'])?>" >继续购物</a>
                        </div>
                    </div>
                </div><!-- /.widget -->

                <div id="cupon-widget" class="widget">
                    <h1 class="border">使用优惠券</h1>
                    <div class="body">
                        <form>
                            <div class="inline-input">
                                <input data-placeholder="请输入优惠券码(暂时无效)" type="text" />
                                <button class="le-button" type="button">使用</button>
                            </div>
                        </form>
                    </div>
                </div><!-- /.widget -->
            </div><!-- /.sidebar -->

            <!-- ========================================= SIDEBAR : END ========================================= -->
        </div>
    </section>		<!-- ============================================================= FOOTER ============================================================= -->
<?php ActiveForm::end(); ?>

<script>

    $('.plus').click(function () {
        var dom=$(this).prev();
        var num =  parseInt(dom.val());
        if(num>=99)
        {
            dom.val(98);
            return;
        }
        else
        {
            var type='add';
            var cartid=dom.attr('cart-id');
            changenum(cartid,type,dom);
        }

    });
    $('.minus').click(function () {
        var dom=$(this).next()
        var num = dom.val();
        if(num<=1)
        {
            dom.val(2);
            return;
        }
        else
        {

            var type='del';
            var cartid=dom.attr('cart-id');
            changenum(cartid,type,dom);
        }
    });
    function changenum(cartid,type,dom) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url:"<?=Url::to(['cart/mod'])?>",
            type:'post',
            data:{cartid:cartid,type:type,_csrf:csrfToken},
            dataType:'json',
            success:function (res) {
                if(!res.errorCode)
                {
                    alert(res.msg);
                }
                else
                {
                    var price=parseFloat(dom.attr('price-id'));
                    var totalprice=parseFloat($('.value.pull-right span').html().replace(',',''));
                    var flag=0;
                    if(type=='add')
                    {
                        var countprice=(totalprice*100+price*100)/100;
                        flag=1;
                    }
                    else if(type=='del')
                    {
                        var countprice=(totalprice*100-price*100)/100;
                        var flag=-1;

                    }
                    $('.basket-item-count span').html((parseInt($('.basket-item-count span').html())+flag));
                    var newprice=addComma(countprice.toFixed(2));
                    $('.value.pull-right span').html(newprice);
                    $('.total-price .value').html(newprice);
                }
            }
        })
    }



    $('.close-btn').click(function () {
        var dom=$(this).parent().prev().find('input');
        var cartid=dom.attr('cart-id');

      delcart(cartid,dom);

    });

    function delcart(cartid,dom) {
        var csrfToken = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            url:"<?=Url::to(['cart/del'])?>",
            type:'post',
            data:{cartid:cartid,_csrf:csrfToken},
            dataType:'json',
            success:function (res) {
                if(!res.errorCode)
                {
                    alert(res.msg);
                }
                else
                {
                    var num =  parseInt(dom.val());
                    var productc='.productc'+cartid;
                    var producttc='.producttc'+cartid;

                    var price=parseFloat(dom.attr('price-id'));
                    var totalprice=parseFloat($('.value.pull-right span').html().replace(',',''));
                    $(producttc).parent().parent().remove();
                    var countprice=(totalprice*100-price*100*num)/100;
                    var newprice=addComma(countprice.toFixed(2));
                    $('.basket-item-count span').html((parseInt($('.basket-item-count span').html())-num));
                    $('.value.pull-right span').html(newprice);
                    $('.total-price .value').html(newprice);
                    $(productc).parent().parent().parent().parent().remove();

                }
            }
        })
    }
</script>
