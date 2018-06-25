<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title='添加新会员';
$this->params['breadcrumbs'][]=['label'=>' > 会员列表','url'=>'/admin/user/users.html'];
$this->params['breadcrumbs'][]='> '.$this->title;
?>
<!-- main container -->

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>添加新会员</h3></div>
            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span9 with-sidebar">
                    <?php if(Yii::$app->session->getFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                    <div class="container">
                        <?php $form=ActiveForm::begin([
                                'options'=>['class'=>'new_user_form inline-input','id'=>'w0'],
                                'fieldConfig'=>[
                                 'template'=>'<div class="span12 field-box">{label}{input}</div>{error}'
                                ]
                        ])?>
                        <?=$form->field($user,'username')->textInput(['class'=>'span9'])?>
                        <?=$form->field($user,'useremail')->textInput(['class'=>'span9'])?>
                        <?=$form->field($user,'userpass')->passwordInput(['class'=>'span9'])?>
                        <?=$form->field($user,'repass')->passwordInput(['class'=>'span9'])?>




                            <div class="span11 field-box actions">
                                <?=Html::submitButton('添加',['class'=>'btn-glow primary'])?>
                                <span>OR</span>
                                <?=Html::resetButton('取消',['class'=>'btn-glow primary'])?>

                            </div>
                       <?php ActiveForm::end()?>
                    </div>
                </div>
                <!-- side right column -->
                <div class="span3 form-sidebar pull-right">
                    <div class="alert alert-info hidden-tablet">
                        <i class="icon-lightbulb pull-left"></i>请在左侧表单当中填入要添加的用户信息,包括用户名,密码,电子邮箱</div>
                    <h6>商城用户说明</h6>
                    <p>可以在前台进行登录并且进行购物</p>
                    <p>前台也可以注册用户</p>
                </div>
            </div>
        </div>
    </div>

<!-- end main container -->