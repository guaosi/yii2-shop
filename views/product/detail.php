<?php
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title=$product->title;
?>
<!-- ============================================================= HEADER : END ============================================================= -->		<div id="single-product">
    <div class="container">

         <div class="no-margin col-xs-12 col-sm-6 col-md-5 gallery-holder">
    <div class="product-item-holder size-big single-product-gallery small-gallery">

        <div id="owl-single-product">

            <div class="single-product-gallery-item" id="slide0">
                <a data-rel="prettyphoto" href="http://<?=$product['cover']?>">
                    <img class="img-responsive" alt="<?=$product['title']?>" src="http://<?=$product['cover']?>-coverbig" />
                </a>
            </div><!-- /.single-product-gallery-item -->
            <?php if($product['pics']):?>
            <?php $pics=json_decode($product['pics'],true)?>
                <?php foreach ($pics as $key=>$val):?>
            <div class="single-product-gallery-item" id="slide<?=$key+2?>">
                <a data-rel="prettyphoto" href="http://<?=$val?>">
                    <img class="img-responsive" alt="<?=$product['title']?>" src="http://<?=$val?>-picsproduct" data-echo="http://<?=$val?>-picsproduct" />
                </a>
            </div><!-- /.single-product-gallery-item -->
                <?php endforeach;?>
            <?php endif;?>
        </div><!-- /.single-product-slider -->


        <div class="single-product-gallery-thumbs gallery-thumbs">

            <div id="owl-single-product-thumbnails">

                <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="0" href="#slide0">
                    <img width="67" alt="<?=$product['title']?>" src="http://<?=$product['cover']?>" data-echo="http://<?=$product['cover']?>" />
                </a>
                <?php if($product['pics']):?>
                    <?php foreach ($pics as $key=>$val):?>
                <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="<?=$key+1?>" href="#slide<?=$key+1?>">
                    <img width="67" alt="<?=$product['title']?>" src="http://<?=$val?>-picsproduct" data-echo="http://<?=$val?>-picsproduct" />
                </a>
                    <?php endforeach;?>
                <?php endif;?>
            </div><!-- /#owl-single-product-thumbnails -->

            <div class="nav-holder left hidden-xs">
                <a class="prev-btn slider-prev" data-target="#owl-single-product-thumbnails" href="#prev"></a>
            </div><!-- /.nav-holder -->
            
            <div class="nav-holder right hidden-xs">
                <a class="next-btn slider-next" data-target="#owl-single-product-thumbnails" href="#next"></a>
            </div><!-- /.nav-holder -->

        </div><!-- /.gallery-thumbs -->

    </div><!-- /.single-product-gallery -->
</div><!-- /.gallery-holder -->        
        <div class="no-margin col-xs-12 col-sm-7 body-holder">
    <div class="body">
        <div style="margin-top:30px"></div>
        <div class="title"><a href="#"><?php echo $product['title'] ?></a></div>
        <div class="availability" style="font-size:15px;margin:0;line-height:30px"><label>库存:</label><span class="available">  <?php echo $product['num'] ?></span></div>
<!--        <div class="brand">sony</div>-->

        <div class="excerpt">
            <?php if($product):?>
                <p><?=$product['descr']?></p>
            <?php endif;?>
        </div>
        
        <div class="prices">
            <?php if($product['issale']):?>
                <div class="price-prev">￥<?=$product['price']?></div>
                <div class="price-current">￥<?=$product['saleprice']?></div>
            <?php else:?>
                <div class="price-current">￥<?=$product['price']?></div>
            <?php endif?>
        </div>



        <div class="qnt-holder">

            <div class="le-quantity">
                <form action="<?=Url::to(['cart/add'])?>" method="post">
                    <a class="minus" href="#reduce"></a>
                    <input name="productnum" readonly="readonly" type="text" value="1" />
                    <a class="plus" href="#add"></a>
            </div>
                <input type="hidden" name="productid" value="<?=$product['productid']?>">
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken() ?>">
            <input type="submit" id="addto-cart" class="le-button huge" value="加入购物车">
            </form>
        </div><!-- /.qnt-holder -->




    </div><!-- /.body -->


</div><!-- /.body-holder -->
    </div><!-- /.container -->
</div><!-- /.single-product -->

