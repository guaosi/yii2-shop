<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/21/0021
 * Time: 15:09
 */
namespace app\modules\controllers;
use app\models\Category;
use Yii;
use yii\data\Pagination;
class CategoryController extends CommonController
{

    protected $ismustLogin=['cates','add','gettree','rename','deltree','changetree'];


    public function actionCates()
    {
       $this->layout='layout1';
//        $category=new Category();
//        $list=$category->getData();
//        显示分页
        $pcategory=Category::find()->where('parentid=:pid',['pid'=>0]);
        $pager=new Pagination(['totalCount'=>$pcategory->count(),'pageSize'=>8]);
        $page=empty(Yii::$app->request->get('page'))?1:Yii::$app->request->get('page');
        $perpage=empty(Yii::$app->request->get('per-page'))?6:Yii::$app->request->get('per-page');



       return $this->render('cates',compact('pager','page','perpage'));
    }
    public function actionAdd()
    {
        $this->layout='layout1';
        $category=new Category();
        if(Yii::$app->request->isPost)
        {
            if($category->cateadd(Yii::$app->request->post()))
            {
                Yii::$app->session->setFlash('info','分类添加成功');
                $category->title='';
            }
        }
            $list=$category->makeOptions();
        return $this->render('add',compact('category','list'));
    }
//    public function actionMod()
//    {
//        $this->layout='layout1';
//        $cateid=Yii::$app->request->get('cateid');
//        if(empty($cateid))
//        {
//            Yii::$app->session->setFlash('info','分类修改失败');
//            $this->redirect(['category/mod']);
//            Yii::$app->end();
//        }
//        $category=Category::find()->where('cateid=:id',['id'=>$cateid])->one();
//        $list=$category->makeOptions();
//        unset($list[$cateid]);
//        if(Yii::$app->request->isPost)
//        {
//            $data=Yii::$app->request->post();
//            if($data['Category']['parentid']==$cateid)
//            {
//                Yii::$app->session->setFlash('info','分类修改失败');
//                $this->redirect(['category/mod']);
//                Yii::$app->end();
//            }
//            if($category->mod($data))
//            {
//                Yii::$app->session->setFlash('info','分类修改成功');
//            }
//        }
//        return $this->render('mod',compact('category','list'));
//    }
//    public function actionDel()
//    {
//         $cateid=Yii::$app->request->get('cateid');
//        if(empty($cateid))
//        {
//            Yii::$app->session->setFlash('info','分类删除失败');
//            $this->redirect(['category/cates']);
//            Yii::$app->end();
//        }
//         $cate=new Category();
//         $cateIds=$cate->getChildren($cateid);
//         $cateIds[]=(int)$cateid;
//         $cateIds=implode(',',$cateIds);
//         if($cate->deleteAll("cateid in ($cateIds)"))
//         {
//             Yii::$app->session->setFlash('info','分类删除成功');
//             $this->redirect(['category/cates']);
//             Yii::$app->end();
//         }
//        Yii::$app->session->setFlash('info','分类删除失败');
//        $this->redirect(['category/cates']);
//    }
    public function actionGettree()
    {

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax) {
            $category = new Category();
            $data = $category->getJsTree();

            if ($data) {
                return $data['data'];
            } else {
                return [];
            }
        }
    }
    public function actionRename()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax)
        {
           $id=Yii::$app->request->post('id');
           $old=Yii::$app->request->post('old');
           $newtext=Yii::$app->request->post('newtext');
           if($old==$newtext)
           {
               return [
                   'code'=>1,
                   'msg'=>'修改成功'
               ];
           }
           $category=Category::find()->where('cateid=:cid',['cid'=>$id])->one();
               if(!$category)
               {
                   return [
                       'code'=>-1,
                       'msg'=>'修改失败,修改节点不存在'
                   ];
               }
           $category->scenario='rename';
           $category->title=$newtext;
           if($category->save())
           {
               return [
                   'code'=>1,
                   'msg'=>'修改成功'
               ];
           }
           else
           {
               return [
                   'code'=>0,
                   'msg'=>'修改失败'
               ];
           }
        }
        else
        {
          return [
              'errorcode'=>-2,
              'msg'=>'不允许非法访问'
              ];
        }
    }
    public function actionDeltree()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax)
        {
           $id=Yii::$app->request->post('id');
           $cate=new Category();
           $category=$cate->find()->where('cateid=:cid',['cid'=>$id])->one();
           if(!$category)
           {
               return [
                   'code'=>-1,
                   'msg'=>'删除失败,删除节点不存在'
               ];
           }
            $cateIds=$cate->getChildren($id);
            $cateIds[]=(int)$id;
            $cateIds=implode(',',$cateIds);
            if($cate->deleteAll("cateid in ($cateIds)"))
            {
                return [
                    'code'=>1,
                    'msg'=>'删除成功'
                ];
            }
           else
           {
               return [
                   'code'=>0,
                   'msg'=>'修改失败'
               ];
           }
        }
        else
        {
          return [
              'errorcode'=>-2,
              'msg'=>'不允许非法访问'
              ];
        }
    }
    public function actionChangetree()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if(Yii::$app->request->isAjax)
        {
            $id=Yii::$app->request->post('id');
            $parentid=Yii::$app->request->post('parentid');
            $cate=new Category();
            $category=$cate->find()->where('cateid=:cid',['cid'=>$id])->one();
            if(!$category)
            {
                return [
                    'code'=>-1,
                    'msg'=>'修改失败,修改节点不存在'
                ];
            }
            $parentid=$parentid=='#'?0:$parentid;
            $category->scenario='change';
            $category->parentid=$parentid;
            if($category->save())
            {
                return [
                    'code'=>1,
                    'msg'=>'修改成功'
                ];
            }
            else
            {
                return [
                    'code'=>0,
                    'msg'=>'修改失败'
                ];
            }
        }
        else
        {
            return [
                'errorcode'=>-2,
                'msg'=>'不允许非法访问'
            ];
        }
    }
}

