<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?=Yii::$app->language?>">
<head>
    <?php
    $this->registerMetaTag(['http-equiv'=>'Content-Type','content'=>'text/html; charset=UTF-8']);
    $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1.0, user-scalable=no']);
    $this->registerMetaTag(['name'=>'description','content'=>'渣渣商城']);
    $this->registerMetaTag(['name'=>'author','content'=>'guaosi']);
    $this->registerMetaTag(['name'=>'keywords','content'=>'guaosi,shop,yiii2']);
    $this->registerMetaTag(['name'=>'robots','content'=>'all']);
    ?>
    <meta charset="<?=Yii::$app->charset?>">
    <meta name="csrf-token" content="<?=Yii::$app->request->getCsrfToken() ?>">

    <title><?=$this->title?>-咸鱼商城</title>
    <?php $this->head();?>
</head>

<body>
<?php $this->beginBody(); ?>
<div class="wrapper">
    <!-- ============================================================= TOP NAVIGATION ============================================================= -->
    <nav class="top-bar animate-dropdown">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <ul>
                    <li><a href="/">首页</a></li>
                    <li><a href="<?=Url::to(['product/index'])?>">所有商品</a></li>
                    <li><a href="<?=Url::to(['cart/index'])?>">我的购物车</a></li>
                    <li><a href="<?=Url::to(['order/index'])?>">我的订单</a></li>
                </ul>
            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-6 no-margin">
                <ul class="right">
                    <?php if(!Yii::$app->user->isGuest):?>
                        <li>欢迎您,<?=Yii::$app->user->identity->username?></li>
                        <li><a href="<?=Url::to(['member/logout'])?>">退出</a></li>
                    <?php else:?>
                        <li><a href="<?=Url::to(['member/auth'])?>">注册</a></li>
                        <li><a href="<?=Url::to(['member/auth'])?>">登录</a></li>
                    <?php endif?>
                </ul>
            </div><!-- /.col -->
        </div><!-- /.container -->
    </nav><!-- /.top-bar -->
    <!-- ============================================================= TOP NAVIGATION : END ============================================================= -->		<!-- ============================================================= HEADER ============================================================= -->
    <header>
        <div class="container no-padding">

            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <!-- ============================================================= LOGO ============================================================= -->
                <div class="logo">
                    <a href="/">
                        <img alt="logo" src="/images/logo1.png" width="252" height="60"/>
                    </a>
                </div><!-- /.logo -->
                <!-- ============================================================= LOGO : END ============================================================= -->		</div><!-- /.logo-holder -->

            <div class="col-xs-12 col-sm-12 col-md-6 top-search-holder no-margin">
                <div class="contact-row">
                    <div class="phone inline">
                        <i class="fa fa-phone"></i> (+086) 123 456 7890
                    </div>
                    <div class="contact inline">
                        <i class="fa fa-envelope"></i> guaosi@<span class="le-color">vip.qq.com</span>
                    </div>
                </div><!-- /.contact-row -->
                <!-- ============================================================= SEARCH AREA ============================================================= -->
                <div class="search-area">
                    <?php $form=ActiveForm::begin([
                        'action'=>['product/search'],
                        'method'=>'get'
                    ])?>
                    <div class="control-group">
                        <input <?php if(!empty(Yii::$app->request->get('key_word'))):?>value="<?=Yii::$app->request->get('key_word')?>"<?php endif;?> class="search-field" name="key_word" placeholder="搜索商品" />



                        <a style="padding:15px 15px 13px 12px" class="search-button" href="javascript:document.getElementById('w0').submit()" ></a>

                    </div>
                    <?php ActiveForm::end()?>
                </div><!-- /.search-area --><!-- /.search-area -->
                <!-- ============================================================= SEARCH AREA : END ============================================================= -->		</div><!-- /.top-search-holder -->

            <?php if(!Yii::$app->user->isGuest):?>
            <?php $form = ActiveForm::begin([
                'action' => yii\helpers\Url::to(['order/check']),
            ]) ?>
            <div class="col-xs-12 col-sm-12 col-md-3 top-cart-row no-margin">
                <div class="top-cart-row-container">

                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="top-cart-holder dropdown animate-dropdown">

                        <div class="basket">


                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <div class="basket-item-count">
                                    <span class="count"><?=$this->params['footer']['cartcount']?></span>
                                    <img src="/images/icon-cart.png" alt="" />
                                </div>

                                <div class="total-price-basket">
                                    <span class="lbl">您的购物车:</span>
                                    <span class="total-price">
                        <span class="sign">￥</span><span class="value"> <?=number_format($this->params['footer']['carttotalprice'], 2)?> </span>
                    </span>
                                </div>
                            </a>

                            <ul class="dropdown-menu">
                                <?php if($this->params['footer']['cart']):?>
                                    <?php foreach($this->params['footer']['cart'] as $key=>$val):?>
                                        <li>
                                            <div class="basket-item">
                                                <div class="row">
                                                    <div class="col-xs-4 col-sm-4 no-margin text-center">
                                                        <div class="thumb">
                                                            <img class="lazy" alt="<?=$val->product['0']->title?>" src="http://<?=$val->product['0']->cover?>-cobersamall" />
                                                        </div>
                                                    </div>
                                                    <?php $price=$val->product['0']->issale?$val->product['0']->saleprice:$val->product['0']->price?>
                                                    <div class="col-xs-8 col-sm-8 no-margin">
                                                        <div class="title"><?=$val->product['0']->title?></div>
                                                        <div class="price">￥<?=$price?></div>
                                                    </div>
                                                </div>
                                                <?php $price=$val->product['0']->issale?$val->product['0']->saleprice:$val->product['0']->price?>
                                                <a class="close-btn1 producttc<?=$val->cartid?>" cart-id="<?=$val->cartid?>" href="javaScript:;" price-id="<?=$price?>" price-num="<?=$val->productnum?>"></a>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                <?php endif;?>
                                <li class="checkout">
                                    <div class="basket-item">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6">
                                                <a href="<?=Url::to(['cart/index'])?>" class="le-button inverse">查看购物车</a>
                                            </div>
                                            <div class="col-xs-12 col-sm-6">
                                                <input type='submit' class="le-button" value="去往收银台">
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div><!-- /.basket -->
                    </div><!-- /.top-cart-holder -->
                </div><!-- /.top-cart-row-container -->
                <!-- ============================================================= SHOPPING CART DROPDOWN : END ============================================================= -->		</div>
            <?php ActiveForm::end();?>
            <?php endif;?><!-- /.top-cart-row -->

        </div><!-- /.container -->

        <!-- ========================================= NAVIGATION ========================================= -->
        <nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
            <div class="container">
                <div class="yamm navbar">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mc-horizontal-menu-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div><!-- /.navbar-header -->
                    <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                        <ul class="nav navbar-nav">
                             <?php foreach($this->params['menu'] as $key=>$children):?>
                                 <?php if ($key>=8){break;}?>
                            <li class="dropdown">
                                <a href="<?=Url::to(['product/index','cateid'=>$children['cateid']])?>" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown"><?=$children['title']?></a>
                                <?php if(isset($children['children'])):?>
                                <ul class="dropdown-menu">

                                    <?php foreach ($children['children'] as $val):?>
                                    <li><a href="<?=Url::to(['product/index','cateid'=>$val['cateid']])?>"><?=$val['title']?></a></li>
                                    <?php endforeach;?>

                                </ul>
                                <?php endif;?>
                            </li>
                             <?php endforeach;?>
                        </ul><!-- /.navbar-nav -->
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.navbar -->
            </div><!-- /.container -->
        </nav><!-- /.megamenu-vertical -->
        <!-- ========================================= NAVIGATION : END ========================================= -->
