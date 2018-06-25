<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/19/0019
 * Time: 22:49
 */

namespace app\modules\controllers;

use app\modules\models\Admin;
use app\modules\models\Rbac;
use Yii;
use yii\data\Pagination;
use yii\db\Exception;
use yii\web\Controller;

class ManageController extends CommonController
{
    protected $ismustLogin=['assign','mailchangepass','managers','reg','del','changeemail','changepass'];
    public function actionMailchangepass()
    {
        $this->layout = false;
        $time = Yii::$app->request->get('timestamp');
        $adminuser = Yii::$app->request->get('adminuser');
        $toke = Yii::$app->request->get('token');
        $model = new Admin();
        if (!$toke) {
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if ($model->createToken($adminuser, $time) != $toke) {
            Yii::$app->session->setFlash('info', 'Token无效');
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (time() - $time > 300) {
            Yii::$app->session->setFlash('info', 'token已经过期');
            $this->redirect(['public/login']);
            Yii::$app->end();
        }
        if (Yii::$app->request->isPost) {
            Yii::$app->session->setFlash('adminuser', $adminuser);
            if ($model->changePass(Yii::$app->request->post())) {
                Yii::$app->session->setFlash('info', '密码修改成功');
                $this->redirect(['public/login']);
                Yii::$app->end();
            }
            else
            {
                Yii::$app->session->setFlash('info', '密码修改失败,密码不能与修改前相同');
            }

        }
        return $this->render('repass', compact('model'));

    }

    public function actionManagers()
    {
        $this->layout = "layout1";
        $admins = Admin::find();
//        先获得总数；
        $count = $admins->count();
//        可以从配置文件中获得分页大小
        $pageSize = Yii::$app->params['pageSize']['managerSize'];
//        实例化分类
        $pager = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);
        $managers = $admins->offset($pager->offset)->limit($pager->pageSize)->all();
        return $this->render('managers', ['admins' => $managers, 'pager' => $pager]);
    }

    public function actionReg()
    {
        $admin = new Admin();
        $this->layout = 'layout1';
        if (Yii::$app->request->isPost) {
            if ($admin->adminadd(Yii::$app->request->post())) {
                Yii::$app->session->setFlash('info', '管理员添加成功');
            } else {
                Yii::$app->session->setFlash('info', '管理员添加失败');
            }
            $admin->adminuser = '';
            $admin->adminemail = '';
            $admin->adminpass = '';
            $admin->repass = '';

        }
        return $this->render('reg', compact('admin'));
    }

    public function actionDel()
    {
        $adminId = Yii::$app->request->get('adminid');
        if (!$adminId||$adminId==1) {
            $this->redirect(['manage/managers']);
            Yii::$app->end();
        }

        if (Admin::deleteAll('adminid=:id', ['id' => $adminId])) {
            Yii::$app->session->setFlash('info', '删除成功');

        } else {
            Yii::$app->session->setFlash('info', '删除失败');
        }

        $this->redirect(['manage/managers']);
    }
    public function actionChangeemail()
    {
        $admin=Admin::find()->where('adminuser=:user',['user'=>Yii::$app->admin->identity->adminuser])->one();
        $this->layout='layout1';
        if(Yii::$app->request->isPost)
        {
          if($admin->changeEmail(Yii::$app->request->post()))
          {
             Yii::$app->session->setFlash('info','邮箱修改成功');
          }
          else{
              Yii::$app->session->setFlash('info', '邮箱修改失败,邮箱不能与修改前相同');
          }
        }
        $admin->adminpass='';
        return $this->render('changeemail',compact('admin'));
    }
    public function actionChangepass()
    {
       $this->layout='layout1';
       $admin=Admin::find()->where('adminuser=:user',['user'=>Yii::$app->admin->identity->adminuser])->one();
       if(Yii::$app->request->isPost)
       {
           if($admin->changePass(Yii::$app->request->post()))
           {
              Yii::$app->session->setFlash('info','密码修改成功');
           }
           else{
               Yii::$app->session->setFlash('info', '密码修改失败,密码不能与修改前相同');
           }

       }
       $admin->adminpass='';
        $admin->repass='';
       return $this->render('changepass',compact('admin'));
    }
//    管理->角色and权限(无语)
    public function actionAssign()
    {
         $adminid=Yii::$app->request->get('adminid');
         if (empty($adminid))
         {
             throw new Exception('参数错误');
         }
         $admin=Admin::find()->where('adminid=:id',['id'=>$adminid])->one();
         if(!$admin)
         {
             throw new Exception('管理员不存在');
         }
         $auth=Yii::$app->authManager;
         $roles=Rbac::getOprions($auth->getRoles(),null);
         $permissions=Rbac::getOprions($auth->getPermissions(),null);
         if(Yii::$app->request->isPost)
         {
             $post=Yii::$app->request->post('children');
             $post=empty($post)?[]:$post;
             if(Rbac::grant($adminid,$post))
             {
               Yii::$app->session->setFlash('info','授权成功');
             }
             else
             {
                 Yii::$app->session->setFlash('info','授权失败');
             }
         }
         $children=Rbac::getOptionsByUser($adminid);


         return $this->render('assign',compact('admin','children','roles','permissions'));
    }
}