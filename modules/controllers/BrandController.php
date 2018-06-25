<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/22/0022
 * Time: 11:40
 */
namespace app\modules\controllers;
use app\models\Brand;
use crazyfd\qiniu\Qiniu;
use Yii;
use yii\data\Pagination;
class BrandController extends CommonController
{
    protected $ismustLogin=['brands','add','mod','removepic','del'];

    public function actionBrands()
    {

        $this->layout='layout1';
        $brands=Brand::find();
        $count=$brands->count();
        $pagesize=Yii::$app->params['pageSize']['productSize'];
        $pager=new Pagination(['totalCount'=>$count,'pageSize'=>$pagesize]);
        $brands=$brands->offset($pager->offset)->limit($pager->limit)->all();
        return $this->render('brands',compact('brands','pager'));
    }
    public function actionAdd()
    {
        $this->layout='layout1';
        $brand=new Brand();
        if(Yii::$app->request->isPost)
        {
            $upload=$brand->upload();
            if($upload)
            {
                $data=Yii::$app->request->post();
                $data['Brand']['brandimg']=$upload['brandimg'];
                if($brand->add($data))
                {
                    Yii::$app->session->setFlash('info','品牌添加成功');
                }
                else
                {
                    Yii::$app->session->setFlash('info','品牌添加失败');
                }
            }
            else
            {
                $brand->addError('brandimg','品牌图片必须上传');
                Yii::$app->session->setFlash('info','品牌添加失败');
            }
        }
        else
        {
            $brand->isshow=1;
        }

        return $this->render('add',compact('brand'));
    }

    public function actionMod()
    {
        $this->layout='layout1';
        $brandid=Yii::$app->request->get('brandid');
        $brand=Brand::find()->where('id=:id',['id'=>$brandid])->one();
        if(Yii::$app->request->isPost)
        {
            $data=Yii::$app->request->post();
            if($_FILES['Brand']['error']['brandimg']==0)
            {
                $qiniu= $brand->upload();
                $data['Brand']['brandimg'] =$qiniu['brandimg'];
                $qiniuControl=$qiniu['qiniu'];
                $qiniuControl->delete(basename($brand->brandimg));
            }
            else
            {
                $data['Brand']['brandimg']=$brand->brandimg;
            }

            if($brand->mod($data))
            {
                Yii::$app->session->setFlash('info','品牌更新成功');
            }
            else
            {
                Yii::$app->session->setFlash('info','品牌更新失败');
            }
        }
        return $this->render('mod',compact('brand'));
    }
    public function actionDel()
    {
        $brandId=Yii::$app->request->get('brandid');
        $brand=Brand::find()->where('id=:id',['id'=>$brandId])->one();
        $cover=$brand->brandimg;
        $brand->delete();
        $param=Yii::$app->params['qiniu'];
        $qiniu =new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
        $qiniu->delete(basename($cover));
        $this->redirect(['brand/brands']);
    }
}