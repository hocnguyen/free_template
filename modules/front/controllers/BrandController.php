<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/8/17
 * Time: 11:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\models\Manufacturers;

class BrandController extends FrontBaseController{

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

    public function actionIndex($alias)
    {
        $page_size  = 21;
        $brand      = Manufacturers::findOne(intval($alias));
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM products
                              INNER JOIN product_manufacturers
                              ON products.`id` = product_manufacturers.`product_id`
                              INNER JOIN manufacturers
                              ON product_manufacturers.`manufacturers_id` = manufacturers.`id`
                              WHERE manufacturers.`id` = '.intval($alias).'')->queryScalar();
        $products   = new SqlDataProvider([
                    'sql' => 'SELECT products.* FROM products
                              INNER JOIN product_manufacturers
                              ON products.`id` = product_manufacturers.`product_id`
                              INNER JOIN manufacturers
                              ON product_manufacturers.`manufacturers_id` = manufacturers.`id`
                              WHERE manufacturers.`id` = '.intval($alias).' ORDER BY products.id DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]); 
        return $this->render('index',[
            'brand'     => $brand,
            'products'  => $products
        ]);
    }

}