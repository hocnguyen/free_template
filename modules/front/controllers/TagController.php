<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/16/17
 * Time: 9:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
use app\models\Tags;

class TagController extends FrontBaseController{

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
        $tag        = Tags::findOne(intval($alias));
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM products
                              INNER JOIN product_tags
                              ON products.`id` = product_tags.`product_id`
                              INNER JOIN tags
                              ON product_tags.`tag_id` = tags.`id`
                              WHERE tags.`id` = '.intval($alias).'')->queryScalar();
        $products   = new SqlDataProvider([
                    'sql' => 'SELECT products.* FROM products
                              INNER JOIN product_tags
                              ON products.`id` = product_tags.`product_id`
                              INNER JOIN tags
                              ON product_tags.`tag_id` = tags.`id`
                              WHERE tags.`id` = '.intval($alias).' ORDER BY products.id DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]); 
        return $this->render('index',[
            'tag'       => $tag,
            'products'  => $products
        ]);
    }

}