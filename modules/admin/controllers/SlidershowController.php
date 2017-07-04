<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/3/17
 * Time: 11:16 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\Slidershow;
use app\models\SlidershowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;

/**
 * SlidershowController implements the CRUD actions for Slidershow model.
 */
class SlidershowController extends AdminBaseController
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
     * Lists all Slidershow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SlidershowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Slidershow model.
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
     * Creates a new Slidershow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Slidershow();

        if ($model->load(Yii::$app->request->post()) ) {
            $uploadedFile = UploadedFile::getInstance($model, 'image');
            $rnd = rand(0,9999);
            $fileName = "{$rnd}-{$uploadedFile}";
            $folderProcedure                = \Yii::getAlias('@RealDirectory').'/web/uploads/slidershow/';
            if(!is_dir($folderProcedure)){
                mkdir($folderProcedure, 0777);
            }
            $model->image       = $fileName;
            $model->created     = date('Y-m-d H:i:s');
            $model->updated     = date('Y-m-d H:i:s');
            $totalSlider        = Slidershow::find()->where(' 1 ')->count();
            $model->rank        = $totalSlider + 1;
            if ( $model->save() ){
                 if ($model->image && $model->validate()) {
                    $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/slidershow/' .$fileName);
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
     * Updates an existing Slidershow model.
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
            $model->updated  = date('Y-m-d H:i:s');
            if ($model->save()){
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/slidershow/' .$fileName);
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
     * Deletes an existing Slidershow model.
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
     * Finds the Slidershow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Slidershow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Slidershow::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUp(){
        $id         = intval($_GET['id']);
        $upRank     = Slidershow::findOne($id);
        $up         = $upRank->rank -1;
        $downRank   = Slidershow::find()->where('rank ='.$up)->one();
        if($upRank->rank !=1){
            $downRank->rank = $upRank->rank;
            $upRank->rank   = $upRank->rank - 1;
            $upRank->save();
            $downRank->save();
        }
        $searchModel = new SlidershowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionDown(){
        $id                         = intval($_GET['id']);
        $downRank                   = Slidershow::findOne($id);
        $allRankTopic               = Slidershow::find()->where(' 1 ')->count();
        $down                       = $downRank->rank +1;
        if($downRank->rank < $allRankTopic) {
            $upRank                 = Slidershow::find()->where('rank ='.$down)->one();
            $upRank->rank           =  $downRank->rank;
            $downRank->rank         =  $downRank->rank + 1;
            $downRank->save();
            $upRank->save();
        }

        $searchModel = new SlidershowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
}
