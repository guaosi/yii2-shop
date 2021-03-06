<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = '角色管理';
$this->params['breadcrumbs'][] = '> ' . $this->title;
?>
<!-- main container -->

<div class="container-fluid">
    <div id="pad-wrapper" class="users-list">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                'description:text:名称',
                'name:text:标识',
                'rule_name:text:规则名称',
                'created_at:datetime:创建时间',
                'updated_at:datetime:更新时间',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '操作',
                    'template' => '{assign} {delete}',
                    'buttons' => [
                        'assign' => function ($url, $model, $key) {
                            return Html::a('分配权限', ['assignitem', 'name' => $model['name']]);
                        },
                    ]
                ]
            ],
            'layout'=>"\n{items}\n{summary}<div class='pagination pull-right'>{pager}</div>"
        ])
        ?>
        <!-- end users table --></div>
</div>

<!-- end main container -->