<?php
use yii\helpers\Url;
$this->title='分类列表';
$this->params['breadcrumbs'][]='> '.$this->title;
?>
        <!-- main container -->

            <div class="container-fluid">
                <div id="pad-wrapper" class="users-list">
                    <div class="row-fluid header">
                        <h3>分类列表</h3>

                        <div class="span10 pull-right">

                            <a href="<?=Url::to(['category/add'])?>" class="btn-flat success pull-right">
                                <span>&#43;</span>添加新分类</a></div>
                    </div>
                    <!-- Users table -->
                    <?php if(Yii::$app->session->hasFlash('info')){echo Yii::$app->session->getFlash('info');}?>
                    <div class="row-fluid table">
                        <?= \yiidreamteam\jstree\JsTree::widget([
                            'containerOptions' => [

                                 'class' => 'data-tree',
                            ],
                            'jsOptions' => [
                                'core' => [
                                    'check_callback'=>true,
                                    'multiple' => false,
                                    'data' => [
//                                   ['id':1,'text':'服装','children':['id':2,'text':'游戏','children':[]]]
                                        'url' => \yii\helpers\Url::to(['category/gettree','page'=>$page,'per-page'=>$perpage]),
                                    ],
                                    'themes' => [
                                     'stripes'=>true,
                                     'variant'=>'large'
                                    ]
                                ],
                                'plugins'=>[
                                        'contextmenu','dnd','search','state','types','wholerow'
                                ]
                            ]
                        ]) ?>


                    </div>
                    <div class="pagination pull-right">
                        <?=yii\widgets\LinkPager::widget(['pagination'=>$pager,'prevPageLabel'=>'&#8249','nextPageLabel'=>'&#8250'])?>

                    </div>
                    <!-- end users table --></div>
            </div>
<script>
    $(function () {
        $('#w0').on('rename_node.jstree',function (event,obj) {
            var newtext=obj.text;
            var old=obj.old;
            var id=obj.node.id;
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                url:"<?=Url::to(['category/rename'])?>",
                type:'post',
                data:{id:id,old:old,newtext:newtext,_csrf:csrfToken},
                dataType:'json',
                success:function (res) {
                    if(res.code!==1)
                    {
                        alert(res.msg);
                    }
                }
            })
        });
        $('#w0').on('delete_node.jstree',function (event,obj) {
            if(confirm('确认要删除这个分类吗(包括其所有子类)?'))
            {
                var id=obj.node.id;
                var csrfToken = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    url:"<?=Url::to(['category/deltree'])?>",
                    type:'post',
                    data:{id:id,_csrf:csrfToken},
                    dataType:'json',
                    success:function (res) {
                        if(res.code!==1)
                        {
                            alert(res.msg);
                        }
                    }
                })
            }
            else
            {
                window.location.reload();
            }
        });
        $('#w0').on('move_node.jstree',function (event,obj) {
           var id=obj.node.id;
           var parentid=obj.parent;
//           parentid # 代表顶级
            var csrfToken = $('meta[name="csrf-token"]').attr("content");
            $.ajax({
                url:"<?=Url::to(['category/changetree'])?>",
                type:'post',
                data:{id:id,parentid:parentid,_csrf:csrfToken},
                dataType:'json',
                success:function (res) {
                    if(res.code!==1)
                    {
                        alert(res.msg);
                    }
                }
            })
        });
    })


</script>