</header>
<?=$content?>

<footer id="footer" class="color-bg">

    <div class="container">
        <div class="row no-margin widgets-row">
            <div class="col-xs-12  col-sm-4 no-margin-left">
                <!-- ============================================================= FEATURED PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>推荐商品</h2>
                    <div class="body">
                        <ul>
                            <?php if($this->params['footer']['tui']):?>
                                <?php foreach($this->params['footer']['tui'] as $val):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 no-margin">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                                <div class="price">
                                                    <?php if($val['issale']):?>
                                                        <div class="price-prev">￥<?=$val['saleprice']?></div>
                                                    <?php endif;?>
                                                    <div class="price-current">￥<?=$val['price']?></div>

                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 no-margin">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>" class="thumb-holder">
                                                    <img alt="" src="/images/blank.gif" data-echo="http://<?=$val['cover']?>-cobersamall" />
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div><!-- /.body -->
                </div> <!-- /.widget -->
                <!-- ============================================================= FEATURED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= ON SALE PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>促销商品</h2>
                    <div class="body">
                        <ul>
                            <?php if($this->params['footer']['sale']):?>
                                <?php foreach($this->params['footer']['sale'] as $val):?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 no-margin">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                                <div class="price">
                                                    <?php if($val['issale']):?>
                                                        <div class="price-prev">￥<?=$val['saleprice']?></div>
                                                    <?php endif;?>
                                                    <div class="price-current">￥<?=$val['price']?></div>

                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 no-margin">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>" class="thumb-holder">
                                                    <img alt="" src="/images/blank.gif" data-echo="http://<?=$val['cover']?>-cobersamall" />
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div><!-- /.body -->
                </div> <!-- /.widget -->
                <!-- ============================================================= ON SALE PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

            <div class="col-xs-12 col-sm-4 ">
                <!-- ============================================================= TOP RATED PRODUCTS ============================================================= -->
                <div class="widget">
                    <h2>最热商品</h2>
                    <div class="body">
                        <ul>
                            <?php if($this->params['footer']['hot']):?>
                                <?php foreach($this->params['footer']['hot'] as $key=>$val):?>
                                    <?php if($key>=3){break;}?>
                                    <li>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-9 no-margin">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                                <div class="price">
                                                    <?php if($val['issale']):?>
                                                        <div class="price-prev">￥<?=$val['saleprice']?></div>
                                                    <?php endif;?>
                                                    <div class="price-current">￥<?=$val['price']?></div>

                                                </div>
                                            </div>

                                            <div class="col-xs-12 col-sm-3 no-margin">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>" class="thumb-holder">
                                                    <img alt="" src="/images/blank.gif" data-echo="http://<?=$val['cover']?>-cobersamall" />
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div><!-- /.body -->
                </div><!-- /.widget -->
                <!-- ============================================================= TOP RATED PRODUCTS : END ============================================================= -->            </div><!-- /.col -->

        </div><!-- /.widgets-row-->
    </div><!-- /.container -->

    <div class="sub-form-row">
        <!--<div class="container">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 no-padding">
                <form role="form">
                    <input placeholder="Subscribe to our newsletter">
                    <button class="le-button">Subscribe</button>
                </form>
            </div>
        </div>--><!-- /.container -->
    </div><!-- /.sub-form-row -->

    <div class="link-list-row">
        <div class="container no-padding">
            <div class="col-xs-12 col-md-4 ">
                <!-- ============================================================= CONTACT INFO ============================================================= -->
                <div class="contact-info">
                    <div class="footer-logo">
                        <img alt="logo" src="/images/logo1.png" width="252" height="60"/>
                    </div><!-- /.footer-logo -->

                    <p class="regular-bold"> 请通过电话，电子邮件随时联系我们</p>

                    <p>
                        电子邮件:guaosi@vip.qq.com

                    </p>

                    <!--<div class="social-icons">
                        <h3>Get in touch</h3>
                        <ul>
                            <li><a href="http://facebook.com/transvelo" class="fa fa-facebook"></a></li>
                            <li><a href="#" class="fa fa-twitter"></a></li>
                            <li><a href="#" class="fa fa-pinterest"></a></li>
                            <li><a href="#" class="fa fa-linkedin"></a></li>
                            <li><a href="#" class="fa fa-stumbleupon"></a></li>
                            <li><a href="#" class="fa fa-dribbble"></a></li>
                            <li><a href="#" class="fa fa-vk"></a></li>
                        </ul>
                    </div>--><!-- /.social-icons -->

                </div>
                <!-- ============================================================= CONTACT INFO : END ============================================================= -->            </div>

            <div class="col-xs-12 col-md-8 no-margin">
                <!-- ============================================================= LINKS FOOTER ============================================================= -->
                <div class="link-widget">
                    <div class="widget">
                        <h3>快速检索</h3>
                        <ul>
                            <?php foreach($this->params['menu'] as $key=>$val):?>
                                <?php if($key>=8){break;}?>
                                <li><a href="<?=Url::to(['product/index','cateid'=>$val['cateid']])?>"><?=$val['title'];?></a></li>
                            <?php endforeach;?>

                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->

                <div class="link-widget">
                    <div class="widget">
                        <h3>热门商品</h3>
                        <ul>
                            <?php if($this->params['footer']['hot']):?>
                                <?php foreach($this->params['footer']['hot'] as $key=>$val):?>
                                    <?php if($key>=8){break;}?>
                                    <li><a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a></li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->

                <div class="link-widget">
                    <div class="widget">
                        <h3>最近浏览</h3>
                        <ul>
                            <?php if(!empty($this->params['footer']['historyproduct'])):?>
                                <?php foreach($this->params['footer']['historyproduct'] as $key=>$val):?>
                                    <li><a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a></li>
                                <?php endforeach;?>
                            <?php endif;?>
                        </ul>
                    </div><!-- /.widget -->
                </div><!-- /.link-widget -->
                <!-- ============================================================= LINKS FOOTER : END ============================================================= -->            </div>
        </div><!-- /.container -->
    </div><!-- /.link-list-row -->

    <div class="copyright-bar">
        <div class="container">
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="copyright">
                    &copy; <a href="index.html">guaosi.com.cn</a> - all rights reserved
                </div><!-- /.copyright -->
                <div class="copyright"> © guaosi 版权所有，并保留所有权利。  ICP备案证书号:闽ICP备17020416号
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 no-margin">
                <div class="payment-methods ">
                    <ul>
                        <li><img alt="" src="/images/payments/payment-visa.png"></li>
                        <li><img alt="" src="/images/payments/payment-master.png"></li>
                        <li><img alt="" src="/images/payments/payment-paypal.png"></li>
                        <li><img alt="" src="/images/payments/payment-skrill.png"></li>
                    </ul>
                </div><!-- /.payment-methods -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.copyright-bar -->

