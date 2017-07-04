<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/23/17
 * Time: 11:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\models\CategoryPost;
use app\models\Posts;
use app\models\TagsPost;

class BlogController extends FrontBaseController{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
          
        ];
    }

    public function actionIndex()
    {
        
        $page_size  = 5;
        $posts = new ActiveDataProvider(
            [
                'query' => Posts::find()->where('is_status =:is_status ORDER BY `id` DESC', [':is_status'=>Yii::$app->params['status_active']]),
                'pagination' => [
                        'pageSize' => $page_size,
                ],
            ]);

        return $this->render('index',[
            'posts'         => $posts
        ]);
    }

     /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetail($id)
    {
        $data       = $this->findModel(intval($id));
        $posts      = new ActiveDataProvider(
            [
                'query' => Posts::find()->where('is_status =:is_status ORDER BY `id` DESC LIMIT 10', [':is_status'=>Yii::$app->params['status_active']]),
                'pagination' => false,
            ]);

        $list_cate      = Yii::$app->func->getPostRelateByCategories(intval($id));
        $relate_post    = Posts::find()->where('(id != '.intval($id).' AND id IN ('.$list_cate.') AND is_status =:is_status) ORDER BY `id` DESC', [':is_status'=>Yii::$app->params['status_active']])->all();

        return $this->render('detail',[
            'data'          => $data,
            'posts'         => $posts,
            'relate_post'   => $relate_post
        ]);
    }

    public function actionCate($alias) 
    {
        $page_size  = 5;
        $category   = CategoryPost::findOne(intval($alias));
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM posts
                              INNER JOIN post_cate
                              ON posts.`id` = post_cate.`post_id`
                              INNER JOIN category_post
                              ON post_cate.`cate_post_id` = category_post.`id`
                              WHERE category_post.`id` = '.intval($alias) )->queryScalar();
        $posts   = new SqlDataProvider([
                    'sql' => 'SELECT posts.* FROM posts
                              INNER JOIN post_cate
                              ON posts.`id` = post_cate.`post_id`
                              INNER JOIN category_post
                              ON post_cate.`cate_post_id` = category_post.`id`
                              WHERE category_post.`id` = '.intval($alias).' ORDER BY posts.id DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]); 
        return $this->render('cate',[
            'category'  => $category,
            'posts'     => $posts
        ]);
    }

    public function actionTag($alias)
    {
        $page_size  = 5;
        $tag        = TagsPost::findOne(intval($alias));
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM posts
                              INNER JOIN post_tag
                              ON posts.`id` = post_tag.`post_id`
                              INNER JOIN tags_post
                              ON post_tag.`tag_post_id` = tags_post.`id`
                              WHERE tags_post.`id` = '.intval($alias) )->queryScalar();
        $posts   = new SqlDataProvider([
                    'sql' => 'SELECT posts.* FROM posts
                              INNER JOIN post_tag
                              ON posts.`id` = post_tag.`post_id`
                              INNER JOIN tags_post
                              ON post_tag.`tag_post_id` = tags_post.`id`
                              WHERE tags_post.`id` = '.intval($alias).' ORDER BY posts.id DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]); 
        return $this->render('tag', [
            'tag'       => $tag,
            'posts'     => $posts
            ]);
    }
}