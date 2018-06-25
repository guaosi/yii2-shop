<?php
use yii\helpers\Url;
use app\assets\AppAsset;
AppAsset::register($this);
$this->title='首页';
?>
<!-- ============================================================= HEADER : END ============================================================= -->		<div id="top-banner-and-menu">
	<div class="container">
		
		<div class="col-xs-12 col-sm-4 col-md-3 sidemenu-holder">
			<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown">
    <div class="head"><i class="fa fa-list"></i> 所有分类 </div>        
    <nav class="yamm megamenu-horizontal" role="navigation">
        <ul class="nav">
            <?php foreach ($this->params['menu'] as $children):?>
            <li class="dropdown menu-item">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$children['title']?></a>
                <?php if(isset($children['children'])):?>
                <ul class="dropdown-menu mega-menu">
                    <li class="yamm-content">
                        <!-- ================================== MEGAMENU VERTICAL ================================== -->

<div class="row">
    <div class="col-xs-12 col-lg-4">


        <ul>
                <?php foreach ($children['children'] as $val):?>
            <li><a href="<?=Url::to(['product/index','cateid'=>$val['cateid']])?>"><?=$val['title']?></a></li>
                <?php endforeach;?>
        </ul>


    </div>

    <div class="dropdown-banner-holder">
        <a href="#"><img alt="" src="/images/banners/banner-side.png" /></a>
    </div>
</div>

<!-- ================================== MEGAMENU VERTICAL ================================== -->                        
                    </li>
                </ul>
                <?php endif;?>
            </li><!-- /.menu-item -->
            <?php endforeach;?>
            <!--<li><a href="http://themeforest.net/item/media-center-electronic-ecommerce-html-template/8178892?ref=shaikrilwan">Buy this Theme</a></li>-->
        </ul><!-- /.nav -->
    </nav><!-- /.megamenu-horizontal -->
</div><!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->		</div><!-- /.sidemenu-holder -->

		<div class="col-xs-12 col-sm-8 col-md-9 homebanner-holder">
			<!-- ========================================== SECTION – HERO ========================================= -->
			
<div id="hero">
	<div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
		
		<div class="item" style="background-image: url(http://shopyiip.guaosi.com.cn/banner1.jpg);">
			<div class="container-fluid">
				<div class="caption vertical-center text-left">
					<div class="big-text fadeInDown-1">
						最高优惠<span class="big"><span class="sign">￥</span>400</span>
					</div>

					<div class="excerpt fadeInDown-2">
						潮玩生活<br>
						享受生活<br>
						引领时尚
					</div>
					<div class="small fadeInDown-2">
						最后 5 天限时抢购
					</div>
					<div class="button-holder fadeInDown-3">
						<a href="single-product.html" class="big le-button ">去购买</a>
					</div>
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div><!-- /.item -->

		<div class="item" style="background-image: url(http://shopingdemo.t.imooc.io/assets/images/sliders/slider01.jpg);">
			<div class="container-fluid">
				<div class="caption vertical-center text-left">
					<div class="big-text fadeInDown-1">
						想获得<span class="big"><span class="sign">￥</span>200</span>的优惠？
					</div>

					<div class="excerpt fadeInDown-2">
						速速前来 <br>快速抢购<br>
					</div>
					<div class="small fadeInDown-2">
						优惠等你拿
					</div>
					<div class="button-holder fadeInDown-3">
						<a href="single-product.html" class="big le-button ">去购买</a>
					</div>
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div><!-- /.item -->

	</div><!-- /.owl-carousel -->
</div>
			
<!-- ========================================= SECTION – HERO : END ========================================= -->			
		</div><!-- /.homebanner-holder -->

	</div><!-- /.container -->
</div><!-- /#top-banner-and-menu -->

<!-- ========================================= HOME BANNERS ========================================= -->
<section id="banner-holder" class="wow fadeInUp">
    <div class="container">
        <div class="col-xs-12 col-lg-6 no-margin banner">
            <a href="category-grid.html">
                <div class="banner-text theblue">
                    <h1 style="font-family:'Microsoft Yahei';">尝尝鲜</h1>
                    <span class="tagline">查看最新分类</span>
                </div>
                <img class="banner-image" alt="" src="http://shopyiip.guaosi.com.cn/banner2.jpg" data-echo="http://shopyiip.guaosi.com.cn/banner3.jpg" />
            </a>
        </div>
        <div class="col-xs-12 col-lg-6 no-margin text-right banner">
            <a href="category-grid.html">
                <div class="banner-text right">
                    <h1 style="font-family:'Microsoft Yahei';">时尚流行</h1>
                    <span class="tagline">查看最新上架</span>
                </div>
                <img class="banner-image" alt="" src="http://shopingdemo.t.imooc.io/assets/images/banners/banner-narrow-02.jpg" data-echo="http://shopingdemo.t.imooc.io/assets/images/banners/banner-narrow-02.jpg" />
            </a>
        </div>
    </div><!-- /.container -->
