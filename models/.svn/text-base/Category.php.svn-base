<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/21/0021
 * Time: 15:10
 */
namespace app\models;
use yii\data\Pagination;
use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use Yii;
class Category extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class'=>BlameableBehavior::className(),
                'createdByAttribute'=>'adminid',
                'updatedByAttribute'=>null,
                'value'=>Yii::$app->admin->id
            ]
        ];
    }
    public function attributeLabels()
    {
        return [
            'title'=>'分类名称',
            'parentid'=>'上级分类',
        ];
    }

    public static function tableName()
    {
        return "{{%category}}";
    }
    public function rules(){
        return [
            ['cateid','required','message'=>'分类id不能为空','on'=>['rename']],
            ['title','required','message'=>'分类名称必须填写','on'=>['add','rename']],
            ['parentid','required','message'=>'父级ID不能为空','on'=>['add','change']],
            ['parentid','number','message'=>'ID必须是数字','on'=>['add','change']],
            [['createtime','adminid'], 'safe']

        ];
    }
    public function cateadd($data)
    {
      $this->scenario='add' ;
      $this->load($data);
      if($this->validate())
      {
          $this->createtime=time();
          if($this->save(false))
          {
              return true;
          }
      }
      return false;
    }
    public function getData()
    {
        $categorys=self::find()->asArray()->all();
        return $this->getTree($categorys);
    }
    public function getTree($datas,$pid=0,$level=0)
    {
        static $treeData = [];
        foreach ($datas as $data)
        {
            if($data['parentid']==$pid)
            {
                $data['level']=$level;
                $treeData[]=$data;
                $this->getTree($datas,$data['cateid'],$level+1);
            }
        }
        return $treeData;
    }
    public function makeOptions()
    {
        $treeData=$this->getData();
        $options=[];
        $options[0]='添加顶级分类';
        foreach ($treeData as $data)
        {
           $options[$data['cateid']]=str_repeat('|-----',$data['level']).$data['title'];
        }
        return $options;
    }
    public function mod($data)
    {
      $this->scenario='add';
      $this->load($data);
      if($this->validate())
      {
          if($this->save()!==false)
          {
              return true;
          }
      }
      return false;
    }
    public function getChildren($cateid)
    {
        $categorys=self::find()->asArray()->all();
        return $this->_getChildren($categorys,$cateid);
    }
    public function _getChildren($datas,$pid)
    {
      static $cateIds=[];
        foreach ($datas as $data)
        {
            if($data['parentid']==$pid)
            {
                $cateIds[]=(int)$data['cateid'];
                $this->_getChildren($datas,$data['cateid']);
            }
        }
        return $cateIds;
    }
    public static function getCategorys()
    {
        $allCategorys=self::find()->asArray()->all();
        $firstCategorys=self::find()->where('parentid=0')->asArray()->all();

        foreach ($firstCategorys as $key=>&$val)
        {
            foreach ($allCategorys as $key1=>&$category)
            {
                if($val['cateid']==$category['parentid'])
                {
//                    foreach ($allCategorys as $key2=>$val2)
//                    {
//                        if($val2['parentid']==$category['cateid'])
//                        {
//                            $category['children'][]=$val2;
//                        }
//                    }
                    $val['children'][]=$category;
                }
            }
        }
        return $firstCategorys;
    }
    public function getJsTree(){
       $pcategory=self::find()->where('parentid=:pid',['pid'=>0]);
       $pager=new Pagination(['totalCount'=>$pcategory->count(),'pageSize'=>8]);
       $data=$pcategory->offset($pager->offset)->limit($pager->limit)->orderBy('createtime desc')->all();

       if(empty($data))
       {
           return [];
       }
       else
       {
           $primarydata=[];
           foreach ($data as $cates)
           {
               $primarydata[]=[
                    'id'=>$cates->cateid,
                   'text'=>$cates->title,
                   'children'=>$this->getChildrenTree($cates->cateid)
               ];
           }

           return [
                 'data'=>$primarydata,'pager'=>$pager
           ];
       }
    }
    public function getChildrenTree($pid)
    {
       $data=self::find()->where('parentid=:pid',['pid'=>$pid])->all();
       if(empty($data))
       {
           return [];
       }
       else
       {
           $children=[];
           foreach ($data as $cates)
           {
               $children[]=[
                   'id'=>$cates->cateid,
                   'text'=>$cates->title,
                   'children'=>$this->getChildrenTree($cates->cateid)
               ];
           }
           return $children;
       }
    }

}