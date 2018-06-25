<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/24/0024
 * Time: 16:36
 */
namespace app\models;
use yii\db\ActiveRecord;
class OrderDetail extends ActiveRecord
{
    public function rules()
    {
        return [
            [['productid','title','cover', 'productnum', 'price', 'orderid', 'createtime'],'required'],
        ];
    }

    public static function tableName()
    {
        return "{{%order_detail}}";
    }

    public function add($data)
    {
        if ($this->load($data) && $this->save()) {
            return true;
        }
        return false;
    }



}
