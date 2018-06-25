<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/31/0031
 * Time: 16:22
 */
namespace app\modules\controllers;
use app\modules\models\Rbac;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\db\Query;

class RbacController extends CommonController
{
    public $ismustLogin=['createrule','createrole','roles','assignitem'];
    public function actionCreaterole()
    {

        if(Yii::$app->request->isPost)
        {
            $auth=Yii::$app->authManager;

            $role=$auth->createRole(null);
            $post=Yii::$app->request->post();
            $role->name=$post['name'];
            $role->description=$post['description'];
            $role->ruleName=empty($post['rule_name'])?null:$post['rule_name'];
            $role->data=empty($post['data'])?null:$post['data'];
            if($auth->add($role))
            {
             Yii::$app->session->setFlash('info','角色创建成功');
            }
            else
            {
                Yii::$app->session->setFlash('info','角色创建失败');
            }
        }
       return $this->render('createitem');
    }
    public function actionRoles()
    {
        $auth=Yii::$app->authManager;
        $data=new ActiveDataProvider([
           'query'=>(new Query) ->from($auth->itemTable)->where('type=1')->orderBy('created_at desc'),
            'pagination'=>['pageSize'=>1]
        ]);
        return $this->render('items',['dataProvider'=>$data]);
    }
//    角色-权限
    public function actionAssignitem()
    {
        $name=Yii::$app->request->get('name');
        $auth=Yii::$app->authManager;
        $parent=$auth->getRole($name);

        $admins=Rbac::getOprions($auth->getRoles(),$parent);
        $permissons=Rbac::getOprions($auth->getPermissions(),$parent);
        if(Yii::$app->request->isPost)
        {
            $post=Yii::$app->request->post();
            if(Rbac::addChildren($parent,$post['children']))
            {
                Yii::$app->session->setFlash('info','权限分配成功');
            }
            else
            {
                Yii::$app->session->setFlash('info','权限分配失败');
            }
        }
        $children=Rbac::getChildren($parent);
        return $this->render('assignitem',compact('parent','admins','permissons','children'));

    }
    public function actionCreaterule()
    {
        $action=Yii::$app->controller->action->id;
        $controller=Yii::$app->controller->action->controller->id;

        if(Yii::$app->request->isPost)
        {
            $post=Yii::$app->request->post('class_name');
            if (empty($post))
            {
                throw new Exception('参数错误');
            }
            $className='app\\models\\'.$post;
            if(!class_exists($className))
            {
                throw new Exception('规则类不存在');
            }
           $rule=new $className;
            if(Yii::$app->authManager->add($rule))
            {
                Yii::$app->session->setFlash('info','添加成功');
            }
        }
        return $this->render('createrule');
    }



}