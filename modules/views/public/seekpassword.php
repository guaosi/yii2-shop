<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AdminLoginAsset;
AdminLoginAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html class="login-bg">

<head>
    <title>找回密码 - 后台管理</title>
    <?php
    $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1.0']);
    $this->registerMetaTag(['http-equiv'=>'Content-Type','content'=>'text/html; charset=utf-8']);
    ?>
    <?php $this->head(); ?>

</head>
<?php $this->beginBody(); ?>
<body class="login-bg">
<div class="row-fluid login-wrapper">
    <a class="brand" href="index.html"></a>
    <?php $form=ActiveForm::begin(['fieldConfig'=>['template'=>'{input}{error}']]);?>
        <div class="span4 box">
            <div class="content-wrap">
                <h6>咸鱼商城 - 找回密码</h6>
                <?php if(Yii::$app->session->getFlash('info'))
                {echo Yii::$app->session->getFlash('info');}?>
                <div class="form-group field-admin-adminuser">
                    <p class="help-block help-block-error"></p>
                    <?=$form->field($model,'adminuser')->textInput(['id'=>'admin-adminuser','class'=>'span12','placeholder'=>'管理员账号'])?>
                <div class="form-group field-admin-adminpass">
                    <p class="help-block help-block-error"></p>
                    <?=$form->field($model,'adminemail')->textInput(['id'=>'admin-adminpass','class'=>'span12','placeholder'=>'电子邮箱'])?>
                <a href="<?=Url::to(['public/login'])?>" class="forgot">返回登陆</a>

                 <?=Html::submitButton('找回密码',['class'=>'btn-glow primary login'])?>
        </div>
     <?php ActiveForm::end()?>
</div>
<!-- pre load bg imgs -->
                <?php $this->endBody(); ?>
</body>
<script type="text/javascript">$(function() {
        // bg switcher
        var $btns = $(".bg-switch .bg");
        $btns.click(function(e) {
            e.preventDefault();
            $btns.removeClass("active");
            $(this).addClass("active");
            var bg = $(this).data("img");

            $("html").css("background-image", "url('img/bgs/" + bg + "')");
        });

    });</script>
</html>

<?php $this->endPage(); ?>