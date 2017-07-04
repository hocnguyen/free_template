<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 11/3/17
 * Time: 10:46 PM
 */
namespace app\modules\front\controllers;

use app\models\Orders;
use app\models\OrderItems;
use app\models\OrderSessions;
use app\models\Products;
use app\models\ProductsSearch;
use app\models\Mail;
use app\modules\front\components\FrontBaseController;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class CheckoutController extends FrontBaseController{

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

    public function actionIndex(){
        if (Yii::$app->user->isGuest) {
            \Yii::$app->session->setFlash('error_wishlist', 'Please sign in or register to process to checkout');
            $this->redirect(['/login']);
        }

        $theTotal  = Yii::$app->session['total_amount']?Yii::$app->session['total_amount']:0;
        if ($theTotal == 0) {
            $this->redirect(['/cart']);
        }

        $session_cart  = OrderSessions::find()->where('sesssion_customer =:sesssion_customer',[':sesssion_customer'=>Yii::$app->session->id ])->all();

        return $this->render('index',[
            'session_cart'=> $session_cart,
        ]);
    }

    public function actionPayment(){
        $theTotal                               = Yii::$app->session['total_amount']?Yii::$app->session['total_amount']:0;
        $cart                                   = isset(Yii::$app->session['cart'])?Yii::$app->session['cart']:array();
        $paymentInfo['Order']['theTotal']       = number_format($theTotal, 2);
        $paymentInfo['Order']['description']    = Yii::t('app', 'ClickBuyAll: Purchase');
        Yii::$app->Paypal->returnUrl = Yii::$app->urlManager->createAbsoluteUrl('/purchased');
        Yii::$app->Paypal->cancelUrl = Yii::$app->urlManager->createAbsoluteUrl('/canceled');
        $result = Yii::$app->Paypal->SetExpressCheckout($paymentInfo); 
            if(!Yii::$app->Paypal->isCallSucceeded($result)){
                if(Yii::$app->Paypal->apiLive === 1){
                    $error = 'We were unable to process your request. Please try again later';
                }else{
                    $error = $result['L_LONGMESSAGE0'];;
                }
                Yii::$app->session->setFlash('error', $error);
                $this->redirect('/cart');
            }else {
                $orders                 = new Orders();
                $orders->user_id        = intval(Yii::$app->user->id);
                $orders->amount         = $theTotal;
                $orders->data_orders    = serialize($cart);
                $orders->status_id      = Orders::STATUS_PENDING;
                $orders->created        = date('Y-m-d H:i:s');
                $orders->updated        = date('Y-m-d H:i:s');
                if ($orders->save()) {
                    foreach($cart as $item=>$val){
                        $product                = Products::findOne($item);
                        $order_item             = new OrderItems();
                        $order_item->order_id   = $orders->id;
                        $order_item->product_id = $item;
                        $order_item->qty        = $val['qty'];
                        $order_item->unit_price = $product->special_price?$product->special_price:$product->price;
                        $order_item->created    = date('Y-m-d H:i:s');
                        $order_item->updated    = date('Y-m-d H:i:s');
                        if( $order_item->save() ){
                            Yii::$app->session->setFlash('OrderItem','Order Item success!');
                        }
                        else{
                            print_r($order_item->getErrors());
                        }
                    }
                } else {
                    print_r($orders->getErrors());
                }

                $token      = urldecode($result["TOKEN"]);
                $payPalURL  = Yii::$app->Paypal->paypalUrl.$token;
                $this->redirect($payPalURL);
            }     
    }

    function actionPurchased(){
        $token          = isset($_GET['token'])?$_GET['token']:'';
        if ($token == '') {
            $this->redirect('/cart');
        }

        $theTotal       = Yii::$app->session['total_amount']?Yii::$app->session['total_amount']:0;
        $result         = Yii::$app->Paypal->GetExpressCheckoutDetails($token);

        $result['TOKEN']        = $token;
        $result['ORDERTOTAL']   = number_format($theTotal, 2);

        if(!Yii::$app->Paypal->isCallSucceeded($result)){
            if(Yii::$app->Paypal->apiLive === true){
                $error = 'We were unable to process your request. Please try again later';
            }else{
                $error = $result['L_LONGMESSAGE0'];
            }
            Yii::$app->session->setFlash('error', $error);
            $this->redirect('/checkout');
        }else{

            $paymentResult = Yii::$app->Paypal->DoExpressCheckoutPayment($result);
            if(!Yii::$app->Paypal->isCallSucceeded($paymentResult)){
                if(Yii::$app->Paypal->apiLive === true){
                    $error = 'We were unable to process your request. Please try again later';
                }else{
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                Yii::$app->session->setFlash('error', $error);
                $this->redirect('/checkout');
            } else {
                $orders                 = Orders::find()->where('user_id =:user_id ORDER BY id DESC', [':user_id' => intval(Yii::$app->user->id)])->one();
                $orders->transaction_id = $paymentResult['TRANSACTIONID'];
                $orders->status_id      = Orders::STATUS_APPROVED;
                $orders->updated        = date('Y-m-d H:i:s');

                if($orders->save()) {       
                    //Send Email to customer and admin 
                    $user   = Yii::$app->func->getUser(intval(Yii::$app->user->id));
                    $templateEmail = Mail::find()->where('type =:type AND is_status =:is_status',[':type'=>"Purchase Details", ':is_status' => Yii::$app->params['status_active'] ])->one();        
                    \Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['support_email'])
                    ->setTo([$user->email, Yii::$app->params['support_email']])
                    ->setSubject($templateEmail->subject)
                    ->setHtmlBody(
                        \Yii::t('app', $templateEmail->mail_body, [
                        	'sitename'    			=> Yii::$app->params['site_name'],
                            'customer_fname'    	=> $user->fname.' '.$user->lname,
                            'customer_email'    	=> $user->email,
                            'amount'				=> Yii::$app->func->formatPrice(Yii::$app->session['total_amount']),
                            'status'				=> Yii::t('app','APPROVED'),
                            'transaction_id'      	=> $paymentResult['TRANSACTIONID'],
                            'purchase_timestamp'    => $orders->updated,
                            'supportEmail'    		=> Yii::$app->params['support_email']
                        ])
                    )->send(); 
                    //Remove session
                    unset(Yii::$app->session['cart']);
                    unset(Yii::$app->session['total_cart']);
                    unset(Yii::$app->session['total_amount']);
                    Yii::$app->session->setFlash('success', Yii::t('app', 'Purchase successfully!'));
                    $this->redirect('/orders');
                } else {
                    print_r($orders->getErrors());
                }    
            }
        }
    }

    public function actionCanceled() {
        $orders                 = Orders::find()->where('user_id =:user_id ORDER BY id DESC', [':user_id' => intval(Yii::$app->user->id)])->one();
        $orders->status_id      = Orders::STATUS_CANCEL;
        $orders->updated        = date('Y-m-d H:i:s');
        if($orders->save()) {
        	//Send Email to customer and admin 
                    $user   = Yii::$app->func->getUser(intval(Yii::$app->user->id));
                    $templateEmail = Mail::find()->where('type =:type AND is_status =:is_status',[':type'=>"Purchase Details", ':is_status' => Yii::$app->params['status_active'] ])->one();        
                    \Yii::$app->mailer->compose()
                    ->setFrom(Yii::$app->params['support_email'])
                    ->setTo([$user->email, Yii::$app->params['support_email']])
                    ->setSubject($templateEmail->subject)
                    ->setHtmlBody(
                        \Yii::t('app', $templateEmail->mail_body, [
                        	'sitename'    			=> Yii::$app->params['site_name'],
                            'customer_fname'    	=> $user->fname.' '.$user->lname,
                            'customer_email'    	=> $user->email,
                            'amount'				=> Yii::$app->func->formatPrice(Yii::$app->session['total_amount']),
                            'status'				=> Yii::t('app','DECLINED'),
                            'transaction_id'      	=> '',
                            'purchase_timestamp'    => $orders->updated,
                            'supportEmail'    		=> Yii::$app->params['support_email']
                        ])
                    )->send(); 
            //Remove session
            unset(Yii::$app->session['cart']);
            unset(Yii::$app->session['total_cart']);
            unset(Yii::$app->session['total_amount']);
            $this->redirect('/cart');
        }  
        else {
            print_r($orders->getErrors());
        }    
    }

}