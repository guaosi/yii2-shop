<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/21/0021
 * Time: 15:10
 */
namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use crazyfd\qiniu\Qiniu;
use Yii;
class Brand extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'createdAtAttribute'=>'createtime',
                'updatedAtAttribute'=>'updatetime',
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['createtime','updatetime'],
                    ActiveRecord::EVENT_BEFORE_UPDATE=>['updatetime'],
                ]
            ]
        ];
    }
    public function attributeLabels()
    {
        return [
            'name'=>'品牌名称',
            'brandimg'=>'品牌图片',
            'isshow'=>'是否显示'
        ];
    }

    public static function tableName()
    {
        return "{{%brand}}";
    }
    public function rules(){
        return [
            ['id','required','message'=>'品牌id不能为空','on'=>['mod']],
            ['name','required','message'=>'品牌名称必须填写','on'=>['add','mod']],
            ['brandimg','required','message'=>'品牌图片不能为空','on'=>['add','mod']],
            ['isshow','in','range'=>[0,1],'message'=>'必须选择一个','on'=>['add','mod']],
            [['createtime','updatetime'], 'safe']
        ];
    }
    public function add($data)
    {
        $this->scenario='add' ;
        $this->load($data);
            if($this->save())
            {
                return true;
            }
        return false;
    }
    public function mod($data)
    {
        $this->scenario='mod';
        $this->load($data);
        if($this->validate())
        {
            if($this->save()!==false)
            {
                return true;
            }
        }
        return false;
    }
    public function upload()
    {
        if($_FILES['Brand']['error']['brandimg']>0)
        {
            return false;
        }
        $param=Yii::$app->params['qiniu'];
        $qiniu =new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
        $key = uniqid();
        $qiniu->uploadFile($_FILES['Brand']['tmp_name']["brandimg"],$key);
        $cover = $qiniu->getLink($key);
        return [
            'brandimg'=>$cover,
            'qiniu'=>$qiniu
        ];
    }
    public function makeOptions(){
        $brands=self::find()->all();
        $options=[];
        $options[0]='选择品牌';
        foreach ($brands as $val)
        {
            $options[$val->id]=$val->name;
        }
        return $options;
    }
}