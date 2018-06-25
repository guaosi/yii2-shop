<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title='完善注册信息';
?>
    <main id="authentication" class="inner-bottom-md">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <section class="section sign-in inner-right-xs">
                        <img src="<?=Yii::$app->session['userinfo']['figureurl_2']?>">
                        <h2 class="bordered">完善您的个人信息</h2>
                        <p>欢迎您 <?=Yii::$app->session['userinfo']['nickname']?>，请您输入要注册的账户名密码</p>

                      <?php $form=ActiveForm::begin([
                              'options'=>['role'=>'form','class'=>'login-form cf-style-1'],
                             'fieldConfig'=>[
                                 'template'=>'<div class="field-row">{label}{input}</div>{error}'
                             ]
                      ])?>
                                <?=$form->field($user,'username')->textInput(['class'=>'le-input'])?>
                                <?=$form->field($user,'userpass')->passwordInput(['class'=>'le-input'])?>
                                <?=$form->field($user,'repass')->passwordInput(['class'=>'le-input'])?>

                            <?=Html::submitButton('完善信息',['class'=>'le-button huge'])?>
<?php ActiveForm::end()?>
                    </section><!-- /.sign-in -->
                </div><!-- /.col -->



            </div><!-- /.row -->
        </div><!-- /.container -->
    </main><!-- /.authentication -->