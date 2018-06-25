<?php
use yii\helpers\Url;
$this->title='评论列表';
$this->params['breadcrumbs'][]='> '.$this->title;
?>
        <!-- main container -->

            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>评论列表</h3>
                    </div>
                    <!-- Users table -->
                    <div class="row-fluid table">
                        <?php if(Yii::$app->session->hasFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="span3 sortable">
                                        <span class="line"></span>商品ID</th>
                                    <th class="span5 sortable">
                                        <span class="line"></span>评论内容</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>评论星级</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>评论用户</th>
                                    <th class="span2 sortable">
                                        <span class="line"></span>评论时间</th>
                                    <th class="span3 sortable align-right">
                                        <span class="line"></span>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row -->
                                <?php foreach ($comments as $comment):?>
                                <tr class="first">
                                    <td><a href="<?php echo Yii::$app->urlManager->createAbsoluteUrl(['product/detail','productid'=>$comment->product_id]); ?>"><?=$comment->product_id?></a></td>
                                    <td><?=$comment->content?></td>
                                    <td><?=$comment->score?></td>
                                    <td><?=$comment->user->username?></td>
                                    <td><?=date('Y-m-d',$comment->createtime)?></td>
                                    <td class="align-right">
                                        <a href="<?=Url::to(['comment/del','id'=>$comment->id])?>">删除</a></td>
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