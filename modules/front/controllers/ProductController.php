<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/9/17
 * Time: 12:52 AM
 */
namespace app\modules\front\controllers;
use Yii;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\Products;
use app\models\ProductsSearch;
use app\models\ProductReviews;
use yii\data\SqlDataProvider;

class ProductController extends FrontBaseController{

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

      /**
     * Finds the ProducerVideo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProducerVideo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDetail($id)
    {
        $data       = $this->findModel(intval($id));
        $data_img   = \app\models\ProductPics::getAllImgModelById(intval($id)); 

        $feedback   = ProductReviews::find()->where('product_id =:product_id ORDER BY id DESC',[':product_id'=>intval($id)])->all();

        $products           = Yii::$app->func->getRelateProducts(intval($id));
        $likedproducts      = Yii::$app->func->getAlsoLikeProducts(intval($id));
        return $this->render('detail',[
            'data'          => $data,
            'data_img'      => $data_img,
            'products'      => $products,
            'likedproducts' => $likedproducts,
            'feedback'      => $feedback
        ]);
    }

}