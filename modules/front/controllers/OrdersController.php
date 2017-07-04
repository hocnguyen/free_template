<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 4/5/17
 * Time: 10:16 PM
 */
namespace app\modules\front\controllers;

use Yii;
use app\models\Orders;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\front\components\FrontBaseController;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends FrontBaseController
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
     * Lists all Orders models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to my orders');
            $this->redirect(['/login']);
        }

        $searchModel = new OrdersSearch();
        $queryParams = array_merge(array(),Yii::$app->request->getQueryParams());
        $queryParams["OrdersSearch"]["user_id"] = intval(Yii::$app->user->id);
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to my orders');
            $this->redirect(['/login']);
        }
        
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::find()->where('id =:id AND user_id =:user_id', [':id' => $id, ':user_id' => intval(Yii::$app->user->id)])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