</section><!-- /#banner-holder -->
<!-- ========================================= HOME BANNERS : END ========================================= -->
<div id="products-tab" class="wow fadeInUp">
    <div class="container">
        <div class="tab-holder">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" >
                <li class="active"><a href="#featured" data-toggle="tab">推荐商品</a></li>
                <li><a href="#new-arrivals" data-toggle="tab">最新促销</a></li>
                <li><a href="#top-sales" data-toggle="tab">最佳热卖</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="featured">

                    <div class="product-grid-holder">
                        <?php if($data['tui']):?>
                        <?php foreach ($data['tui'] as $val) :?>
                        <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                            <div class="product-item">
                                <?php if ($val->ishot): ?>
                                    <div class="ribbon red"><span>HOT</span></div>
                                <?php endif; ?>
                                <div class="ribbon blue"><span>new</span></div>
                                <?php if ($val->issale): ?>
                                    <div class="ribbon green"><span>sale</span></div>
                                <?php endif; ?>
                                <div class="image">
                                    <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                                </div>
                                <div class="body">
                                    <?php if($val['issale']):?>
                                    <div class="label-discount green">-<?=ceil(100*(1-($val['saleprice']/$val['price'])))?>% sale</div>
                                    <?php endif?>
                                    <div class="title">
                                        <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                    </div>
<!--                                    <div class="brand">sony</div>-->
                                </div>
                                <div class="prices">
                                    <?php if($val['issale']):?>
                                    <div class="price-prev">￥<?=$val['price']?></div>
                                    <div class="price-current pull-right">￥<?=$val['saleprice']?></div>
                                    <?php else:?>
                                        <div class="price-prev">￥<?=$val['price']?></div>
                                        <div class="price-current pull-right">￥<?=$val['price']?></div>
                                    <?php endif?>

                                </div>

                                <div class="hover-area">
                                    <div class="add-cart-button">
                                        <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                        <?php endif?>
                    </div>
<!--                    <div class="loadmore-holder text-center">-->
<!--                        <a class="btn-loadmore" href="#">-->
<!--                            <i class="fa fa-plus"></i>-->
<!--                            查看更多</a>-->
<!--                    </div> -->

                </div>
                <div class="tab-pane" id="new-arrivals">
                    <div class="product-grid-holder">
                        <?php if($data['sale']):?>
                            <?php foreach ($data['sale'] as $val) :?>
                                <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                    <div class="product-item">
                                        <?php if ($val->issale): ?>
                                            <div class="ribbon red"><span>sale</span></div>
                                        <?php endif; ?>
                                        <?php if ($val->ishot): ?>
                                            <div class="ribbon green"><span>HOT</span></div>
                                        <?php endif; ?>
                                            <div class="ribbon blue"><span>new</span></div>

                                        <div class="image">
                                            <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                                        </div>
                                        <div class="body">
                                            <?php if($val['issale']):?>
                                                <div class="label-discount green">-<?=ceil(100*(1-($val['saleprice']/$val['price'])))?>% sale</div>
                                            <?php endif?>
                                            <div class="title">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                            </div>
                                            <!--                                    <div class="brand">sony</div>-->
                                        </div>
                                        <div class="prices">
                                            <?php if($val['issale']):?>
                                                <div class="price-prev">￥<?=$val['price']?></div>
                                                <div class="price-current pull-right">￥<?=$val['saleprice']?></div>
                                            <?php else:?>
                                                <div class="price-prev">￥<?=$val['price']?></div>
                                                <div class="price-current pull-right">￥<?=$val['price']?></div>
                                            <?php endif?>

                                        </div>

                                        <div class="hover-area">
                                            <div class="add-cart-button">
                                                <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endif?>
                    </div>
                    <!--                    <div class="loadmore-holder text-center">-->
                    <!--                        <a class="btn-loadmore" href="#">-->
                    <!--                            <i class="fa fa-plus"></i>-->
                    <!--                            查看更多</a>-->
                    <!--                    </div> -->

                </div>

                <div class="tab-pane" id="top-sales">
                    <div class="product-grid-holder">
                        <?php if($data['hot']):?>
                            <?php foreach ($data['hot'] as $val) :?>
                                <div class="col-sm-4 col-md-3 no-margin product-item-holder hover">
                                    <div class="product-item">

                                        <?php if ($val->ishot): ?>
                                            <div class="ribbon red"><span>HOT</span></div>
                                        <?php endif; ?>
                                        <div class="ribbon blue"><span>new</span></div>
                                        <?php if ($val->issale): ?>
                                            <div class="ribbon green"><span>sale</span></div>
                                        <?php endif; ?>
                                        <div class="image">
                                            <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                                        </div>
                                        <div class="body">
                                            <?php if($val['issale']):?>
                                                <div class="label-discount green">-<?=ceil(100*(1-($val['saleprice']/$val['price'])))?>% sale</div>
                                            <?php endif?>
                                            <div class="title">
                                                <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                            </div>
                                            <!--                                    <div class="brand">sony</div>-->
                                        </div>
                                        <div class="prices">
                                            <?php if($val['issale']):?>
                                                <div class="price-prev">￥<?=$val['price']?></div>
                                                <div class="price-current pull-right">￥<?=$val['saleprice']?></div>
                                            <?php else:?>
                                                <div class="price-prev">￥<?=$val['price']?></div>
                                                <div class="price-current pull-right">￥<?=$val['price']?></div>
                                            <?php endif?>

                                        </div>

                                        <div class="hover-area">
                                            <div class="add-cart-button">
                                                <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endif?>
                    </div>
                    <!--                    <div class="loadmore-holder text-center">-->
                    <!--                        <a class="btn-loadmore" href="#">-->
                    <!--                            <i class="fa fa-plus"></i>-->
                    <!--                            查看更多</a>-->
                    <!--                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ========================================= BEST SELLERS ========================================= -->