</footer><!-- /#footer -->
<!-- ============================================================= FOOTER : END ============================================================= -->	</div><!-- /.wrapper -->



<script>
    function addComma(money) {
        if(money==""){
            return "";
        }
        if(money){
            money = money.trim();
        }
        if(/[^0-9\.\-\+]/.test(money)){
            return money;
        }
        money = parseFloat(money) + "";
        if('NaN' == money){
            return  "0.00";
        }
        var money_flag = "";
        if(money.indexOf("-") != -1){
            money = money.replace(/-/g,"");
            money_flag = "-";
        }
        money=money.replace(/^(\d*)$/,"$1.");
        money=(money+"00").replace(/(\d*\.\d\d)\d*/,"$1");
        money=money.replace(".",",");
        var re=/(\d)(\d{3},)/;
        while(re.test(money)){
            money=money.replace(re,"$1,$2");
        }
        money=money.replace(/,(\d\d)$/,".$1");
        var money =  money_flag+""+money.replace(/^\./,"0.")
        return money;
    }
    $("#createlink").click(function(){
        $(".billing-address").slideDown();
    });

    $('.close-btn1').click(function () {
        dom=$(this);
        var cartid=dom.attr('cart-id');
        var productc='.productc'+cartid;
        var num= $(productc).val();
        if(num)
        {
//          证明这是在购物车页面
            var type='cart';


        }
        else
        {
//          证明这是在其他页面
            var type='other';
        }
        delcart1(cartid,type);
    })
    function delcart1(cartid,type) {
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
                    var producttc='.producttc'+cartid;

                    if(type=='cart')
                    {
                        var productc='.productc'+cartid;
                        var num= parseInt($(productc).val());
                        var price=parseFloat($(productc).attr('price-id'));
                        var totalprice=parseFloat($('.value.pull-right span').html().replace(',',''));
                        var countprice=(totalprice*100-price*100*num)/100;
                        var newprice=addComma(countprice.toFixed(2));
                        $('.basket-item-count span').html((parseInt($('.basket-item-count span').html())-num));
                        $('.value.pull-right span').html(newprice);
                        $('.total-price .value').html(newprice);
                        $(productc).parent().parent().parent().parent().remove();
                    }
                    else
                    {
                        var price= parseFloat($(producttc).attr('price-id'));
                        var num=parseInt($(producttc).attr('price-num'));
                        var totalprice=parseFloat($('.total-price .value').html().replace(',',''));
                        var countprice=(totalprice*100-price*100*num)/100;
                        var newprice=addComma(countprice.toFixed(2));
                        $('.basket-item-count span').html((parseInt($('.basket-item-count span').html())-num));
                        $('.total-price .value').html(newprice);

                    }
                    $(producttc).parent().parent().remove();

                }
            }
        })
    }

</script>
<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage(); ?>