<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/24/0024
 * Time: 15:51
 */
namespace app\models;
use yii\db\ActiveRecord;
class Address extends ActiveRecord
{
    public static function tableName()
    {
        return "{{%address}}";
    }
    public function rules()
    {
        return [
            [['firstname','lastname','address','telephone','userid','createtime'],'required'],
            [['postcode'],'safe']
        ];
    }

}