<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/18/0018
 * Time: 19:55
 */
namespace app\modules\controllers;
use app\modules\models\Admin;
use yii\web\Controller;
use Yii;
class PublicController extends Controller
{
    public function actionLogin()
    {
        if(!Yii::$app->admin->isGuest)
        {  $this->redirect(['default/index']);
            Yii::$app->end();

        }
        $model=new Admin();
        $this->layout=false;
        if(Yii::$app->request->isPost)
            {
                if($model->login(Yii::$app->request->post()))
            {
                $this->redirect(['default/index']);
                Yii::$app->end();
            }
        }
        return $this->render('login',compact('model'));
    }
    public function actionLogout()
    {
        Yii::$app->admin->logout(false);
        if(Yii::$app->admin->isGuest)
        {
           $this->redirect(['public/login']);
           Yii::$app->end();
        }
        $this->goBack();
    }
    public function actionSeekpassword()
    {
        if(!Yii::$app->admin->isGuest)
        {
            $this->redirect(['default/index']);
            Yii::$app->end();
        }
        $model=new Admin();
        $this->layout=false;
        if(Yii::$app->request->isPost)
        {
            if($model->seekpass(Yii::$app->request->post()))
            {
               Yii::$app->session->setFlash('info','邮件发送成功');
            }
        }

        return $this->render('seekpassword',compact('model'));
    }

}