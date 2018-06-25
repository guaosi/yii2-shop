<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/20/0020
 * Time: 19:47
 */
namespace app\models;
use Yii;
use yii\db\ActiveRecord;
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public $repass;
    public $loginname;
    public $rememberMe = true;
    public function attributeLabels()
    {
        return [
          'username'=>'用户名',
           'useremail'=>'电子邮箱',
            'userpass'=>'密码',
            'repass'=>'确认密码',
            'loginname'=>'用户名/电子邮箱'
        ];
    }
    public function rules()
    {
        return [
            ['qqopenid','required','message'=>'openid必须填写','on'=>['regbyadmin','qqreg']],
            ['qqopenid','unique','message'=>'openid已存在','on'=>['regbyadmin','qqreg']],
            ['username','required','message'=>'用户名必须填写','on'=>['regbyadmin','qqreg']],
            ['loginname','required','message'=>'用户名/邮箱必须填写','on'=>['login']],
            ['username','unique','message'=>'用户名已存在','on'=>['regbyadmin','qqreg']],
            ['userpass','required','message'=>'密码必须填写','on'=>['regbyadmin','login','qqreg']],
            ['repass','required','message'=>'确认密码必须填写','on'=>['regbyadmin','qqreg']],
            ['repass','compare','compareAttribute'=>'userpass','message'=>'两次密码输入不一致','on'=>['regbyadmin','qqreg']],
            ['useremail','required','message'=>'邮箱必须填写','on'=>['regbyadmin','reg']],
            ['useremail','email','message'=>'邮箱格式不正确','on'=>['regbyadmin','reg']],
            ['useremail','unique','message'=>'邮箱已存在','on'=>['regbyadmin','reg']],
            ['userpass','valiatePass','on'=>['login']]
        ];
    }

    public static function tableName()
    {
        return "{{%user}}";
    }
    public function getProfile()
    {
        return $this->hasOne(Profile::className(),['userid'=>'userid']);
    }
    public function regByAdmin($data,$type='regbyadmin')
    {
        $this->scenario=$type;
        $this->load($data);
        if($this->validate())
        {

            $this->userpass=Yii::$app->getSecurity()->generatePasswordHash($this->userpass) ;
            $this->createtime=time();
            $id=$this->save(false);
            if($id)
            {
                if($type=='qqreg')
                {
                    return $id;
                }
                else
                {
                    return true;
                }

            }
        }
        return false;
    }
    public function regByEmail($data)
    {
        $this->scenario='reg';
        $this->load($data);

        if($this->validate())
        {
            $this->username='shop_'.uniqid();
            $this->userpass=uniqid();
            $mailer = Yii::$app->mailer->compose('createuser', ['userpass' => $this->userpass, 'username' => $this->username]);
           // $mailer->setFrom(Yii::$app->params['EmailFrom']);
            $mailer->setFrom(Yii::$app->params['EmailFrom']);
            $mailer->setTo($this->useremail);
            $mailer->setSubject('咸鱼商城-新建用户');
//            if ($mailer->send()&&$this->regByAdmin($data, 'reg')) {
            if ($mailer->queue()&&$this->regByAdmin($data, 'reg')) {
                return true;
            }
        }
        return false;
    }
    public function login($data)
    {
       $this->scenario='login';
       $this->load($data);
       $this->rememberMe=$data['User']['rememberMe']==false?false:true;
       if($this->validate()){
           return true;
       }
       return false;
    }
    public function getUser()
    {
      return self::find()->where('userid=:uid',['uid'=>$this->userid])->one();
    }
    public function valiatePass()
    {
        if(!$this->hasErrors())
        {
            $loginname='username';
            if (preg_match('/@/', $this->loginname)) {
                $loginname = "useremail";
            }
            $data=self::find()->where($loginname.'=:name',['name'=>$this->loginname])->one();
            if(is_null($data))
            {
                $this->addError('userpass','用户名/邮箱不存在');
                return false;
            }
            if(!Yii::$app->getSecurity()->validatePassword($this->userpass,$data->userpass))
            {
                $this->addError('userpass','用户名/邮箱与密码不匹配');
            }
            else
            {
//                $lifttime=$this->rememberMe?24*3600:0;
//                session_set_cookie_params($lifttime);
//                $session=Yii::$app->session;
//                $session['user']=[
//                    'loginname'=>$data->username,
//                    'islogin'=>1,
//                    'userid'=>$data->userid
//                ];
//                验证成功 加入登陆时间以及ip
                $data->lasttime=time();
                $data->lastip=ip2long(Yii::$app->request->getUserIP());
                $data->save();
                $this->authLogin($data->userid);
            }
        }
    }

    public static function findIdentity($id){
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null){
          return null;
    }
    public function getId(){
        return $this->userid;
    }
    public function getAuthKey(){
           return '';
    }
    public function validateAuthKey($authKey){
           return true;
    }
    public function authLogin($userid)
    {
        $this->userid=$userid;
        Yii::$app->user->login($this->getUser(),$this->rememberMe?24*3600:0);
    }
}
