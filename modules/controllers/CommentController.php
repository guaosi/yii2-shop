<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/22/0022
 * Time: 11:40
 */
namespace app\modules\controllers;
use app\models\Brand;
use app\models\Comment;
use crazyfd\qiniu\Qiniu;
use Yii;
class CommentController extends CommonController
{
    protected $ismustLogin=['comments','del'];

    public function actionComments()
    {

        $this->layout='layout1';
        $comment=new Comment();
        $tempData=$comment->processPageComments();
        $comments=$tempData['comments'];
        $pager=$tempData['pager'];
        return $this->render('comments',compact('comments','pager'));
    }
    public function actionDel()
    {
        $commentid=Yii::$app->request->get('id');
        $comment=Comment::find()->where('id=:id',['id'=>$commentid])->one();
        if (!$comment)
        {
            return false;
        }
        $comment->delete();
        $this->redirect(['comment/comments']);
    }
}