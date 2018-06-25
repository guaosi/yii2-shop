<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title='添加商品';
$this->params['breadcrumbs'][]=['label'=>' > 商品列表','url'=>'/admin/product/products.html'];
$this->params['breadcrumbs'][]='> '.$this->title;
?>
<!-- main container -->

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加商品</h3></div>
            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <div class="container">
                        <?php if (Yii::$app->session->hasFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                        <?php $form = ActiveForm::begin([
                            'options' => ['id' => 'w0', 'class' => 'new_user_form inline-input', 'enctype' => 'multipart/form-data'],
                            'fieldConfig' => [
                                'template' => '<div class="span12 field-box">{label}{input}</div>{error}'
                            ]
                        ]) ?>

                        <?=$form->field($product,'cateid')->dropDownList($list,['id'=>'cates','class'=>'form-control','style'=>'height:30px;width:300px'])?>
                        <?=$form->field($product,'brandid')->dropDownList($brand_list,['id'=>'brands','class'=>'form-control','style'=>'height:30px;width:300px'])?>
                        <?=$form->field($product,'title')->textInput(['class'=>'span9'])?>
                        <?=$form->field($product,'descr')->textarea(['id'=>'wysi','class'=>'span9 wysihtml5'])?>
                        <?=$form->field($product,'price')->textInput(['class'=>'span9'])?>
                        <?=$form->field($product,'num')->textInput(['class'=>'span9'])?>
                        <?=$form->field($product,'ishot')->radioList([0=>'不热卖',1=>'热卖'],['class'=>'span8'])?>
                        <?=$form->field($product,'istui')->radioList([0=>'不推荐',1=>'推荐'],['class'=>'span8'])?>
                        <?=$form->field($product,'issale')->radioList([0=>'不促销',1=>'促销'],['class'=>'span8'])?>
                        <?=$form->field($product,'saleprice')->textInput(['class'=>'span9'])?>

                        <?=$form->field($product,'ison')->radioList([0=>'下架',1=>'上架'],['class'=>'span8'])?>

                        <?=$form->field($product,'cover')->fileInput(['class'=>'span9'])?>

                        <?=$form->field($product,'pics[]')->fileInput(['class'=>'span9'])?>
                        <input type='button' id="addpic" value='增加一个'>
                        <div class="form-group field-product-detaill">
                            <div class="span12 field-box">
                                <label class="control-label" for="editor">文章内容：</label>
                                <script id="editor" type="text/plain" name="Product[detail]" style="width:80%;height:300px;"></script>
                            </div>
                                <p class="help-block help-block-error">

                                    </p>
                                    </div>


                        <hr/>

                        <div class="span11 field-box actions">
                            <?=Html::submitButton('提交',['class'=>'btn-glow primary'])?>
                            <span>OR</span>
                            <?=Html::resetButton('取消',['class'=>'btn-glow primary'])?>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>

                </div>
                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">
                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>请在左侧表单当中填入要添加的商品信息,包括商品名称,描述,图片等
                    </div>
                    <h6>商城用户说明</h6>
                    <p>可以在前台进行购物</p>
                </div>
            </div>
        </div>
    </div>

<!-- end main container -->
  <script type="text/javascript" charset="utf-8" src="/admin/lib/ueditor_qiniu/ueditor.config.js"></script>
 <script type="text/javascript" charset="utf-8" src="/admin/lib/ueditor_qiniu/ueditor.all.min.js"> </script>
 <script type="text/javascript" charset="utf-8" src="/admin/lib/ueditor_qiniu/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    var ue = UE.getEditor('editor');
    $("#addpic").click(function(){
        var pic = $("#product-pics").clone();
        pic.attr("style", "margin-left:120px");
        $("#product-pics").parent().append(pic);
    });

</script>
