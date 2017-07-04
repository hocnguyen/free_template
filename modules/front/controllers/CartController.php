<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 10/3/17
 * Time: 10:46 PM
 */
namespace app\modules\front\controllers;

use app\models\Orders;
use app\models\OrderSessions;
use app\models\Products;
use app\models\ProductsSearch;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;
class CartController extends FrontBaseController{

    const PAGE_SIZE = 12;
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

    function actionRemove(){
        $cart   = isset(Yii::$app->session['cart'])?Yii::$app->session['cart']:array();
        $id     = intval($_GET['id']);
        if (isset($cart[$id])){
            unset($cart[$id]);
            Yii::$app->session['cart']          = $cart;
            Yii::$app->session['total_cart']    = isset(Yii::$app->session['total_cart'])?Yii::$app->session['total_cart'] - 1:0;
            OrderSessions::deleteAll('sesssion_customer =:sesssion_customer',[':sesssion_customer'=>Yii::$app->session->id]);
            $total_amount   = 0;     
            $total_money    = 0;      
            foreach( $cart as $key=>$val ){
                $product                    = Products::findOne($key);
                $total_amount               += ($val['qty'] * ($product->special_price?$product->special_price:$product->price));
                $temp                       = new OrderSessions();
                $temp->product_id           = $key;
                $temp->amount               = ($product->special_price)?$product->special_price:$product->price;
                $temp->sesssion_customer    = Yii::$app->session->id;
                $temp->created              = date('Y-m-d H:i:s');
                $temp->updated              = date('Y-m-d H:i:s');
                if( $temp->save() ){
                    $total_money            = $total_amount;
                    Yii::$app->session->setFlash('OrderSession','Order Session success!');
                }
                else{
                    print_r($temp->getErrors());
                }
            }
            Yii::$app->session['total_amount'] = $total_money;
        }
    }

    public function actionAdd(){
        $cart = isset(Yii::$app->session['cart'])?Yii::$app->session['cart']:array();
        $id = intval($_GET['id']);
        if( $id && Products::findOne($id) ){
            if (isset($cart[$id]['qty'])){
                $cart[$id]['qty'] += 1;
            }
            else {
                $cart[$id]['qty'] = 1;
            }
            $cart[$id]['added'] = time();
        }
        Yii::$app->session['cart'] = $cart;
        OrderSessions::deleteAll('sesssion_customer =:sesssion_customer',[':sesssion_customer'=>Yii::$app->session->id]);
        $total_amount = 0;
        foreach( $cart as $key=>$val ){
            $product                    = Products::findOne($key);
            $total_amount               += ($val['qty'] * ($product->special_price?$product->special_price:$product->price));
            $temp                       = new OrderSessions();
            $temp->product_id           = $key;
            $temp->amount               = $product->special_price?$product->special_price:$product->price;
            $temp->sesssion_customer    = Yii::$app->session->id;
            $temp->user_id              = intval(Yii::$app->user->id);
            $temp->created              = date('Y-m-d H:i:s');
            $temp->updated              = date('Y-m-d H:i:s');
            if( $temp->save() ){
                $session_cart                       = OrderSessions::find()->where('sesssion_customer =:sesssion_customer ORDER BY id DESC',[ ':sesssion_customer'=>Yii::$app->session->id ])->all();
                Yii::$app->session['total_cart']    = count($session_cart);
                Yii::$app->session['total_amount']  = $total_amount;
                Yii::$app->session->setFlash('OrderSession','Order Session success!');
            }
            else{
                print_r($temp->getErrors());
            }
        }
    }

    public function actionQty(){
        $cart   = isset(Yii::$app->session['cart'])?Yii::$app->session['cart']:array();
        $id     = intval($_GET['id']);
        $qty    = intval($_GET['qty']);

        if( $id && Products::findOne($id) ){
            if (isset($cart[$id]['qty'])){
                $cart[$id]['qty'] = $qty;
            }
            else {
                $cart[$id]['qty'] = ($qty > 0)?$qty:1;
            }
            $cart[$id]['added'] = time();
        }
        Yii::$app->session['cart'] = $cart;
        OrderSessions::deleteAll('sesssion_customer =:sesssion_customer',[':sesssion_customer'=>Yii::$app->session->id]);
        $total_amount = 0;
        foreach( $cart as $key=>$val ){
            $product                    = Products::findOne($key);
            $total_amount               += ($val['qty'] * ($product->special_price?$product->special_price:$product->price));
            $temp                       = new OrderSessions();
            $temp->product_id           = $key;
            $temp->amount               = $product->special_price?$product->special_price:$product->price;
            $temp->sesssion_customer    = Yii::$app->session->id;
            $temp->user_id              = intval(Yii::$app->user->id);
            $temp->created              = date('Y-m-d H:i:s');
            $temp->updated              = date('Y-m-d H:i:s');
            if( $temp->save() ){
                $session_cart                       = OrderSessions::find()->where('sesssion_customer =:sesssion_customer ORDER BY id DESC',[ ':sesssion_customer'=>Yii::$app->session->id ])->all();
                Yii::$app->session['total_cart']    = count($session_cart);
                Yii::$app->session['total_amount']  = $total_amount;
                Yii::$app->session->setFlash('OrderSession','Order Session success!');
            }
            else{
                print_r($temp->getErrors());
            }
        }

    }

    public function actionIndex(){
        $session_cart  = OrderSessions::find()->where('sesssion_customer =:sesssion_customer',[':sesssion_customer'=>Yii::$app->session->id ])->all();

        return $this->render('order',[
            'session_cart'=> $session_cart,
        ]);
    }

    public function actionCustomer(){
        return $this->render('customer');
    }

    public function actionReset(){
        unset(Yii::$app->session['cart']);
        unset(Yii::$app->session['total_cart']);
        unset(Yii::$app->session['total_amount']);
    }
}