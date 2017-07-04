<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\Categories;
use app\models\CategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;

/**
 * CategoriesController implements the CRUD actions for Categories model.
 */
class CategoriesController extends AdminBaseController
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
     * Lists all Categories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categories model.
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
     * Creates a new Categories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categories();

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile       = UploadedFile::getInstance($model, 'image');
            $rnd                = rand(0,9999);
            $fileName           = "{$rnd}-{$uploadedFile}";

            $uploadedFileHot    = UploadedFile::getInstance($model, 'image_hot');
            $fileNameHot        = "{$rnd}-{$uploadedFileHot}";

            $folderProcedure                = \Yii::getAlias('@RealDirectory').'/web/uploads/categories/';
            if(!is_dir($folderProcedure)){
                mkdir($folderProcedure, 0777);
            }
            $totalCategory      = Categories::find()->where(' 1 ')->count();
            $model->is_order    = $totalCategory + 1;
            if (!empty($uploadedFile)) {
                $model->image   = $fileName;
            }

            if (!empty($uploadedFileHot)) {
                $model->image_hot   = $fileNameHot;
            }

            $model->parent_id   = intval($_POST['Categories']['parent_id']);
            $model->created     = date('Y-m-d H:i:s');
            $model->updated     = date('Y-m-d H:i:s');
            if($model->save() ){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/categories/' .$fileName);
                    }
                }

                if ($model->image_hot && $model->validate()) {
                    if(!empty($uploadedFileHot)){
                        $uploadedFileHot->saveAs(Yii::$app->basePath.'/web/uploads/categories/' .$fileNameHot);
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
     * Updates an existing Categories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp  = $model->image;
        $temph = $model->image_hot;
        $folderProcedure                = \Yii::getAlias('@RealDirectory').'/web/uploads/categories/';
        if(!is_dir($folderProcedure)){
            mkdir($folderProcedure, 0777);
        }
        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'image');
            if(!empty($uploadedFile)) {
                $rnd                = rand(0,9999);
                $fileName           = "{$rnd}-{$uploadedFile}";
                $model->image       = $fileName;
            }
            else{
                $model->image       = $temp;
            }

            $uploadedFileHot = UploadedFile::getInstance($model, 'image_hot');
            if(!empty($uploadedFileHot)) {
                $rnd                = rand(0,9999);
                $fileNameHot        = "{$rnd}-{$uploadedFileHot}";
                $model->image_hot   = $fileNameHot;
            }
            else{
                $model->image_hot   = $temph;
            }

            $model->parent_id       = intval($_POST['Categories']['parent_id']);
            $model->updated         = date('Y-m-d H:i:s');
            if( $model->save() ){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/categories/' .$fileName);
                    }
                }

                if ($model->image_hot && $model->validate()) {
                    if(!empty($uploadedFileHot)){
                        $uploadedFileHot->saveAs(Yii::$app->basePath.'/web/uploads/categories/' .$fileNameHot);
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
     * Deletes an existing Categories model.
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
     * Finds the Categories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Categories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUp(){
        error_reporting(0);
        $id         = intval($_GET['id']);
        $upRank     = Categories::findOne($id);
        $up         = $upRank->is_order -1;
        $downRank   = Categories::find()->where('is_order ='.$up)->one();
        if($upRank->is_order !=1){
            $downRank->is_order = $upRank->is_order;
            $upRank->is_order   = $upRank->is_order - 1;
            $upRank->save();
            $downRank->save();
        }

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDown(){
        error_reporting(0);
        $id                         = intval($_GET['id']);
        $downRank                   = Categories::findOne($id);
        $allRankTopic               = Categories::find()->where(' 1 ')->count();
        $down                       = $downRank->is_order +1;
        if($downRank->is_order < $allRankTopic) {
            $upRank                 = Categories::find()->where('is_order ='.$down)->one();
            $upRank->is_order       =  $downRank->is_order;
            $downRank->is_order     =  $downRank->is_order + 1;
            $downRank->save();
            $upRank->save();
        }

        $searchModel = new CategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
