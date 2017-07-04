<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\modules\front\controllers;

use Yii;
use app\models\ProductReviews;
use app\models\ProductReviewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\front\components\FrontBaseController;

/**
 * ProductReviewsController implements the CRUD actions for ProductReviews model.
 */
class FeedbackController extends FrontBaseController
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
     * Lists all ProductReviews models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to Product feedback');
            $this->redirect(['/login']);
        }
        $searchModel = new ProductReviewsSearch();
        $queryParams = array_merge(array(),Yii::$app->request->getQueryParams());
        $queryParams["ProductReviewsSearch"]["member_id"] = intval(Yii::$app->user->id);
        $dataProvider = $searchModel->search($queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductReviews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to Product feedback');
            $this->redirect(['/login']);
        }

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductReviews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to Product feedback');
            $this->redirect(['/login']);
        }

        $model = new ProductReviews();

        if ($model->load(Yii::$app->request->post())) {

            $lists          = Yii::$app->func->listProductIdByCustomer(Yii::$app->user->id);
            $products_id    = count($lists) > 0 ?$lists:[];
            $product_id     = $_POST['ProductReviews']['product_id'];
            if ( in_array($product_id, $products_id) ) {
                $model->member_id   = intval(Yii::$app->user->id);
                $model->is_display  = Yii::$app->params['status_active'];
                $model->created     = date('Y-m-d H:i:s');
                $model->updated     = date('Y-m-d H:i:s');
                if ($model->save())
                    return $this->redirect(['view', 'id' => $model->id]);
            } else {
                \Yii::$app->session->setFlash('error', 'You do not permission for feedback in this product!');
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
     * Finds the ProductReviews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductReviews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to Product feedback');
            $this->redirect(['/login']);
        }

        if (($model = ProductReviews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
