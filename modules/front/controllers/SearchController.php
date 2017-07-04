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

class SearchController extends FrontBaseController{

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
        error_reporting(0);
        $keyword                              = stripcslashes($_POST['search_text']);
        $category                             = intval($_POST['search_category']);
        $keyword_get                          = stripslashes(isset($_GET['keyword'])?$_GET['keyword']:'');
        Yii::$app->session['keyword_search']  = isset($keyword)?$keyword:$keyword_get;
        $page_size                            = 20;
        if (isset($category)) {
          $condition = " AND (categories.id = ".$category." OR parent_id =".$category.") ";
          Yii::$app->session['category_search'] = $category;
        }  
        $sql = 'SELECT products.* FROM products
                                  INNER JOIN product_categories
                                  ON products.`id` = product_categories.`product_id` 
                                  INNER JOIN categories
                                  ON product_categories.`category_id` = categories.`id`
                                  WHERE (products.`name` LIKE "%'.Yii::$app->session['keyword_search'].'%" OR products.`short_description` LIKE "%'.Yii::$app->session['keyword_search'].'%" OR products.`full_dsscription` LIKE "%'.Yii::$app->session['keyword_search'].'%") '.$condition.' GROUP BY products.id ORDER BY products.id DESC 
                                  ';
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM products
                                  INNER JOIN product_categories
                                  ON products.`id` = product_categories.`product_id` 
                                  INNER JOIN categories
                                  ON product_categories.`category_id` = categories.`id`
                                  WHERE (products.`name` LIKE "%'.Yii::$app->session['keyword_search'].'%" OR products.`short_description` LIKE "%'.Yii::$app->session['keyword_search'].'%" OR products.`full_dsscription` LIKE "%'.Yii::$app->session['keyword_search'].'%") '.$condition.' GROUP BY products.id ')->queryScalar();
        $products   = new SqlDataProvider([
                        'sql' => $sql,
                        'totalCount' => $count,
                        'pagination' => [
                            'pageSize' => $page_size,
                        ],
            ]); 
        return $this->render('index',[
            'keyword'   => $keyword,
            'category'  => $category,
            'products'  => $products
        ]);
    }

}