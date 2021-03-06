<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
$this->title='分配权限';
$this->params['breadcrumbs'][]=['label'=>' > 角色管理','url'=>'/admin/rbac/roles.html'];
$this->params['breadcrumbs'][]='> '.$this->title;
?>
<!-- main container -->

    <div class="container-fluid">
        <div id="pad-wrapper" class="new-user">
            <div class="row-fluid header">
                <h3>分配权限</h3></div>
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
                        <div class="span12 field-box">
                          <?=Html::label('角色名称',null).Html::encode($parent->name);?>
                        </div>
                        <div class="span12 field-box">
                          <?=Html::label('角色子节点',null).Html::checkboxList('children',$children['roles'],$admins)?>
                        </div>
                        <div class="span12 field-box">
                          <?=Html::label('权限子节点',null).Html::checkboxList('children',$children['permissions'],$permissons)?>

                        </div>



                            <div class="span11 field-box actions">
                                <?=Html::submitButton('分配',['class'=>'btn-glow primary'])?>
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