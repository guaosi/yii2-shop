<?php
use yii\helpers\Url;
$this->title='品牌列表';
$this->params['breadcrumbs'][]='> '.$this->title;
?>
        <!-- main container -->

            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>品牌列表</h3>
                        <div class="span10 pull-right">
                            <a href="<?=Url::to(['brand/add'])?>" class="btn-flat success pull-right">
                                <span>&#43;</span>添加新品牌</a></div>
                    </div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <?php if(Yii::$app->session->hasFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3 sortable">
                                        <span class="line"></span>品牌名称</th>
                                    <th class="span5 sortable">
                                        <span class="line"></span>品牌图片</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>是否显示</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>创建时间</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>修改时间</th>
                                    <th class="span3 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <?php foreach ($brands as $brand):?>
                                <tr class="first">
                                    <td><?=$brand->name?></td>
                                    <td><img width="60" height="100" src="http://<?=$brand->brandimg?>"></td>
                                    <td><?=$brand->isshow?'显示':'不显示'?></td>
                                    <td><?=date('Y-m-d H:i:s',$brand->createtime)?></td>
                                    <td><?=date('Y-m-d H:i:s',$brand->updatetime)?></td>
                                    <td class="align-right">
                                        <a href="<?=Url::to(['brand/mod','brandid'=>$brand->id])?>">编辑</a>
                                        <a href="<?=Url::to(['brand/del','brandid'=>$brand->id])?>">删除</a></td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination pull-right">
                        <?=yii\widgets\LinkPager::widget(['pagination'=>$pager,'prevPageLabel'=>'&#8249','nextPageLabel'=>'&#8250'])?>
                    </div>
                    <!-- end users table --></div>
            </div>

        <!-- end main container -->