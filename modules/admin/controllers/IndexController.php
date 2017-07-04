<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 2/7/17
 * Time: 4:50 PM
 */
namespace app\modules\admin\controllers;
use Yii;
use app\modules\admin\components\AdminBaseController;
use app\models\Orders;
use app\models\OrdersSearch;
use app\models\User;
use app\models\UserSearch;
use app\models\Contacts;
use app\models\ContactsSearch;
use app\models\Products;
use app\models\ProductsSearch;
use app\models\ProductPics;
use app\models\ProductManufacturers;
use app\models\ProductCategories;
use app\models\Tags;
use app\models\ProductTags;
use yii\data\SqlDataProvider;

class IndexController extends AdminBaseController
{
    public function init(){
        parent::init();
    }
    public function actionIndex(){
        if(\Yii::$app->user->isGuest){
            return $this->redirect('/admin-login');
        }

        $searchMembers  = new UserSearch();
        $queryParams = array_merge(array(),Yii::$app->request->getQueryParams());
        $queryParams["UserSearch"]["role"] = User::ROLE_USER;
        $dataMembers    = $searchMembers->search($queryParams);

        $searchOrders   = new OrdersSearch();
        $dataOrders     = $searchOrders->search(Yii::$app->request->queryParams);

        //$searchContacts = new ContactsSearch();
        //$dataContacts   = $searchContacts->search(Yii::$app->request->queryParams);
         $count = Yii::$app->db->createCommand("SELECT COUNT(*) FROM
                (SELECT MAX(created), SUM(amount), transaction_id, status_id FROM orders WHERE status_id = 2 GROUP BY DATE(created) ORDER BY created DESC) AS custom")->queryScalar();

        $total_money= Yii::$app->db->createCommand("SELECT SUM(amount) FROM (
SELECT MAX(created), SUM(amount) as amount, transaction_id, status_id FROM orders WHERE status_id = 2 GROUP BY DATE(created) ORDER BY created DESC) AS total_money")->queryScalar();

        $dataProvider = new SqlDataProvider([
                    'sql' => 'SELECT MAX(created) AS created, SUM(amount) as amount, transaction_id, status_id FROM orders WHERE status_id = 2 GROUP BY DATE(created) ORDER BY created DESC',
                    'totalCount' => $count,
                    'sort' => [
                        'attributes' => [
                            'created' => [
                                'asc'       => ['created' => SORT_ASC],
                                'desc'      => ['created' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Created',
                            ],
                            'amount'   => [
                                'asc'       => ['amount' => SORT_ASC],
                                'desc'      => ['amount' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Amount',
                            ],
                            'transaction_id'   => [
                                'asc'       => ['transaction_id' => SORT_ASC],
                                'desc'      => ['transaction_id' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Transaction Id',
                            ],
                            'status_id'   => [
                                'asc'       => ['status_id' => SORT_ASC],
                                'desc'      => ['status_id' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Status',
                            ]
                        ],
                    ],
                    'pagination' => [
                        'pageSize' => 20,
                    ],
                ]);

        $searchProducts = new ProductsSearch();
        $dataProducts   = $searchProducts->search(Yii::$app->request->queryParams);

        return $this->render('index',[
            'searchOrders'      => $searchOrders,
            'dataOrders'        => $dataOrders,
            'searchMembers'     => $searchMembers,
            'dataMembers'       => $dataMembers,
            'total_money'       => $total_money,
            'dataProvider'      => $dataProvider,
            'searchProducts'    => $searchProducts,
            'dataProducts'      => $dataProducts
        ]);
    }

}