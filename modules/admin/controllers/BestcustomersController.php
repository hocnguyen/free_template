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
class BestcustomersController extends AdminBaseController
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

        $count = Yii::$app->db->createCommand("SELECT COUNT(custo.id) FROM
                (SELECT user.* FROM `user` INNER JOIN orders ON `user`.id = orders.`user_id` WHERE orders.status_id = 2 
                GROUP BY `user`.id) AS custo")->queryScalar();

        $total_money = Yii::$app->db->createCommand("SELECT SUM(total_amount) FROM (                       
 SELECT user.*, SUM(orders.`amount`) AS total_amount, MAX(orders.`created`) AS max_created, orders.`status_id`  FROM `user` INNER JOIN orders ON `user`.id = orders.`user_id` WHERE orders.status_id = 2 
                        GROUP BY `user`.id
                        ORDER BY total_amount DESC ) AS total_money")->queryScalar();

        $dataProvider = new SqlDataProvider([
                    'sql' => 'SELECT user.*, SUM(orders.`amount`) AS total_amount, MAX(orders.`created`) AS max_created, orders.`status_id`  FROM `user` INNER JOIN orders ON `user`.id = orders.`user_id` WHERE orders.status_id = 2 
                        GROUP BY `user`.id
                        ORDER BY total_amount DESC',
                    'totalCount' => $count,
                    'sort' => [
                        'attributes' => [
                            'id' => [
                                'asc'       => ['id' => SORT_ASC],
                                'desc'      => ['id' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Id',
                            ],
                            'username'   => [
                                'asc'       => ['username' => SORT_ASC],
                                'desc'      => ['username' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Customer',
                            ],
                            'email'   => [
                                'asc'       => ['email' => SORT_ASC],
                                'desc'      => ['email' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Email',
                            ],
                            'status_id'   => [
                                'asc'       => ['status_id' => SORT_ASC],
                                'desc'      => ['status_id' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Status',
                            ],                    
                            'total_amount'  => [
                                'asc'       => ['total_amount' => SORT_ASC],
                                'desc'      => ['total_amount' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Total Amount',
                            ],
                            'created'       => [
                                'asc'       => ['created' => SORT_ASC],
                                'desc'      => ['created' => SORT_DESC],
                                'default'   => SORT_DESC,
                                'label'     => 'Created',
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