<!-- ========================================= SINGLE PRODUCT TAB ========================================= -->
<section id="single-product-tab">
    <div class="container">
        <div class="tab-holder">
            
            <ul class="nav nav-tabs simple" >
                <li class="active"><a href="#description" data-toggle="tab">商品详情</a></li>
                <?php $comment_count=$count;?>
                <li><a href="#reviews" data-toggle="tab">商品评价 (<?=$comment_count?>)</a></li>
            </ul><!-- /.nav-tabs -->

            <div class="tab-content">
                <div class="tab-pane active" id="description">
                    <?php if($product):?>
                    <p><?=$product['detail']?></p>
                    <?php endif;?>

                </div><!-- /.tab-pane #description -->
                <div class="tab-pane" id="reviews">


                    <div class="comments" id="comments_ajax">
                        <?php if ($comment_count):?>
                         <?php foreach ($all_comments as $key=>$val):?>
                        <div class="comment-item">
                            <div class="row no-margin">
                                <div class="col-lg-1 col-xs-12 col-sm-2 no-margin">
                                    <div class="avatar">
                                        <img alt="avatar" src="/images/default-avatar.jpg">
                                    </div><!-- /.avatar -->
                                </div><!-- /.col -->

                                <div class="col-xs-12 col-lg-11 col-sm-10 no-margin">
                                    <div class="comment-body">
                                        <div class="meta-info">
                                            <div class="author inline">
                                                <a href="#" class="bold"><?=$val->user->username?></a>
                                            </div>
                                            <div class="star-holder inline">
                                                <div class="star" data-score="<?=$val->score?>"></div>
                                            </div>
                                            <div class="date inline pull-right"><?=date('Y.m.d',$val->createtime)?></div>
                                        </div><!-- /.meta-info -->
                                        <p class="comment-text"><?=$val->content?></p><!-- /.comment-text -->
                                    </div><!-- /.comment-body -->

                                </div><!-- /.col -->

                            </div><!-- /.row -->
                        </div><!-- /.comment-item -->
                        <?php endforeach;?>
                        <?php endif;?>
                    </div><!-- /.comments -->
                        <div class="pagination-holder">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 text-left" id="comments_pagnation">
                                    <?php echo yii\widgets\LinkPager::widget([
                                        'pagination' => $pager,
                                        'options' => ['class' => 'pagination '],
                                        'prevPageLabel' => '上一页',
                                        'nextPageLabel' => '下一页',
                                        'maxButtonCount' => Yii::$app->params['pageSize']['pageShowNum']
                                    ]); ?>
                                    <?php $this->beginBlock('abc'); ?>

                                    $(document).on('click','.pagination a',function(e){
                                    e.preventDefault();
                                    var url=$(this).attr('href');
                                    var star=url.indexOf('?');
                                    var prarms=url.substring(star+1);
                                    var csrfToken = $('meta[name="csrf-token"]').attr("content");
                                    url="<?=Url::to(['comment/comments','productid'=>$product['productid']])?>"+"&"+prarms+'&_csrf='+csrfToken;
                                    $.ajax({
                                    url:url,
                                    dataType:'json',
                                    type:'get',
                                    success:function(data){
                                        var html_str='';
                                        if(data['data'].length>0)
                                       {
                                       for(var val in data['data']){
                                    html_str+='<div class="comment-item"><div class="row no-margin"><div class="col-lg-1 col-xs-12 col-sm-2 no-margin"><div class="avatar"><img alt="avatar" src="/images/default-avatar.jpg"></div></div><div class="col-xs-12 col-lg-11 col-sm-10 no-margin"><div class="comment-body"><div class="meta-info"><div class="author inline"><a href="#" class="bold">'+data['data'][val].user.username+'</a></div><div class="star-holder inline"><div class="star" data-score="'+data['data'][val].score+'"></div></div><div class="date inline pull-right">'+data['data'][val].createtime+'</div></div><p class="comment-text">'+data['data'][val].content+'</p></div></div></div></div>';
                                       }
                                       }
                                    $('#comments_ajax').html(html_str);
                                    $('#comments_pagnation').html(data['pageData']);
                                    }
                                    })
                                    });
                                    <?php $this->endBlock();  $this->registerJs($this->blocks['abc'], View::POS_END); ?>
                                </div>
                            </div><!-- /.row -->
                        </div>

                     <?php if ($can_comment):?>
                    <div class="add-review row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="new-review-form">
                                <h2>评论</h2>
                                <form id="contact-form" class="contact-form" method="post" action="<?=Url::to(['comment/add'])?>">
                                    <div class="field-row star-row">
                                        <label>评星</label>
                                        <div class="star-holder">
                                            <div class="star big" data-score="0"></div>
                                        </div>
                                    </div><!-- /.field-row -->

                                    <div class="field-row">
                                        <textarea name="content_one_comment" rows="8" class="le-input" id="content_one_comment"></textarea>
                                        <div id="comment_false"></div>
                                    </div><!-- /.field-row -->

                                     <input type="hidden" name="productid" value="<?=$product['productid']?>">
                                    <div class="buttons-holder">
                                        <button id="commit_button" class="le-button huge">提交评论</button>
                                    </div><!-- /.buttons-holder -->
                                </form><!-- /.contact-form -->
                            </div><!-- /.new-review-form -->
                        </div><!-- /.col -->
                    </div><!-- /.add-review -->
                      <?php endif;?>
                </div><!-- /.tab-pane #reviews -->
            </div><!-- /.tab-content -->

        </div><!-- /.tab-holder -->
    </div><!-- /.container -->
</section><!-- /#single-product-tab -->
<!-- ========================================= SINGLE PRODUCT TAB : END ========================================= -->
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
                                    <img alt="" src="http://<?=$val['cover']?>" />
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
            </div>

		</div><!-- /.carousel-holder -->
	</div><!-- /.container -->
</section><!-- /#recently-reviewd -->
<!-- ========================================= RECENTLY VIEWED : END ========================================= -->		<!-- ============================================================= FOOTER ============================================================= -->
<script>
    $(function () {
      $('#commit_button').click(function () {
          event.preventDefault();
          var csrfToken = $('meta[name="csrf-token"]').attr("content");
          var score=$("input[name='score']").val();
//          alert(score);
          var form=$("#contact-form").serialize();
          form=form+'&_csrf='+csrfToken;
          $.ajax({
              url:"<?=Url::to(['comment/add'])?>",
              type:'post',
              data:form,
              dataType:'json',
              success:function (data) {
                  console.log(data.errorCode);
                   if(data.errorCode)
                   {
                      alert(data.msg);
                      location.reload();
                   }else
                   {
                       var error="<span style='color: red'>"+data.msg+"</span>";
                       $('#comment_false').html(error);
                   }
              }
          })
      })
    })
</script>