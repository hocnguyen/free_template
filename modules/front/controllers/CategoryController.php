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
use app\models\Contacts;
use app\models\Categories;

class CategoryController extends FrontBaseController{

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
        $category   = Categories::findOne(intval($alias));
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM products
                              INNER JOIN product_categories
                              ON products.`id` = product_categories.`product_id`
                              INNER JOIN categories
                              ON product_categories.`category_id` = categories.`id`
                              WHERE categories.`id` = '.intval($alias).' OR categories.`parent_id` ='.intval($alias).' GROUP BY products.`id`')->queryScalar();
        $products   = new SqlDataProvider([
                    'sql' => 'SELECT products.* FROM products
                              INNER JOIN product_categories
                              ON products.`id` = product_categories.`product_id`
                              INNER JOIN categories
                              ON product_categories.`category_id` = categories.`id`
                              WHERE categories.`id` = '.intval($alias).' OR categories.`parent_id` = '.intval($alias).' GROUP BY products.`id` ORDER BY products.id DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]); 
        return $this->render('index',[
            'category' => $category,
            'products' => $products
        ]);
    }

}