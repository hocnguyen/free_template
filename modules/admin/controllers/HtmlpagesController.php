<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/11/17
 * Time: 11:39 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use app\models\HtmlPages;
use app\models\HtmlPagesSearch;
use yii\web\Controller;
use app\modules\admin\components\AdminBaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HtmlpagesController implements the CRUD actions for HtmlPages model.
 */
class HtmlpagesController extends AdminBaseController
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
     * Lists all HtmlPages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HtmlPagesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HtmlPages model.
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
     * Creates a new HtmlPages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HtmlPages();

        if ($model->load(Yii::$app->request->post())) {
            $model->created     = date('Y-m-d H:i:s');
            $model->updated     = date('Y-m-d H:i:s');
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HtmlPages model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
             $model->updated     = date('Y-m-d H:i:s');
            if ($model->save())
                return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HtmlPages model.
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
     * Finds the HtmlPages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HtmlPages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HtmlPages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
