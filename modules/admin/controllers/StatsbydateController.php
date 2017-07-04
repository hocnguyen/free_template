<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 4/7/17
 * Time: 9:50 PM
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
class StatsbydateController extends AdminBaseController
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
        return $this->render('index',[
            'dataProvider' => $dataProvider,
            'total_money' => $total_money
        ]);
    }

}
