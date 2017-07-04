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

class ProductsController extends FrontBaseController{

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

    public function actionIndex()
    {
        $page_size  = 21;
        $data = new ActiveDataProvider(
            [
                'query' => Products::find()->where('is_status =:is_status ORDER BY `id` DESC', [':is_status'=>Yii::$app->params['status_active']]),
                'pagination' => [
                        'pageSize' => $page_size,
                    ],
            ]);
        return $this->render('index',[
            'data'          => $data,
        ]);
    }

}