<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 4/7/17
 * Time: 9:5 PM
 */
namespace app\modules\admin\controllers;

use Yii;
use yii\data\SqlDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\components\AdminBaseController;

/**
 * UserController implements the CRUD actions for User model.
 */
class StatsproductsController extends AdminBaseController
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
       if(!\Yii::$app->user->id)
            return $this->goHome();

        $count = Yii::$app->db->createCommand("SELECT COUNT(cou_pro.id) FROM (SELECT products.id, products.name, stats_product.sum_amount, stats_product.created, stats_product.qty, stats_product.unit_price FROM products LEFT JOIN 
(SELECT stats.id, stats.name, stats.qty, stats.unit_price, (stats.qty * stats.`unit_price`) AS sum_amount, MAX(stats.created) AS created  FROM (

    SELECT products.*, SUM(order_items.`qty`) AS qty, order_items.`unit_price`,orders.`user_id` ,orders.`status_id` FROM products 
    INNER JOIN order_items ON products.id = order_items.`product_id` 
    INNER JOIN orders ON order_items.`order_id` = orders.id
    WHERE orders.`status_id` = 2
    GROUP BY products.id
    ORDER BY qty DESC   
    )  AS stats
GROUP BY stats.id
ORDER BY stats.qty DESC) AS stats_product ON products.id = stats_product.id 
ORDER BY stats_product.qty DESC)  AS cou_pro")->queryScalar();

        $total_money = Yii::$app->db->createCommand("SELECT SUM(cou_pro.sum_amount) FROM (SELECT products.id, products.name, stats_product.sum_amount, stats_product.created, stats_product.qty, stats_product.unit_price FROM products LEFT JOIN 
(SELECT stats.id, stats.name, stats.qty, stats.unit_price, (stats.qty * stats.`unit_price`) AS sum_amount, MAX(stats.created) AS created  FROM (

    SELECT products.*, SUM(order_items.`qty`) AS qty, order_items.`unit_price`,orders.`user_id` ,orders.`status_id` FROM products 
    INNER JOIN order_items ON products.id = order_items.`product_id` 
    INNER JOIN orders ON order_items.`order_id` = orders.id
    WHERE orders.`status_id` = 2
    GROUP BY products.id
    ORDER BY qty DESC   
    )  AS stats
GROUP BY stats.id
ORDER BY stats.qty DESC) AS stats_product ON products.id = stats_product.id 
ORDER BY stats_product.qty DESC)  AS cou_pro")->queryScalar();

        $dataProvider = new SqlDataProvider([
                    'sql' => 'SELECT products.id, products.name, stats_product.sum_amount, stats_product.created, stats_product.qty, stats_product.unit_price FROM products LEFT JOIN 
(SELECT stats.id, stats.name, stats.qty, stats.unit_price, (stats.qty * stats.`unit_price`) AS sum_amount, MAX(stats.created) AS created  FROM (

    SELECT products.*, SUM(order_items.`qty`) AS qty, order_items.`unit_price`,orders.`user_id` ,orders.`status_id` FROM products 
    INNER JOIN order_items ON products.id = order_items.`product_id` 
    INNER JOIN orders ON order_items.`order_id` = orders.id
    WHERE orders.`status_id` = 2
    GROUP BY products.id
    ORDER BY qty DESC 
    
    )  AS stats
GROUP BY stats.id
ORDER BY stats.qty DESC) AS stats_product ON products.id = stats_product.id 
ORDER BY stats_product.qty DESC',
                    'totalCount' => $count,
                    'sort' => [
                        'attributes' => [
                            'id' => [
                                'asc'       => ['id' => SORT_ASC],
                                'desc'      => ['id' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => Yii::t('app','Id'),
                            ],
                            'name'   => [
                                'asc'       => ['name' => SORT_ASC],
                                'desc'      => ['name' => SORT_DESC],
                                'label'     => Yii::t('app','Name'),
                            ],
                            'unit_price'   => [
                                'asc'       => ['unit_price' => SORT_ASC],
                                'desc'      => ['unit_price' => SORT_DESC],
                                'label'     => Yii::t('app','Price'),
                            ],
                            'qty'   => [
                                'asc'       => ['qty' => SORT_ASC],
                                'desc'      => ['qty' => SORT_DESC],
                                'label'     => Yii::t('app','Quantity'),
                            ],                    
                            'sum_amount'  => [
                                'asc'       => ['sum_amount' => SORT_ASC],
                                'desc'      => ['sum_amount' => SORT_DESC],
                                'label'     => Yii::t('app','Total Amount'),
                            ],
                            'created'       => [
                                'asc'       => ['created' => SORT_ASC],
                                'desc'      => ['created' => SORT_DESC],
                                'label'     => Yii::t('app','Created'),
                            ]
                        ],
                    ],
                    'pagination' => [
                        'pageSize' => 20,
                    ],
                ]);
        return $this->render('index',[
            'dataProvider'=> $dataProvider,
            'total_money' => $total_money
        ]);
    }
}
