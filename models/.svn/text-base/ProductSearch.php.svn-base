<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/9/4/0004
 * Time: 19:34
 */
namespace app\models;
use yii\elasticsearch\ActiveRecord;
class ProductSearch extends ActiveRecord{
    public function attributes()
    {
        return ['productid','title','descr'];
    }
    public static function index()
    {
        return 'shopyii';
    }
    public static function type()
    {
        return 'products';
    }
}