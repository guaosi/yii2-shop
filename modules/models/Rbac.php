<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/9/3/0003
 * Time: 14:44
 */
namespace app\modules\models;
use yii\db\ActiveRecord;
use Yii;
class Rbac extends ActiveRecord
{
//    只是用来制作以及筛选是否可以显示的
    public static function getOprions($data,$parent)
    {
        $result=[];
       foreach ($data as $val)
       {
           if(empty(!$parent) && $val->name!=$parent->name && Yii::$app->authManager->canAddChild($parent,$val))
           {
               $result[$val->name]=$val->description;
           }
           if (is_null($parent))
           {
               $result[$val->name]=$val->description;
           }
       }
       return $result;
    }
    public static function addChildren($parent,$children)
    {
        $auth=Yii::$app->authManager;

        $trans=Yii::$app->db->beginTransaction();
        try{
            $auth->removeChildren($parent);
            foreach ($children as $child)
            {
                $obj=empty($auth->getRole($child))?$auth->getPermission($child):$auth->getRole($child);
                $auth->addChild($parent,$obj);
            }
            $trans->commit();
            return true;
        }catch (\Exception $e)
        {
           $trans->rollBack();
           return false;
        }

    }
    public static function getChildren($parent)
    {
        $auth=Yii::$app->authManager;
        $children=$auth->getChildren($parent->name);
        $result=[];
        $result['roles']=[];
        $result['permissions']=[];
        if(empty($children))
        {
            return $result;
        }
        foreach ($children as $child)
        {


            if($child->type==1)
            {
                $result['roles'][]=$child->name;
            }
            else
            {
                $result['permissions'][]=$child->name;

            }

        }
        return $result;
    }
    public static function grant($adminid,$children)
    {
       $trans=Yii::$app->db->beginTransaction();
       try{
            $auth=Yii::$app->authManager;
            $auth->revokeAll($adminid);
            foreach ($children as $child)
            {
              $obj=empty($auth->getRole($child))?$auth->getPermission($child):$auth->getRole($child);
              $auth->assign($obj,$adminid);
            }
           $trans->commit();
           return true;
       }catch (\Exception $e)
       {
           $trans->rollBack();
           return false;
       }
    }
    public static function getOptionsByUser($adminid)
    {
       $result=[];
       $result['roles']=[];
       $result['permissions']=[];
       $result['roles']= self::_makeOotions($adminid,1);
       $result['permissions']= self::_makeOotions($adminid,2);
       return $result;
    }
   public static function _makeOotions($adminid,$type)
   {
        $auth=Yii::$app->authManager;
        $func='getRolesByUser';
        if($type==2)
        {
            $func='getPermissionsByUser';
        }
        $items=$auth->$func($adminid);
        $result=[];
        if (empty($items))
        {
            return $result;
        }
         foreach ($items as $item)
         {
           $result[]=$item->name;
         }
         return $result;
   }

}