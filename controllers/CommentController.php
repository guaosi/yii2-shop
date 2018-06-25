<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/24/0024
 * Time: 21:48
 */
namespace app\controllers;
use app\models\Address;
use app\models\Comment;
use Yii;
class CommentController extends CommonController
{
    protected $ismustLogin=['add'];
    protected $except=['comments'];

    public function actionAdd()
    {

        if (Yii::$app->request->isPost)
        {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $post=Yii::$app->request->post();
            $comment=new Comment();
            $data['Comment']=[];
            $data['Comment']['content']=htmlspecialchars($post['content_one_comment']);
            $data['Comment']['product_id']=$post['productid'];
            $data['Comment']['score']=$post['score'];
            $data['Comment']['user_id']= Yii::$app->user->id;

            if (!$comment->checkCanComment($post['productid'])){
                return [
                    'errorCode'=>0,
                    'msg'=>'您没有权限进行评论'
                ];
            }

            if($comment->add($data))
            {
                return [
                    'errorCode'=>1,
                    'msg'=>'评论发表成功'
                ];
            }
            else
            {
                $error_arr=$comment->getErrors();
                $error_num=count($error_arr);
                $error_string='';
                if ($error_num==2)
                {
                  $error_string=$error_arr['score'][0].','.$error_arr['content'][0];
                }
                else
                {
                    if (array_key_exists('score',$error_arr))
                    {
                        $error_string=$error_arr['score'][0];
                    }else{
                        $error_string=$error_arr['content'][0];
                    }
                }
                return [
                    'errorCode'=>0,
                    'msg'=>$error_string,
                ];
            }

        }

    }
    public function actionComments($productid=false){
        $comment=new Comment();
        $tempData=$comment->processPageComments($productid,true);
        $comments['pageData']=$tempData['pageData'];
        $comments['data']=$tempData['data'];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        foreach ($comments['data'] as &$val)
        {
            $val['createtime']=date('Y-m-d',$val['createtime']);
        }
        return $comments;


    }
}