<section id="bestsellers" class="color-bg wow fadeInUp">
    <div class="container">
        <h1 class="section-title">最新商品</h1>

        <div class="product-grid-holder medium">
            <div class="col-xs-12 col-md-7 no-margin">
                
                <div class="row no-margin">
                    <?php if($data['new']):?>
                    <?php for ($i=1;$i<4;$i++):?>
                        <?php $val=$data['new'][$i];?>
                    <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                        <div class="product-item">
                            <div class="image">
                                <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                            </div>
                            <div class="body">
                                <div class="label-discount clear"></div>
                                <div class="title">
                                    <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                </div>
<!--                                <div class="brand">beats</div>-->
                            </div>
                            <div class="prices">

                                <div class="price-current text-right">￥<?=$val['issale']?$val['saleprice']:$val['price']?></div>

                            </div>
                            <div class="hover-area">
                                <div class="add-cart-button">
                                    <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.product-item-holder -->
                    <?php endfor;?>
                    <?php endif;?>
                </div><!-- /.row -->
                
                <div class="row no-margin">

                    <?php if($data['new']):?>
                        <?php for ($i=4;$i<7;$i++):?>
                            <?php $val=$data['new'][$i];?>
                            <div class="col-xs-12 col-sm-4 no-margin product-item-holder size-medium hover">
                                <div class="product-item">
                                    <div class="image">
                                        <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                                    </div>
                                    <div class="body">
                                        <div class="label-discount clear"></div>
                                        <div class="title">
                                            <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                        </div>
                                        <!--                                <div class="brand">beats</div>-->
                                    </div>
                                    <div class="prices">

                                        <div class="price-current text-right">￥<?=$val['issale']?$val['saleprice']:$val['price']?></div>

                                    </div>
                                    <div class="hover-area">
                                        <div class="add-cart-button">
                                            <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.product-item-holder -->
                        <?php endfor;?>
                    <?php endif;?>

                </div><!-- /.row -->
            </div><!-- /.col -->
            <?php if($data['new'][0]):?>
                <?php $val=$data['new'][0];?>
                <?php $pics=json_decode($val['pics'],true);?>
                <?php if($val['pics']):?>
            <div class="col-xs-12 col-md-5 no-margin">

                <div class="product-item-holder size-big single-product-gallery small-gallery">

                    <div id="best-seller-single-product-slider" class="single-product-slider owl-carousel">
                        <?php foreach($pics as $k=>$v):?>

                        <div class="single-product-gallery-item" id="slide<?=$k+1?>">
                            <a data-rel="prettyphoto" href="http://<?=$v?>">
                                <img alt="<?=$val['title']?>" src="http://<?=$v?>-picsmall" data-echo="http://<?=$v?>" />
                            </a>
                        </div><!-- /.single-product-gallery-item -->
                        <?php endforeach;?>

                    </div><!-- /.single-product-slider -->

                    <div class="gallery-thumbs clearfix">
                        <ul>
                            <?php foreach($pics as $k=>$v):?>
                            <li><a class="horizontal-thumb <?php if($k==0):?>active<?php endif?>" data-target="#best-seller-single-product-slider" data-slide="<?=$k?>" href="#slide<?=$k+1?>"><img alt="<?=$val['title']?>" src="http://<?=$v?>-piclistsmall" data-echo="http://<?=$v?>-piclistsmall" /></a></li>
                            <?php endforeach;?>
                        </ul>
                    </div><!-- /.gallery-thumbs -->

                    <div class="body">
                        <div class="label-discount clear"></div>
                        <div class="title">
                            <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                        </div>
