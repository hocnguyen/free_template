<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:20 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\Posts;
use app\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;
use app\models\PostCate;
use app\models\TagsPost;
use app\models\PostTag;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends AdminBaseController
{
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

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Posts();

        if ($model->load(Yii::$app->request->post())) {
            $folderPost                 = \Yii::getAlias('@RealDirectory').'/web/uploads/posts';
            if (!is_dir($folderPost)) {
                mkdir($folderPost, 0777);
            }

            $rnd                            = rand(0,9999);
            $link_images                    = 'uploads/posts/'.date("Ymd").'/';

            $folderDetailPosts              = $folderPost.'/'.date("Ymd");
            if(!is_dir($folderDetailPosts)){
                mkdir($folderDetailPosts, 0777);
            }
            $uploadedFileCover              = UploadedFile::getInstance($model, 'image');
            $fileNameCover                  = "{$rnd}-{$uploadedFileCover}";
            $model->image                   = $link_images.$fileNameCover;
           
            $model->user_id                 = \Yii::$app->user->id;
            $model->created                 = date('Y-m-d H:i:s');
            $model->updated                 = date('Y-m-d H:i:s');
            if ($model->save()) {

                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFileCover)){
                        $uploadedFileCover->saveAs(Yii::$app->basePath.'/web/'.$link_images.$fileNameCover);
                    }
                }

                $cats = isset($_POST['Posts']['category'])?$_POST['Posts']['category']:[];
                if( $cats ){
                    foreach ($cats as $cat_id){
                        $cat                = new PostCate();
                        $cat->post_id       = $model->id;
                        $cat->cate_post_id  = $cat_id;
                        if( $cat->save() )
                            \Yii::$app->session->setFlash('SuccessAddCategories','Add categories success!');
                        else{
                            print_r($cat->getErrors());
                            exit;
                        }
                    }  
                }

                $tags = isset($_POST['Posts']['tags'])?$_POST['Posts']['tags']:[];
                if( count($tags) > 0 ){
                    foreach ($tags as $tag){
                        $check                              = TagsPost::find()->where('id =:id',[':id'=>$tag])->one();
                        if ($check) {
                            $check->total                   += 1;
                            $check->updated                 = date('Y-m-d H:i:s');
                            if ($check->save()) {
                                $postTags                   = new PostTag();
                                $postTags->post_id          = $model->id;
                                $postTags->tag_post_id      = $check->id;
                                $postTags->created          = date('Y-m-d H:i:s');
                                $postTags->updated          = date('Y-m-d H:i:s');
                                $postTags->save();
                            }
                            else{
                                print_r($check->getErrors());
                                exit;
                            }
                        }
                        else {
                            $model_tag                    = new TagsPost();            
                            $model_tag->name              = $tag;
                            $model_tag->slug              = \Yii::$app->func->makeAlias($tag);
                            $model_tag->total             = 1;
                            $model_tag->created           = date('Y-m-d H:i:s');
                            $model_tag->updated           = date('Y-m-d H:i:s');
                            if ($model_tag->save()){
                                $postTags                 = new PostTag();
                                $postTags->post_id        = $model->id;
                                $postTags->tag_post_id    = $model_tag->id;
                                $postTags->created        = date('Y-m-d H:i:s');
                                $postTags->updated        = date('Y-m-d H:i:s');
                                $postTags->save();
                            }
                            else{
                                print_r($model_tag->getErrors());
                                exit;
                            }
                        }
                        
                    } 
                }   

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                return $this->render('create', [
                'model' => $model,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $image          = $model->image;

        if ($model->load(Yii::$app->request->post())) {
            $rnd                            = rand(0,9999);
            $folderPost                 = \Yii::getAlias('@RealDirectory').'/web/uploads/posts/'.date("Ymd").'/';
            if (!is_dir($folderPost)) {
                mkdir($folderPost, 0777);
            }
            $link_images                    = 'uploads/posts/'.date("Ymd").'/';
            $uploadedFile                   = UploadedFile::getInstance($model, 'image');
            if(!empty($uploadedFile)) {
                $fileName           = "{$rnd}-{$uploadedFile}";
                $model->image       = $link_images.$fileName;
            }
            else{
                $model->image       = $image;
            }

            $model->user_id         = \Yii::$app->user->id;
            $model->updated         = date('Y-m-d H:i:s');
            if ($model->save()){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/'.$link_images.$fileName);
                    }
                }

                PostCate::deleteAll(
                "post_id = :post_id",
                array(':post_id' => $model->id)
                );
                $cats = isset($_POST['Posts']['category'])?$_POST['Posts']['category']:[];
                if( $cats ){
                    foreach ($cats as $cat_id){
                        $cat                = new PostCate();
                        $cat->post_id       = $model->id;
                        $cat->cate_post_id  = $cat_id;
                        if( $cat->save() )
                            \Yii::$app->session->setFlash('SuccessAddCategories','Add categories success!');
                        else{
                            print_r($cat->getErrors());
                            exit;
                        }
                    }  
                }

                PostTag::deleteAll(
                "post_id = :post_id",
                array(':post_id' => $model->id)
                );

                $tags = isset($_POST['Posts']['tags'])?$_POST['Posts']['tags']:[];

                if( count($tags) > 0 ){
                    foreach ($tags as $tag){
                        $check                              = TagsPost::find()->where('id =:id',[':id'=>$tag])->one();
                        if ($check) {
                            $check->updated                 = date('Y-m-d H:i:s');
                            if ($check->save()) {
                                $postTags                   = new PostTag();
                                $postTags->post_id          = $model->id;
                                $postTags->tag_post_id      = $check->id;
                                $postTags->created          = date('Y-m-d H:i:s');
                                $postTags->updated          = date('Y-m-d H:i:s');
                                $postTags->save();
                            }
                            else{
                                print_r($check->getErrors());
                                exit;
                            }
                        }
                        else {
                            $model_tag                    = new TagsPost();            
                            $model_tag->name              = $tag;
                            $model_tag->slug              = \Yii::$app->func->makeAlias($tag);
                            $model_tag->total             = 1;
                            $model_tag->created           = date('Y-m-d H:i:s');
                            $model_tag->updated           = date('Y-m-d H:i:s');
                            if ($model_tag->save()){
                                $postTags                 = new PostTag();
                                $postTags->post_id        = $model->id;
                                $postTags->tag_post_id    = $model_tag->id;
                                $postTags->created        = date('Y-m-d H:i:s');
                                $postTags->updated        = date('Y-m-d H:i:s');
                                $postTags->save();
                            }
                            else{
                                print_r($model_tag->getErrors());
                                exit;
                            }
                        }
                        
                    } 
                }   

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
