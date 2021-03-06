<?php
use yii\helpers\Url;
$this->title='商品列表';
?>
<!-- ============================================================= HEADER : END ============================================================= -->		<section id="category-grid">
    <div class="container">
        
        <!-- ========================================= SIDEBAR ========================================= -->
        <div class="col-xs-12 col-sm-3 no-margin sidebar narrow">

            <!-- ========================================= PRODUCT FILTER ========================================= -->
<div class="widget">
    <h1>商品筛选</h1>
    <div class="body bordered">
        
        <div class="category-filter">
            <h2>品牌</h2>
            <hr>
            <ul>
                <li><input checked="checked" class="le-checkbox" type="checkbox"  /> <label>Samsung</label> <span class="pull-right">(2)</span></li>
                <li><input  class="le-checkbox" type="checkbox" /> <label>Dell</label> <span class="pull-right">(8)</span></li>
                <li><input  class="le-checkbox" type="checkbox" /> <label>Toshiba</label> <span class="pull-right">(1)</span></li>
                <li><input  class="le-checkbox" type="checkbox" /> <label>Apple</label> <span class="pull-right">(5)</span></li>
            </ul>
        </div><!-- /.category-filter -->
        
        <div class="price-filter">
            <h2>价格</h2>
            <hr>
            <div class="price-range-holder">

                <input type="text" class="price-slider" value="" >

                <span class="min-max">
                    Price: ￥89 - ￥2899
                </span>
                <span class="filter-button">
                    <a href="#">筛选</a>
                </span>
            </div>
        </div><!-- /.price-filter -->

    </div><!-- /.body -->
</div><!-- /.widget -->
<!-- ========================================= PRODUCT FILTER : END ========================================= -->
            <div class="widget">
	<h1 class="border">特价商品</h1>
	<ul class="product-list">
        <?if($sale):?>
        <?php foreach ($sale as $k=>$v):?>
        <li>
            <div class="row">
                <div class="col-xs-4 col-sm-4 no-margin">
                    <a href="<?=Url::to(['product/detail','productid'=>$v['productid']])?>" class="thumb-holder" >
                        <img alt="<?=$v['title']?>" src="http://<?=$v['cover']?>-cobersamall" data-echo="http://<?=$v['cover']?>-cobersamall" />
                    </a>
                </div>
                <div class="col-xs-8 col-sm-8 no-margin">
                    <a href="<?=Url::to(['product/detail','productid'=>$v['productid']])?>"><?=$v['title']?></a>
                    <div class="price">
                        <?if($v['issale']):?>
                        <div class="price-prev">￥<?=$v['price']?></div>
                        <div class="price-current">￥<?=$v['saleprice']?></div>
                        <?endif;?>
                    </div>
                </div>  
            </div>
        </li>
          <?php endforeach;?>
        <?endif?>
    </ul>
</div><!-- /.widget -->
<!-- ========================================= FEATURED PRODUCTS ========================================= -->
            <div class="widget">
                <h1 class="border">推荐商品</h1>
                <ul class="product-list">
                    <?if($tui):?>
                        <?php foreach ($tui as $k=>$v):?>
                            <li>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 no-margin">
                                        <a href="<?=Url::to(['product/detail','productid'=>$v['productid']])?>" class="thumb-holder" >
                                            <img alt="<?=$v['title']?>" src="http://<?=$v['cover']?>-cobersamall" data-echo="http://<?=$v['cover']?>-cobersamall" />
                                        </a>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 no-margin">
                                        <a href="<?=Url::to(['product/detail','productid'=>$v['productid']])?>"><?=$v['title']?></a>
                                        <div class="price">
                                            <?if($v['issale']):?>
                                                <div class="price-prev">￥<?=$v['price']?></div>
                                                <div class="price-current">￥<?=$v['saleprice']?></div>
                                            <?endif;?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                    <?endif?>
                </ul>
            </div><!-- /.widget -->
<!-- ========================================= FEATURED PRODUCTS : END ========================================= -->
        </div>
        <!-- ========================================= SIDEBAR : END ========================================= -->

        <!-- ========================================= CONTENT ========================================= -->

        <div class="col-xs-12 col-sm-9 no-margin wide sidebar">

            <section id="recommended-products" class="carousel-holder hover small">

    <div class="title-nav">
        <h2 class="inverse">推荐商品</h2>
        <div class="nav-holder">
            <a href="#prev" data-target="#owl-recommended-products" class="slider-prev btn-prev fa fa-angle-left"></a>
            <a href="#next" data-target="#owl-recommended-products" class="slider-next btn-next fa fa-angle-right"></a>
        </div>
    </div><!-- /.title-nav -->

    <div id="owl-recommended-products" class="owl-carousel product-grid-holder">
        <?php if($hot):?>
        <?php foreach ($hot as $val) :?>
        <div class="no-margin carousel-item product-item-holder hover size-medium">
            <div class="product-item">

                <?php if ($val->ishot): ?>
                    <div class="ribbon red"><span>HOT</span></div>
                <?php endif; ?>

                <div class="image">
                    <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                </div>
                <div class="body">

                    <div class="title">
                        <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                    </div>
                    <!--                                    <div class="brand">sony</div>-->
                </div>
                <div class="prices">
                    <div class="price-current text-right">￥ <?=$val['issale'] ? $val['saleprice'] :$val['price'] ?></div>


                </div>

                <div class="hover-area">
                    <div class="add-cart-button">
                        <a href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>
                    </div>
                </div>
            </div>
        </div><!-- /.carousel-item -->
            <?php endforeach;?>
        <?php endif?>

    </div><!-- /#recommended-products-carousel .owl-carousel -->
