<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 4/9/17
 * Time: 10:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class BestsellingController extends FrontBaseController{

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
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM (
SELECT stats.id  FROM (
                        SELECT products.*, SUM(order_items.`qty`) AS qty, order_items.`unit_price` ,orders.`status_id` FROM products 
                        INNER JOIN order_items ON products.id = order_items.`product_id` 
                        INNER JOIN orders ON order_items.`order_id` = orders.id
                        WHERE orders.`status_id` = 2
                        GROUP BY products.id
                        ORDER BY qty DESC 
                    )  AS stats
                    GROUP BY stats.id
                    ORDER BY stats.qty DESC ) AS temp')->queryScalar();
        $products   = new SqlDataProvider([
                    'sql' => 'SELECT stats.*, stats.qty, stats.unit_price, (stats.qty * stats.`unit_price`) AS sum_amount  FROM (
                        SELECT products.*, SUM(order_items.`qty`) AS qty, order_items.`unit_price` ,orders.`status_id` FROM products 
                        INNER JOIN order_items ON products.id = order_items.`product_id` 
                        INNER JOIN orders ON order_items.`order_id` = orders.id
                        WHERE orders.`status_id` = 2
                        GROUP BY products.id
                        ORDER BY qty DESC 
                    )  AS stats
                    GROUP BY stats.id
                    ORDER BY stats.qty DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]); 
        return $this->render('index',[
            'products' => $products
        ]);
    }

}