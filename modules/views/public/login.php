<?php
use app\assets\AdminLoginAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

AdminLoginAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html class="login-bg">

<head>
    <title>登录 - 后台管理</title>
    <?php
    $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1.0']);
    $this->registerMetaTag(['http-equiv'=>'Content-Type','content'=>'text/html; charset=utf-8']);
    ?>
    <?php $this->head(); ?>
<body class="login-bg">
<?php $this->beginBody(); ?>
<div class="row-fluid login-wrapper">
    <a class="brand" href="index.html"></a>
    <?php $form=ActiveForm::begin(['fieldConfig'=>['template'=>'{input}{error}']]);?>
        <div class="span4 box">
            <div class="content-wrap">
                <h6>咸鱼商城 - 后台管理</h6>

                    <?php if(Yii::$app->session->hasFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                    <?=$form->field($model,'adminuser')->textInput(['class'=>'span12','placeholder'=>'管理员账号'])?>

                    <?=$form->field($model,'adminpass')->passwordInput(['class'=>'span12','placeholder'=>'管理员密码'])?>
                <a href="<?=Url::to(['public/seekpassword'])?>" class="forgot">忘记密码?</a>

                 <?=$form->field($model,'rememberMe')->checkbox([
                         'id'=>'emember-me',
                         'template'=>'<div class="remember">{input}<label for="remember-me">记住我</label></div>'
                 ])?>
                </div>
                 <?=Html::submitButton('登陆',['class'=>'btn-glow primary login'])?>
        </div>
     <?php ActiveForm::end()?>
</div>
<!-- scripts -->
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