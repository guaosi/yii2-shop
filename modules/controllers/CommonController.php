<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/21/0021
 * Time: 15:09
 */
namespace app\modules\controllers;
use yii\db\Exception;
use yii\web\Controller;
use Yii;
class CommonController extends Controller
{
    public $layout='layout1';
    protected $only=['*'];
    protected $except=[];
    protected $ismustLogin=[];
    public function behaviors()
    {
        return [
            'access'=>[
                'class'=>\yii\filters\AccessControl::className(),
                'user'=>'admin',
                'only'=>$this->only,
                'except'=>$this->except,
                'rules'=>[
                    [
                        'allow'=>false,
                        'actions'=>$this->ismustLogin,
                        'roles'=>['?']
                    ],
                    [
                        'allow'=>true,
                        'actions'=>$this->ismustLogin,
                        'roles'=>['@']
                    ]
                ]
            ]
        ];
    }
    public function beforeAction($action)
    {
        if(!parent::beforeAction($action))
        {
            return false;
        }
        if(Yii::$app->admin->id==1)
        {
            return true;
        }
        $cName=$action->controller->id;
        $aName=$action->id;
        $acName=$cName.'/*';
        if(Yii::$app->admin->can($acName))
        {
            return true;
        }
        $acName=$cName.'/'.$aName;
        if(Yii::$app->admin->can($acName))
        {
            return true;
        }
        throw new \yii\web\UnauthorizedHttpException('对不起,您没有访问'.$acName.'的权限');
        return false;
    }


}

