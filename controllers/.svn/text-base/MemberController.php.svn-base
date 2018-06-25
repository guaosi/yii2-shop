<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/18/0018
 * Time: 16:26
 */
namespace app\controllers;
use app\models\User;
use function Sodium\compare;
use yii\web\Controller;
use Yii;
class MemberController extends CommonController
{
    protected $except=['auth','reg','logout','qqlogin','qqcallback','qqreg'];
    public $layout=false;
    public function actionAuth()
    {
        if(!Yii::$app->user->isGuest)
        {
            $this->redirect(['index/index']);
        }
        if(Yii::$app->request->isGet){
            $url=Yii::$app->request->referrer;
            if(empty($url))
            {
                $url="/";
            }
            Yii::$app->session->setFlash('referrer',$url);
        }
        $this->layout='layout2';
        $user=new User();
        if(Yii::$app->request->isPost)
        {

            if($user->login(Yii::$app->request->post()))
            {
                $url=Yii::$app->session->getFlash('referrer');
                $this->redirect($url);
                Yii::$app->end();
            }
        }
       return $this->render('auth',compact('user'));
    }
    public function actionReg()
    {
        if(!Yii::$app->user->isGuest)
        {
            $this->redirect(['index/index']);
        }
        $this->layout='layout2';
       $user=new User();
       if(Yii::$app->request->isPost)
       {
           if($user->regByEmail((Yii::$app->request->post())))
           {
               Yii::$app->session->setFlash('info','注册邮件发送成功,请查收');
           }
       }
       return $this->render('auth',compact('user'));
    }
    public function actionLogout()
    {
        Yii::$app->user->logout(false);
        if(Yii::$app->user->isGuest)
        {
            $url=Yii::$app->request->referrer;
            if(empty($url))
            {
                $url="/";
            }
            $this->redirect($url);
            Yii::$app->end();
        }
        $this->goBack();
    }
    public function actionQqlogin()
    {
        require_once '../vendor/qqlogin/qqConnectAPI.php';
        $qq=new \QC();
        $qq->qq_login();
    }
    public function actionQqcallback()
    {
        require_once '../vendor/qqlogin/qqConnectAPI.php';
        $qqAtuh=new \OAuth();
        $access_token=$qqAtuh->qq_callback();
        $opentid=$qqAtuh->get_openid();
        $qq=new \QC($access_token,$opentid);
        $userinfo=$qq->get_user_info();
        $session=Yii::$app->session;
        $session['userinfo']=$userinfo;
        $user=User::find()->where('qqopenid=:id',['id'=>$opentid])->one();
        if(!is_null($user))
        {
            $user->lasttime=time();
            $user->lastip=ip2long(Yii::$app->request->getUserIP());
            $user->save();
           $user->authLogin($user->userid);
           $this->redirect(['index/index']);
           Yii::$app->end();
        }
        else
        {
            $session['qqopenid']=$opentid;
            $this->redirect(['member/qqreg']);
        }
    }
    public function actionQqreg()
    {

        if(Yii::$app->session['qqopenid']&&Yii::$app->session['user']['islogin']!=1)
        {
            $this->layout='layout2';
            $user=new User();
            if(Yii::$app->request->isPost)
            {
                $data=Yii::$app->request->post();
                $data['User']['qqopenid']=Yii::$app->session['qqopenid'];
                $newid=$user->regByAdmin($data,'qqreg');
                if($newid)
                {
                    $user->authLogin($newid);
                    Yii::$app->session->remove('qqopenid');
                    $this->redirect(['index/index']);
                    Yii::$app->end();
                }
            }
            return $this->render('qqreg',compact('user'));
        }
        else
        {
            $this->redirect(['index/index']);
            Yii::$app->end();
        }

    }
}