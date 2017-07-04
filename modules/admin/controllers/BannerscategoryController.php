<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\BannersCategory;
use app\models\BannersCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;

/**
 * BannerscategoryController implements the CRUD actions for BannersCategory model.
 */
class BannerscategoryController extends AdminBaseController
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
     * Lists all BannersCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannersCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BannersCategory model.
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
     * Creates a new BannersCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BannersCategory();

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile       = UploadedFile::getInstance($model, 'image');
            $rnd                = rand(0,9999);
            $fileName           = "{$rnd}-{$uploadedFile}";
            $folder             = \Yii::getAlias('@RealDirectory').'/web/uploads/advertising/';
            if(!is_dir($folder)){
                mkdir($folder, 0777);
            }

            if (!empty($uploadedFile)) {
                $model->image   = $fileName;
            }

            $model->created  = date('Y-m-d H:i:s');
            $model->updated  = date('Y-m-d H:i:s');
            if ($model->save()){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/advertising/' .$fileName);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            } else {

            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BannersCategory model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp  = $model->image;

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
            $model->updated         = date('Y-m-d H:i:s');
            if ($model->save()) {
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/advertising/' .$fileName);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing BannersCategory model.
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
     * Finds the BannersCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BannersCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BannersCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxupdate(){
        $id                     = intval( $_GET['id'] );
        $slider                 = BannersCategory::findOne($id);
        $sta                    = ($slider->is_active == BannersCategory::STATUS_ACTIVE)?0:BannersCategory::STATUS_ACTIVE;
        $slider->is_active      = $sta;
        $slider->save();
    }

}
