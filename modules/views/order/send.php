<?php
use yii\bootstrap\ActiveForm;
$this->title='添加快递';
$this->params['breadcrumbs'][]=['label'=>' > 订单列表','url'=>'/admin/order/list.html'];
$this->params['breadcrumbs'][]='> '.$this->title;
?>
        <!-- main container -->

            <div class="container-fluid">
                <div id="pad-wrapper" class="new-user">
                    <div class="row-fluid header">
                        <h3>发货</h3></div>
                    <div class="row-fluid form-wrapper">
                        <!-- left column -->
                        <div class="span9 with-sidebar">
                            <div class="container">
                                <?$form=ActiveForm::begin([
                                        'options'=>['class'=>'new_user_form inline-input','id'=>'w0'],
                                        'fieldConfig'=>[
                                                'template'=>'<div class="span12 field-box">{label}{input}</div>{error}'
                                        ],
                                ])?>
                                <input type="hidden" name="Order[orderid]" value="<?=$orderid?>">

                                <?=$form->field($order,'expressno')->textInput([
                                        'class'=>'span9',
                                        'id'=>'order-expressno'
                                ])?>
                                        <p class="help-block help-block-error"></p>

                                    <div class="span11 field-box actions">
                                        <button type="submit" class="btn-glow primary">发货</button>
                                        <span>OR</span>
                                        <button type="reset" class="reset">取消</button></div>
                               <?php ActiveForm::end()?>
                            </div>
                        </div>
                        <!-- side right column -->
                        <div class="span3 form-sidebar pull-right">
                            <div class="alert alert-info hidden-tablet">
                                <i class="icon-lightbulb pull-left"></i>请在左侧表单当中填写快递单号</div>
                            <h6>快递单号说明</h6>
                            <p>填写快递单号</p>
                        </div>
                    </div>
                </div>
            </div>

