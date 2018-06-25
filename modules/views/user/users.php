<?php
use yii\helpers\Url;
$this->title='会员列表';
$this->params['breadcrumbs'][]='> '.$this->title;
?>
<!-- main container -->

    <div class="container-fluid">
        <div id="pad-wrapper" class="users-list">
            <div class="row-fluid header">
                <h3>会员列表</h3>
                <div class="span10 pull-right">
                    <a href="<?=Url::to(['user/reg'])?>" class="btn-flat success pull-right">
                        <span>&#43;</span>添加新用户</a></div>
            </div>
            <!-- Users table -->
            <div class="row-fluid table">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th class="span3 sortable">
                            <span class="line"></span>用户名</th>
                        <th class="span3 sortable">
                            <span class="line"></span>邮箱</th>
                        <th class="span2 sortable">
                            <span class="line"></span>QQ</th>
                        <th class="span3 sortable">
                            <span class="line"></span>创建时间</th>
                        <th class="span3 sortable">
                            <span class="line"></span>最后登陆时间</th>
                        <th class="span3 sortable">
                            <span class="line"></span>最后登陆IP</th>
                        <th class="span3 sortable align-right">
                            <span class="line"></span>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <!-- row -->
                    <?php foreach($users as $user):?>

                    <tr class="first">
                        <td>
                                <img src="/admin/img/contact-img.png" class="img-circle avatar hidden-phone" />
                            <a href="#" class="name"><?=$user->username?></a>
                            <span class="subtext"></span>
                        </td>
                        <td><?php echo empty($user->useremail)?'未绑定':$user->useremail?></td>
                        <td><?php echo empty($user->qqopenid)?'未绑定':'已绑定'?></td>
                        <td><?=date('Y-m-d H:i:s',$user->createtime)?></td>
                        <td><?=empty($user->lasttime)?'未登陆':date('Y-m-d H:i:s',$user->lasttime)?></td>
                        <td><?=empty($user->lastip)?'未登陆':long2ip($user->lastip)?></td>
                        <td class="align-right">
                            <a href="<?=Url::to(['user/del','userid'=>$user->userid])?>">删除</a></td>
                    </tr>
                    <?php endforeach;?>
                    </tbody>

                </table>

            </div>
            <div class="pagination pull-right">                <?=yii\widgets\LinkPager::widget(['pagination'=>$pager,'prevPageLabel'=>'&#8249','nextPageLabel'=>'&#8250'])?></div>
            <!-- end users table --></div>
    </div>

<!-- end main container -->