</section><!-- /.carousel-holder -->            
            <section id="gaming">
    <div class="grid-list-products">
        <h2 class="section-title">所有商品</h2>
        
        <div class="control-bar">
            <div id="popularity-sort" class="le-select" >
                <select data-placeholder="sort by popularity">
                    <option value="1">1-100 个用户</option>
                    <option value="2">101-200 个用户</option>
                    <option value="3">200+ 个用户</option>
                </select>
            </div>

            <div id="item-count" class="le-select">
                <select>
                    <option value="1">24个/页</option>
                    <option value="2">48个/页</option>
                    <option value="3">32个/页</option>
                </select>
            </div>

            <div class="grid-list-buttons">
                <ul>
                    <li class="grid-list-button-item active"><a data-toggle="tab" href="#grid-view"><i class="fa fa-th-large"></i> 图文</a></li>
                    <li class="grid-list-button-item "><a data-toggle="tab" href="#list-view"><i class="fa fa-th-list"></i> 列表</a></li>
                </ul>
            </div>
        </div><!-- /.control-bar -->

        <div class="tab-content">
            <div id="grid-view" class="products-grid fade tab-pane in active">
                
                <div class="product-grid-holder">
                    <div class="row no-margin">

                        <?php if($products):?>
                        <?php foreach($products as $key=>$val):?>
                        <div class="col-xs-12 col-sm-4 no-margin product-item-holder hover">
                            <div class="product-item">

                                <?php if ($val->ishot): ?>
                                    <div class="ribbon red"><span>HOT</span></div>
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
                            </div><!-- /.product-item -->
                        </div><!-- /.product-item-holder -->
                         <?php endforeach;?>
                        <?endif?>
                    </div><!-- /.row -->
                </div><!-- /.product-grid-holder -->
                
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

                        <div class="col-xs-12 col-sm-6">
                            <div class="result-counter">
                                <?php $footPage=($page-1)*$pageSize+1?>
                                Showing <span><?=$footPage?>-<?=$footPage+$pageSize-1>$count?$count:$footPage+$pageSize-1?></span> of <span><?=$count?></span> results
                            </div>
                        </div>

                    </div><!-- /.row -->
                </div><!-- /.pagination-holder -->
            </div><!-- /.products-grid #grid-view -->

            <div id="list-view" class="products-grid fade tab-pane ">
                <div class="products-list">
                    <?php foreach($products as $key=>$val):?>
                    <div class="product-item product-item-holder">
                        <?php if ($val->ishot): ?>
                            <div class="ribbon red"><span>HOT</span></div>
                        <?php endif; ?>
                        <div class="ribbon blue"><span>new</span></div>
                        <div class="row">
                            <div class="no-margin col-xs-12 col-sm-4 image-holder">
                                <div class="image">
                                    <img alt="<?=$val['title']?>" src="http://<?=$val['cover']?>-covermiddle" data-echo="http://<?=$val['cover']?>-covermiddle" />
                                </div>
                            </div><!-- /.image-holder -->
                            <div class="no-margin col-xs-12 col-sm-5 body-holder">
                                <div class="body">
                                    <div class="label-discount green">-<?=ceil(100*(1-($val['saleprice']/$val['price'])))?>% sale</div>
                                    <div class="title">
                                        <a href="<?=Url::to(['product/detail','productid'=>$val['productid']])?>"><?=$val['title']?></a>
                                    </div>
<!--                                    <div class="brand">sony</div>-->

                                    <div class="excerpt">
                                        <?php if($val['descr']):?>

                                        <p><?=$val['descr']?></p>

                                         <?php endif;?>
                                    </div>

                                </div>
                            </div><!-- /.body-holder -->
                            <div class="no-margin col-xs-12 col-sm-3 price-area">
                                <div class="right-clmn">

                                    <?php if($val['issale']):?>
                                        <div class="price-prev">￥<?=$val['price']?></div>
                                        <div class="price-current">￥<?=$val['saleprice']?></div>
                                    <?php else:?>

                                        <div class="price-current">￥<?=$val['price']?></div>
                                    <?php endif?>


                                    <div class="availability"><label>存货:</label><span class="available">  <?=$val['num']?'现货':'缺货'?></span></div>

                                    <a class="le-button" href="<?=Url::to(['cart/add','productid'=>$val['productid']])?>" class="le-button">加入购物车</a>

                                </div>
                            </div><!-- /.price-area -->
                        </div><!-- /.row -->
                    </div><!-- /.product-item -->
                    <?php endforeach;?>

                </div><!-- /.products-list -->

                <div class="pagination-holder">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 text-left">
                            <?php echo yii\widgets\LinkPager::widget([
                                'pagination' => $pager,
                                'options' => ['class' => 'pagination '],
                                'prevPageLabel' => '上一页',
                                'nextPageLabel' => '下一页',
                                'maxButtonCount' => 5,
                            ]); ?>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="result-counter">
                                <?php $footPage=($page-1)*$pageSize+1?>
                                Showing <span><?=$footPage?>-<?=$footPage+$pageSize-1>$count?$count:$footPage+$pageSize-1?></span> of <span><?=$count?></span> results
                            </div>
                        </div>
                    </div><!-- /.row -->
                </div><!-- /.pagination-holder -->

            </div><!-- /.products-grid #list-view -->

        </div><!-- /.tab-content -->
    </div><!-- /.grid-list-products -->

</section><!-- /#gaming -->            
        </div><!-- /.col -->
        <!-- ========================================= CONTENT : END ========================================= -->    
    </div><!-- /.container -->
</section><!-- /#category-grid -->		<!-- ============================================================= FOOTER ============================================================= -->
