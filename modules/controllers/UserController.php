<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/20/0020
 * Time: 19:44
 */
namespace app\modules\controllers;
use app\models\Profile;
use app\models\User;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;
class UserController extends CommonController
{
    protected $ismustLogin=['users','reg','del'];

    public function actionUsers()
    {

       $this->layout='layout1';
       $user=User::find();
       $count=$user->count();
       $pageSize=Yii::$app->params['pageSize']['userSize'];
       $pager=new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
       $users=$user->offset($pager->offset)->limit($pager->limit)->all();
//       foreach ($users as $user)
//       {
//           var_dump($user->profile->avatar);
//           exit();
//       }
       return $this->render('users',compact('users','pager'));
    }
    public function actionReg()
    {
        $this->layout = 'layout1';
        $user = new User();
        if (Yii::$app->request->isPost)
        {

            if($user->regByAdmin(Yii::$app->request->post()))
            {
                Yii::$app->session->setFlash('info','用户添加成功');
            }
            $user->userpass='';
            $user->repass='';
        }
        return $this->render('reg',compact('user'));
    }
    public function actionDel()
    {
     $userid=Yii::$app->request->get('userid');
     if(!$userid)
     {
         $this->redirect(['user/users']);
         Yii::$app->end();
     }
     try{
       $trans=Yii::$app->db->beginTransaction();

       if(Profile::find()->where('userid=:user',['user'=>$userid])->one())
       {

         if(Profile::deleteAll('userid:user',['user'=>$userid])===false)
         {

           throw new \Exception();
         }
       }

       if(User::deleteAll('userid=:user',['user'=>$userid])===false)
       {

           throw new \Exception();
       }
       $trans->commit();
     }catch (\Exception $e)
     {
        if(Yii::$app->db->getTransaction())
        {
            $trans->rollBack();
        }
     }
     $this->redirect(['user/users']);
    }
}