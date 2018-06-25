<?php
use yii\helpers\Url;
$this->title='管理员列表';
$this->params['breadcrumbs'][]='> '.$this->title;
?>
        <!-- end sidebar -->
        <!-- main container -->

            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>管理员列表</h3>
                        <div class="span10 pull-right">
                            <a href="<?=Url::to(['manage/reg']);?>" class="btn-flat success pull-right">
                                <span>&#43;</span>添加新管理员</a></div>
                    </div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span2">管理员ID</th>
                                    <th class="span2">
                                        <span class="line"></span>管理员账号</th>
                                    <th class="span2">
                                        <span class="line"></span>管理员邮箱</th>
                                    <th class="span3">
                                        <span class="line"></span>最后登录时间</th>
                                    <th class="span3">
                                        <span class="line"></span>最后登录IP</th>
                                    <th class="span2">
                                        <span class="line"></span>添加时间</th>
                                    <th class="span2">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($admins as $admin):?>
                                <!-- row -->
                                <tr>
                                    <td><?=$admin->adminid?></td>
                                    <td><?=$admin->adminuser?></td>
                                    <td><?=$admin->adminemail?></td>
                                    <td><?=date('Y-m-d H:i:s',$admin->logintime);?></td>
                                    <td><?=long2ip($admin->loginip);?></td>
                                    <td><?=date('Y-m-d H:i:s',$admin->createtime)?></td>
                                    <td class="align-right">
                                     <?php if($admin->adminid!=1):?>
                                        <a href="<?=Url::to(['manage/del','adminid'=>$admin->adminid])?>">删除</a>
                                        <?php endif?>
                                        <a href="<?=Url::to(['manage/assign','adminid'=>$admin->adminid])?>">授权</a>
                                    </td>

                                </tr>
                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <?php if(Yii::$app->session->hasFlash('info')){echo Yii::$app->session->get('info');}?>
                    </div>
                    <div class="pagination pull-right">
                        <?=yii\widgets\LinkPager::widget(['pagination'=>$pager,'prevPageLabel'=>'&#8249','nextPageLabel'=>'&#8250'])?>

                    </div>
                    <!-- end users table --></div>
            </div>

