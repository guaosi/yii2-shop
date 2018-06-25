<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/24/0024
 * Time: 15:51
 */
namespace app\models;
use yii\behaviors\TimestampBehavior;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use Yii;
use yii\helpers\Url;

class Comment extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'createdAtAttribute'=>'createtime',
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['createtime'],
                ]
            ]
        ];
    }
    public static function tableName()
    {
        return "{{%comment}}";
    }
    public function rules()
    {
        return [
            ['product_id','required', 'message' => '商品id不能为空'],
            ['user_id','required', 'message' => '用户id不能为空'],
            ['score','required', 'message' => '星级不能为空'],
            ['content','required', 'message' => '评论内容不能为空'],
            ['score', 'in', 'range' => [1, 2, 3,4,5],'message'=>'星级必须在1-5之间'],
        ];
    }
    public function add($data)
    {
        $this->load($data);
        if($this->validate())
        {
            if($this->save(false))
            {
                return true;
            }
        }
        return false;
    }
//    判断用户是否购买了这件商品 商品多次购买也只能评论一次
    public function checkCanComment($productId){
       $userId=Yii::$app->user->id;
       $orderIds=Order::find()->select(['orderid'])->where('userid=:id and status=:stu',['id'=>$userId,'stu'=>260])->all();
       $ids=[];
       foreach ($orderIds as $val)
       {
           $ids[]=$val->orderid;
       }
//       订单中没有交易成功
       if (!count($ids))
       {
           return false;
       }
//       没有购买过该商品
        $num=OrderDetail::find()->andWhere(['orderid'=>$ids,'productid'=>$productId])->count('detailid');
        if (!$num)
        {
            return false;
        }
//        已经评论过了
        $final_num=self::find()->andWhere(['user_id'=>$userId,'product_id'=>$productId])->count('id');
        if ($final_num)
        {
            return false;
        }
        return true;
    }
    public function comments($productId=false){
        if ($productId)
        {
           $where='product_id=:pid';
           $prarm=['pid'=>$productId];
        }else
        {
            $where='';
            $prarm=[];
        }
        $cms = self::find()->joinWith('user')->where($where, $prarm);
        return $cms;
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['userid'=>'user_id']);
    }
    public function processPageComments($productid=false,$simple=false){
         $data=[];
         $comment=$this->comments($productid);

         $data['count']=$comment->count();

         $data['pageSize']=$productid?Yii::$app->params['pageSize']['commentIndexSize']:Yii::$app->params['pageSize']['commentAdminSize'];

         $data['pager']=new Pagination(['totalCount'=>$data['count'],'pageSize'=>$data['pageSize']]);
         $data['page']=Yii::$app->request->get('page')?Yii::$app->request->get('page'):1;
        if ($simple)
        {
           $data1=[];
           $data1['data']=$comment->offset($data['pager']->offset)->orderBy('id desc')->limit($data['pager']->limit)->asArray()->all();
//           分页显示代码
           $data1['pageData']=autoPageNum($data['page'],$data['count'],Url::to(['comment/comments']),Yii::$app->params['pageSize']['commentIndexSize'],Yii::$app->params['pageSize']['pageShowNum']);
        }else
        {
            $data['comments']=$comment->offset($data['pager']->offset)->orderBy('id desc')->limit($data['pager']->limit)->all();
        }
        return $simple?$data1:$data;
    }
}