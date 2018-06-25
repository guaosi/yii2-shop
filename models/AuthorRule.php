<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/9/3/0003
 * Time: 22:04
 */
namespace app\models;
use yii\rbac\Rule;
use Yii;
class AuthorRule extends Rule
{
    public $name='isAuthor';
    public function execute($user, $item, $params)
    {
        $action=Yii::$app->controller->action->id;
        $controller=Yii::$app->controller->action->controller->id;
        if($controller.'/'.$action == 'category/deltree')
        {
            $cateid=Yii::$app->request->post('id');
            $cate=Category::find()->where('cateid=:cid',['cid'=>$cateid])->one();
            return  $cate->adminid==$user?true:false;
        }
        return true;
    }
}