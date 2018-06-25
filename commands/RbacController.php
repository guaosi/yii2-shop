<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use Yii;
use yii\db\Exception;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $path=dirname(dirname(__FILE__)).'/modules/controllers';
        $paths=glob($path.'/*');
        $permissions=[];
        foreach ($paths as $pathone)
        {
            $contents=file_get_contents($pathone);
            preg_match('/class ([a-zA-Z]+)Controller/',$contents,$match);
            $cName=$match[1];
            $permissions[]=strtolower($cName.'/*');
            preg_match_all('/public function action([a-zA-Z_]+)/',$contents,$matches);

            foreach ($matches[1] as $val)
            {
                $permissions[]=strtolower($cName.'/'.$val);
            }
        }
        $auth=\Yii::$app->authManager;
        $trans=Yii::$app->db->beginTransaction();
        try{

            foreach ($permissions as $permission)
            {
                if(!$auth->getPermission($permission))
                {
                    $obj=$auth->createPermission($permission);
                    $obj->description=$permission;
                    if(!$auth->add($obj))
                    {
                        throw new Exception('import fail');
                    }
                }
            }
            $trans->commit();
            echo 'import success '.'<br>';
        }catch (\Exception $e)
        {
          $trans->rollBack();
        }

    }
}
