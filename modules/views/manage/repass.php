<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AdminLoginAsset;
AdminLoginAsset::register($this);
?>

<!DOCTYPE html>
<html class="login-bg">

<head>
    <title>重置密码 - 后台管理</title>
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
                <h6>慕课商城 - 重置密码</h6>
                <?php if(Yii::$app->session->hasFlash('info'))
                {
                    echo Yii::$app->session->getFlash('info');
                }
                ?>
                <div class="form-group field-admin-adminuser">
                    <p class="help-block help-block-error"></p>
                    <?=$form->field($model,'adminpass')->passwordInput(['id'=>'admin-adminpass','class'=>'span12','placeholder'=>'修改密码'])?>
                <div class="form-group field-admin-adminpass">
                    <p class="help-block help-block-error"></p>
                    <?=$form->field($model,'repass')->passwordInput(['id'=>'admin-adminpass','class'=>'span12','placeholder'=>'确认密码'])?>
                <a href="<?=Url::to(['public/login'])?>" class="forgot">返回登陆</a>

                 <?=Html::submitButton('修改',['class'=>'btn-glow primary login'])?>
        </div>
     <?php ActiveForm::end()?>
</div>
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

    });
</script>
</html>
<?php $this->endPage(); ?>