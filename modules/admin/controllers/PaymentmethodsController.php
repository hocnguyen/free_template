<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\PaymentMethods;
use app\models\PaymentMethodsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;
use yii\web\UploadedFile;

/**
 * PaymentMethodsController implements the CRUD actions for PaymentMethods model.
 */
class PaymentmethodsController extends AdminBaseController
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
     * Lists all PaymentMethods models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaymentMethodsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PaymentMethods model.
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
     * Creates a new PaymentMethods model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PaymentMethods();

        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile       = UploadedFile::getInstance($model, 'image');
            $rnd                = rand(0,9999);
            $fileName           = "{$rnd}-{$uploadedFile}";

            $folderPaymentMethod  = \Yii::getAlias('@RealDirectory').'/web/uploads/payment-method/';
            if(!is_dir($folderPaymentMethod)){
                mkdir($folderPaymentMethod, 0777);
            }
            if (!empty($uploadedFile)) {
                $model->image   = $fileName;
            }

            $model->created  = date('Y-m-d H:i:s');
            $model->updated  = date('Y-m-d H:i:s');
            if ($model->save()) {
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/payment-method/' .$fileName);
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
     * Updates an existing PaymentMethods model.
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
            if($model->save()) {
                if ($model->image && $model->validate()) {
                    if(!empty($uploadedFile)){
                        $uploadedFile->saveAs(Yii::$app->basePath.'/web/uploads/payment-method/' .$fileName);
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
     * Deletes an existing PaymentMethods model.
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
     * Finds the PaymentMethods model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentMethods the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentMethods::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
