<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/17/17
 * Time: 8:16 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\Banners;
use app\models\BannersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;

/**
 * BannersController implements the CRUD actions for Banners model.
 */
class BannersController extends AdminBaseController
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
     * Lists all Banners models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BannersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banners model.
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
     * Creates a new Banners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banners();

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'filename');
            $rnd = rand(0,9999);
            $fileName = "{$rnd}-{$uploadedFile}";
            $folderProcedure                = \Yii::getAlias('@RealDirectory').'/web/uploads/banners/';
            if(!is_dir($folderProcedure)){
                mkdir($folderProcedure, 0777);
            }
            $model->filename = $fileName;
            $totalBanners    = Banners::find()->where(' 1 ')->count();
            $model->is_order = $totalBanners + 1;
            $model->created  = date('Y-m-d H:i:s');
            $model->updated  = date('Y-m-d H:i:s');
            if ($model->save()) {
                if ($model->filename && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/banners/' .$fileName);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }   
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Banners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $temp  = $model->filename;

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'filename');
            if(!empty($uploadedFile)) {
                $rnd                = rand(0,9999);
                $fileName           = "{$rnd}-{$uploadedFile}";
                $model->filename    = $fileName;
            }
            else{
                $model->filename    = $temp;
            }
            $model->updated         = date('Y-m-d H:i:s');
            if ($model->save()) {
                if ($model->filename && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/banners/' .$fileName);
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
     * Deletes an existing Banners model.
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
     * Finds the Banners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionAjaxupdate(){
        $id                     = intval( $_GET['id'] );
        $slider                 = Banners::findOne($id);
        $sta                    = ($slider->is_active == Banners::STATUS_ACTIVE)?0:Banners::STATUS_ACTIVE;
        $slider->is_active      = $sta;
        $slider->save();
    }

    public function actionUp(){
        $id         = intval($_GET['id']);
        $upRank     = Banners::findOne($id);
        $up         = $upRank->is_order -1;
        $downRank   = Banners::find()->where('is_order ='.$up)->one();
        if($upRank->is_order !=1){
            $downRank->is_order = $upRank->is_order;
            $upRank->is_order   = $upRank->is_order - 1;
            $upRank->save();
            $downRank->save();
        }

        $searchModel = new BannersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDown(){
        $id                         = intval($_GET['id']);
        $downRank                   = Banners::findOne($id);
        $allRankTopic               = Banners::find()->where(' 1 ')->count();
        $down                       = $downRank->is_order +1;
        if($downRank->is_order < $allRankTopic) {
            $upRank                 = Banners::find()->where('is_order ='.$down)->one();
            $upRank->is_order       =  $downRank->is_order;
            $downRank->is_order     =  $downRank->is_order + 1;
            $downRank->save();
            $upRank->save();
        }

        $searchModel = new BannersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
}
