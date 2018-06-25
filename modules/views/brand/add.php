<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title='添加品牌';
$this->params['breadcrumbs'][]=['label'=>' > 品牌列表','url'=>'/admin/brand/brands.html'];
$this->params['breadcrumbs'][]='> '.$this->title;
?>
<!-- main container -->

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加品牌</h3></div>
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

                        <?=$form->field($brand,'name')->textInput(['class'=>'span9'])?>
                        <?=$form->field($brand,'isshow')->radioList([0=>'不显示',1=>'显示'],['class'=>'span8'])?>
                        <?=$form->field($brand,'brandimg')->fileInput(['class'=>'span9'])?>
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
                        <i class="icon-lightbulb pull-left"></i>请在左侧表单当中填入要添加的品牌信息,包括品牌名称,图片等
                    </div>
                    <h6>商城用户说明</h6>
                    <p>可以在前台进行品牌检索商品</p>
                </div>
            </div>
        </div>
    </div>
