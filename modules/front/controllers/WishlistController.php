<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 3/27/17
 * Time: 10:35 PM
 */
namespace app\modules\front\controllers;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use Yii;
use app\models\Wishlist;
use app\models\WishlistSearch;

class WishlistController extends FrontBaseController{

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

    public function actionIndex($id)
    {       
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to save your wishlist');
            $this->redirect(['/login']);
        }

        $check = Wishlist::find()->where('user_id =:user_id AND product_id =:product_id',[':user_id' => Yii::$app->user->id, ':product_id' => intval($id)])->one();
        if ($check) {
            \Yii::$app->session->setFlash('exist_wishlist', 'That product is already your wishlist');
        } else {
            $model              = new Wishlist();
            $model->user_id     = Yii::$app->user->id;
            $model->product_id  = intval($id);
            $model->created     = date('Y-m-d H:i:s');
            $model->updated     = date('Y-m-d H:i:s');
            $model->save();
        }            
    }

    public function actionWishlist () {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to save your wishlist');
            $this->redirect(['/login']);
        }
        $page_size  = 10;
        $count      = yii::$app->db->createCommand('SELECT COUNT(*) FROM products INNER JOIN wishlist ON products.id = wishlist.`product_id` WHERE wishlist.`user_id` = '.intval(Yii::$app->user->id))->queryScalar();
        $products   = new SqlDataProvider([
                    'sql' => 'SELECT products.* FROM products INNER JOIN wishlist ON products.id = wishlist.`product_id` WHERE wishlist.`user_id` = '.intval(Yii::$app->user->id).' ORDER BY products.id DESC',
                    'totalCount' => $count,
                    'pagination' => [
                        'pageSize' => $page_size,
                    ],
        ]);
        return $this->render('index',[
                'products' => $products
        ]);
    }

    /**
     * Finds the Wishlist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wishlist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wishlist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionRemove ($id) {
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to save your wishlist');
            $this->redirect(['/login']);
        }

        $check = Wishlist::find()->where('user_id =:user_id AND product_id =:product_id',[':user_id' => Yii::$app->user->id, ':product_id' => intval($id)])->one();
        if ($check) {
            $check->delete();
        }
    }

}