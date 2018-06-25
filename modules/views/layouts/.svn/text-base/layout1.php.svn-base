<?php
use yii\helpers\Url;
use app\assets\AdminAsset;
use yii\widgets\Breadcrumbs;
AdminAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?=$this->title?> - 后台管理</title>
    <?php
    $this->registerMetaTag(['name'=>'viewport','content'=>'width=device-width, initial-scale=1.0']);
    $this->registerMetaTag(['http-equiv'=>'Content-Type','content'=>'text/html; charset=utf-8']);

    ?>
    <meta name="csrf-token" content="<?=Yii::$app->request->getCsrfToken() ?>">
<?php $this->head(); ?>
<body>
<?php $this->beginBody(); ?>
<!-- navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <a class="brand" href="<?=Url::to(['default/index'])?>" style="font-weight:700;font-family:Microsoft Yahei">咸鱼商城 - 后台管理</a>

        <ul class="nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle hidden-phone" data-toggle="dropdown">
                    账户管理
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="<?=Url::to(['manage/changeemail'])?>">修改邮箱</a></li>
                    <li><a href="<?=Url::to(['manage/changepass'])?>">修改密码</a></li>

                </ul>
            </li>
            <li class="settings hidden-phone">
                <a href="<?=Url::to(['public/logout'])?>" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- end navbar -->

<!-- sidebar -->
<div id="sidebar-nav">
    <ul id="dashboard-menu">
        <?php
         $controller=Yii::$app->controller->id;
         $action=Yii::$app->controller->action->id;
         foreach (Yii::$app->params['adminmenu'] as $menu)
         {
             $show='hidden';
             if(Yii::$app->admin->can($menu['module'].'/*'))
             {
                 $show='show';
             }else
             {
                 if(!Yii::$app->admin->can($menu['url'])&&empty($menu['submenu']))
                 {
                     continue;
                 }
                 else
                 {
                     foreach ($menu['submenu'] as $submenu)
                     {
                         if(Yii::$app->admin->can($menu['module'].'/'.$submenu['url']))
                         {
                             $show='show';
                             break;
                         }
                     }
                 }
             }
             ?>
             <li class="<?=$menu['module']==$controller?'active':''?><?=$show?>">
                 <a class="<?=empty($menu['submenu'])?'':'dropdown-toggle'?>" href="<?=$menu['url']=='#'?'#':Url::to([$menu['url']])?>">
                     <i class="<?=$menu['icon']?>"></i>
                     <span><?=$menu['label']?></span>
                     <?php if(!empty($menu['submenu'])):?>
                     <i class="icon-chevron-down"></i>
                     <?php endif;?>
                 </a>
             <?php if(!empty($menu['submenu'])):?>
                 <ul class="submenu <?php if($menu['module']==$controller&&!empty($menu['submenu'])){echo 'active';}?>">
                     <?php foreach ($menu['submenu'] as $sub):?>
                     <?php if(!Yii::$app->admin->can($menu['module'].'/*')&&!Yii::$app->admin->can($menu['module'].'/'.$sub['url'])){continue;}?>
                     <li><a href="<?=Url::to([$menu['module'].'/'.$sub['url']]);?>"><?=$sub['label']?></a></li>

                     <?php endforeach;?>
                 </ul>
             <?php endif;?>
             </li>

         <?php
         }
        ?>
    </ul>
</div>
<!-- end sidebar -->
<div class="content">
    <?php if(!empty($this->params['breadcrumbs'])):?>
    <?=Breadcrumbs::widget([
            'homeLink'=>['label'=>'首页','url'=>'/admin/default/index.html'],
            'links'=>$this->params['breadcrumbs']
    ])?>
    <?php endif?>
<?=$content?>
</div>




<?php $this->endBody(); ?>

</body>

</html>
<?php $this->endPage(); ?>