<!--                        <div class="brand">sony</div>-->
                    </div>
                    <div class="prices text-right">

                        <div class="price-current inline">￥<?=$val['issale']?$val['saleprice']:$val['price']?></div>
                        <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>

                    </div>
                </div><!-- /.product-item-holder -->
            </div><!-- /.col -->
                <?php endif;?>
            <?php endif;?>

        </div><!-- /.product-grid-holder -->
    </div><!-- /.container -->
</section><!-- /#bestsellers -->
<!-- ========================================= BEST SELLERS : END ========================================= -->
<!-- ========================================= RECENTLY VIEWED ========================================= -->
<section id="recently-reviewd" class="wow fadeInUp">
	<div class="container">
		<div class="carousel-holder hover">
			
			<div class="title-nav">
				<h2 class="h1">最近浏览</h2>
				<div class="nav-holder">
					<a href="#prev" data-target="#owl-recently-viewed" class="slider-prev btn-prev fa fa-angle-left"></a>
					<a href="#next" data-target="#owl-recently-viewed" class="slider-next btn-next fa fa-angle-right"></a>
				</div>
			</div><!-- /.title-nav -->

			<div id="owl-recently-viewed" class="owl-carousel product-grid-holder">
                <?php if(!empty($data['historyproduct'])):?>
                <?php foreach($data['historyproduct'] as $key=>$val):?>
				<div class="no-margin carousel-item product-item-holder size-small hover">
					<div class="product-item">
                        <?php if ($val['issale']): ?>
                            <div class="ribbon red"><span>sale</span></div>
                        <?php endif; ?>
                        <?php if ($val['ishot']): ?>
                            <div class="ribbon green"><span>HOT</span></div>
                        <?php endif; ?>
						<div class="image">
							<img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" />
						</div>
						<div class="body">
							<div class="title">
								<a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
							</div>
<!--							<div class="brand">Sharp</div>-->
						</div>
						<div class="prices">
							<div class="price-current text-right">￥<?=$val['issale']?$val['saleprice']:$val['price']?></div>
						</div>
						<div class="hover-area">
							<div class="add-cart-button">
                                <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
							</div>
						</div>
					</div><!-- /.product-item -->
				</div><!-- /.product-item-holder -->
                    <?php endforeach;?>
                <?php endif;?>
			</div><!-- /#recently-carousel -->

		</div><!-- /.carousel-holder -->
	</div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->
<!-- ========================================= TOP BRANDS ========================================= -->
<section id="top-brands" class="wow fadeInUp">
    <div class="container">
        <div class="carousel-holder" >
            
            <div class="title-nav">
                <h1>热门品牌</h1>
                <div class="nav-holder">
                    <a href="#prev" data-target="#owl-brands" class="slider-prev btn-prev fa fa-angle-left"></a>
                    <a href="#next" data-target="#owl-brands" class="slider-next btn-next fa fa-angle-right"></a>
                </div>
            </div><!-- /.title-nav -->
            
            <div id="owl-brands" class="owl-carousel brands-carousel">
                <?php if (!empty($data['brand'])):?>
                    <?php foreach ($data['brand'] as $key=>$val):?>
                <div class="carousel-item">
                    <a href="#">
                        <img alt="" width="144" height="36" src="http://<?=$val['brandimg']?>-brandIndex" />
                    </a>
                </div><!-- /.carousel-item -->
                        <?php endforeach;?>
                <?php endif;?>
            </div><!-- /.brands-caresoul -->

        </div><!-- /.carousel-holder -->
    </div><!-- /.container -->
</section><!-- /#top-brands -->
<!-- ========================================= TOP BRANDS : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->