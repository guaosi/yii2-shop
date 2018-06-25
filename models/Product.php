<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/22/0022
 * Time: 11:43
 */
namespace app\models;
use MongoDB\BSON\Timestamp;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
class Product extends ActiveRecord
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
            'cateid' => '分类名称',
            'brandid' => '品牌名称',
            'title'  => '商品名称',
            'descr'  => '商品描述',
            'price'  => '商品价格',
            'ishot'  => '是否热卖',
            'issale' => '是否促销',
            'saleprice' => '促销价格',
            'num'    => '库存',
            'cover'  => '图片封面',
            'pics'   => '商品图片',
            'ison'   => '是否上架',
            'istui'   => '是否推荐',
        ];
    }
    public function rules()
    {
        return [
            ['title', 'required', 'message' => '商品名称不能为空'],
            ['descr', 'required', 'message' => '商品描述不能为空'],
            ['cateid', 'required', 'message' => '商品分类不能为空'],
            ['brandid', 'required', 'message' => '商品品牌不能为空'],
            ['price', 'required', 'message' => '商品单价不能为空'],
            [['price','saleprice'], 'number', 'min' => 0.01, 'message' => '价格必须是数字'],
            ['num', 'integer', 'min' => 0, 'message' => '库存必须是数字'],
            [['issale','ishot', 'ison', 'istui'],'in','range'=>[0,1],'message'=>'必须选择一个'],
            [['cover'], 'safe'],
            [['pics','createtime','detail'], 'safe'],
        ];
    }
    public static function tableName()
    {
        return "{{%product}}";
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
    public function mod($data)
    {
        $this->load($data);
        if($this->save())
        {
            return true;
        }
        return false;
    }
    public static function checknum($cart,$type=true)
    {
        $flag=true;
        $productids=[];
        foreach ($cart as $val)
        {
          $productids[]=$val->productid;
        }
        $products=self::find()->where(['productid'=>$productids])->all();
        $data=[];
        $data['totalPrice']=0;
        $i=0;
        foreach ($cart as $val)
        {
            foreach ($products as $v)
            {
                if($val->productid==$v->productid)
                {
//                    val是购物车数据 v是商品数据
                    if($v->num-$val->productnum<0)
                    {
                        $flag=false;
                        break;
                    }
                    else
                    {
                        if($type)
                        {
                            $data[$i]['productid']=$v->productid;
                            $data[$i]['pproductnum']=$v->num;
                            $data[$i]['title']=$v->title;
                            $data[$i]['cover']=$v->cover;
                            $data[$i]['price']=$v->issale?$v->saleprice:$v->price;
                            $data[$i]['productnum']=$val->productnum;
                            $data['totalPrice']=($data['totalPrice']*100+$data[$i]['price']*$data[$i]['productnum']*100)/100;

                        }
                        else
                        {
//                            支付的检测 只要返回商品数量跟商品id即可
                            $data[$i]['productid']=$v->productid;
                            $data[$i]['productnum']=$val->productnum;
                        }
                        $i++;
                    }
                }
            }
            if(!$flag)
            {
                break;
            }
        }
        if(!$flag)
        {
            return false;
        }
        else
        {
            return $data;
        }
    }
    public static function viewHistory($productid)
   {

       $cookieread=\Yii::$app->request->cookies;
       $cookie=\Yii::$app->response->cookies;
       //先看看cookie是否有数据
       if($cookieread->has('producthistory'))
       {
           //           有数据，就插入
           $productids=json_decode($cookieread->getValue('producthistory'));
//           查看是否已经在了
           if(!in_array($productid,$productids))
           {
//           存在 查看是否已经有8个了
              if(count($productids)>=8)
              {
//                  是的话 移除最后一个
                  array_pop($productids);
              }
//              然后再插入
               array_unshift($productids,$productid);
           }
           else
           {
//               获得数组下标
                 $key=array_keys($productids,$productid);
                 if ($key[0])
                 {
                     unset($productids[$key[0]]);
                     array_unshift($productids,$productid);
                 }

           }
       }
       else
       {
//           没有值 新建一个cookie
           $productids[]=$productid;
       }
       $cookie->add(new \yii\web\Cookie([
           'name' => 'producthistory',
           'value' => json_encode($productids),
           'expire'=>time()+3600*24*15,
           'httpOnly'=>true
       ]));
   }
}