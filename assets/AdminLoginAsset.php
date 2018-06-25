<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminLoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'admin/css/bootstrap/bootstrap.css',
        'admin/css/bootstrap/bootstrap-responsive.css',
        'admin/css/bootstrap/bootstrap-overrides.css',
        'admin/css/lib/jquery-ui-1.10.2.custom.css',
        'admin/css/lib/font-awesome.css',
        'admin/css/layout.css',
        'admin/css/elements.css',
        'admin/css/icons.css',
        'admin/css/compiled/signin.css',

    ];
    public $js = [
         'admin/js/jquery-latest.js',
        'admin/js/bootstrap.min.js',
        'admin/js/theme.js',
        ['admin/js/html5.js','condition'=>'lte IE9']
    ];
    public $depends = [


    ];
    public $jsOptions=[
        'position' => \yii\web\View::POS_HEAD
    ];
}
