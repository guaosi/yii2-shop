<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/22/0022
 * Time: 11:40
 */
namespace app\modules\controllers;
use app\models\Brand;
use app\models\Category;
use app\models\Product;
use crazyfd\qiniu\Qiniu;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;
class ProductController extends CommonController
{
    protected $ismustLogin=['products','add','upload','mod','removepic','del','change'];

    public function actionProducts()
    {

       $this->layout='layout1';
       $product=Product::find();
       $count=$product->count();
       $pagesize=Yii::$app->params['pageSize']['productSize'];
       $pager=new Pagination(['totalCount'=>$count,'pageSize'=>$pagesize]);
       $products=$product->offset($pager->offset)->limit($pager->limit)->all();
       return $this->render('products',compact('products','pager'));
    }
    public function actionAdd()
    {
        $this->layout='layout1';
        $product=new Product();
        $category=new Category();
        $list=$category->makeOptions();
        $brand_list=(new Brand())->makeOptions();
        unset($list[0]);
        unset($brand_list[0]);
        if(Yii::$app->request->isPost)
        {
            $upload=$this->upload();
          if($upload)
          {
              $data=Yii::$app->request->post();
              $data['Product']['saleprice']=$data['Product']['saleprice']?$data['Product']['saleprice']:0.01;
              $data['Product']['descr']=htmlspecialchars($data['Product']['descr']);
              $data['Product']['cover']=$upload['cover'];
              $data['Product']['pics']=$upload['pics'];
              if($product->add($data))
              {
                Yii::$app->session->setFlash('info','商品添加成功');
              }
              else
              {
                  Yii::$app->session->setFlash('info','商品添加失败');
              }
          }
          else
          {
            $product->addError('cover','封面图片必须上传');
          }
        }
        else
        {
            $product->ishot=0;
            $product->istui=0;
            $product->issale=0;
            $product->ison=0;
        }

        return $this->render('add',compact('product','list','brand_list'));
    }
    public function upload()
    {
        if($_FILES['Product']['error']['cover']>0)
        {
            return false;
        }
        $param=Yii::$app->params['qiniu'];
        $qiniu =new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
        $key = uniqid();
        $qiniu->uploadFile($_FILES['Product']['tmp_name']["cover"],$key);
        $cover = $qiniu->getLink($key);
        $pics=[];

            foreach ($_FILES['Product']['tmp_name']["pics"] as $key => $val)
            {
                if($_FILES['Product']['error']['pics'][$key]==0)
                {
                    $qiniu = new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
                    $key = uniqid();
                    $qiniu->uploadFile($val,$key);
                    $pic = $qiniu->getLink($key);
                    $pics[]=$pic;
                }
            }

        return [
            'cover'=>$cover,
            'pics'=>json_encode($pics)
        ];
    }
    public function actionMod()
    {
        $this->layout='layout1';
        $productid=Yii::$app->request->get('productid');
        $product=Product::find()->where('productid=:id',['id'=>$productid])->one();

        $category=new Category();
        $list=$category->makeOptions();
        $brand_list=(new Brand())->makeOptions();
        unset($list[0]);
        unset($brand_list[0]);
        if(Yii::$app->request->isPost)
        {
            $data=Yii::$app->request->post();
            $param=Yii::$app->params['qiniu'];
            if($_FILES['Product']['error']['cover']==0)
            {
                $qiniu =new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Product']['tmp_name']["cover"],$key);
                $data['Product']['cover'] = $qiniu->getLink($key);
                $qiniu->delete(basename($product->cover));
            }
            else
            {
                $data['Product']['cover']=$product->cover;
            }
            $pics=[];
                foreach ($_FILES['Product']['tmp_name']["pics"] as $key => $val)
                {
                    if($_FILES['Product']['error']['pics'][$key]==0)
                    {
                        $qiniu = new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
                        $key = uniqid();
                        $qiniu->uploadFile($val,$key);
                        $pic = $qiniu->getLink($key);
                        $pics[]=$pic;
                    }
                }
                if($product->pics)
                {
                    $data['Product']['pics']=json_encode(array_merge(json_decode($product->pics,true),$pics));
                }
                else
                {
                    $data['Product']['pics']=json_encode($pics);
                }
            $data['Product']['descr']=htmlspecialchars($data['Product']['descr']);

            if($product->mod($data))
            {
               Yii::$app->session->setFlash('info','商品更新成功');
            }
            else
            {
                Yii::$app->session->setFlash('info','商品更新失败');
            }
        }
        return $this->render('mod',compact('product','list','brand_list'));
    }
    public function actionRemovepic()
    {
        $productId=Yii::$app->request->get('product');
        $key=Yii::$app->request->get('key');
        $product=Product::find()->where('productid=:id',[':id'=>$productId])->one();
        $pics=json_decode($product->pics,true);
        $param=Yii::$app->params['qiniu'];
        $qiniu =new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
        $qiniu->delete(basename($pics[$key]));
        unset($pics[$key]);
        Product::updateAll(["pics"=>json_encode($pics)],'productid=:id',['id'=>$productId]);
        $this->redirect(['product/mod','productid'=>$productId]);
    }
    public function actionDel()
    {
        $productId=Yii::$app->request->get('productid');
        $product=Product::find()->where('productid=:id',['id'=>$productId])->one();
        $cover=$product->cover;
        $pics=json_decode($product->pics);
        $param=Yii::$app->params['qiniu'];
        $qiniu =new Qiniu($param['AK'], $param['SK'],$param['DOMAIN'], $param['BUCKET']);
        $qiniu->delete(basename($cover));
        if($pics)
        {
            foreach ($pics as $pic)
            {
                $qiniu->delete(basename($pic));
            }
        }
        Product::deleteAll('productid=:id',['id'=>$productId]);
        Yii::$app->session->setFlash('info','删除成功');
//        删除索引
        $url="http://119.23.20.140:9200/shopyii/products/$productId";
        $res=callInterfaceCommon($url,null,'DELETE');

        $this->redirect(['product/products']);
    }
    public function actionChange()
    {
        $productId=Yii::$app->request->get('productid');
        $action=Yii::$app->request->get('action');
        if($action==0||$action==1)
        {
            Product::updateAll(['ison'=>$action],'productid=:id',['id'=>$productId]);
        }
        $this->redirect(['product/products']);
    }
}