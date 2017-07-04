<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $transaction_id
 * @property double $amount
 * @property string $data_orders
 * @property integer $status_id
 * @property integer $is_download
 * @property integer $type
 * @property integer $id_read 
 * @property string $sesssion_customer
 * @property string $created
 * @property string $updated
 *
 * @property OrderItems[] $orderItems
 * @property User $user
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 1;
    const STATUS_APPROVED = 2;
    const STATUS_CANCEL = 3;
    const STATUS_REFUNDED = 4;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'status_id', 'is_download', 'type', 'id_read'], 'integer'],
            [['user_id'], 'required'],
            [['amount'], 'number'],
            [['data_orders'], 'string'],
            [['created', 'updated'], 'safe'],
            [['transaction_id'], 'string', 'max' => 255],
            [['sesssion_customer'], 'string', 'max' => 50],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'amount' => Yii::t('app', 'Amount'),
            'data_orders' => Yii::t('app', 'Data Orders'),
            'status_id' => Yii::t('app', 'Status ID'),
            'is_download' => Yii::t('app', 'Is Download'),
            'type' => Yii::t('app', 'Type'),
            'id_read' => Yii::t('app', 'Is Read'), 
            'sesssion_customer' => Yii::t('app', 'Sesssion Customer'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

     /* Getter for product name */
    public function getProductName() {
        error_reporting(0);
        $orders             = OrderItems::find()->where('order_id =:order_id',[':order_id'=>$this->id])->all();
        $listProduct        = "";
        foreach($orders as $item){
            $product_data   = Products::findOne($item['product_id']);
            $listProduct    .= Html::a( $product_data->name, Yii::$app->params['url_admin'].'/products/view?id='.$product_data->id )."<br>";
        }
        return $listProduct;
    }

    public function getProductNameFE() {
        error_reporting(0);
        $orders             = OrderItems::find()->where('order_id =:order_id',[':order_id'=>$this->id])->all();
        $listProduct        = "";
        foreach($orders as $item){
            $product_data   = Products::findOne($item['product_id']);
            $listProduct    .= Html::a( $product_data->name, '/detail/'.$product_data->id.'-'.Yii::$app->func->makeAlias($product_data->name))."<br>";
        }
        return $listProduct;
    }

    /* Getter for username */
    public function getMemberName() {
        return Html::a( $this->user->username, Yii::$app->params['url_admin'].'/user/view?id='.$this->user->id );
    }

    /* Best Customer */
    public function getNameCustomer($data) {
        return Html::a( $data['username'], Yii::$app->params['url_admin'].'/user/view?id='.$data['id'] );
    }

    /* Getter for quantity */
    public function getQuantity() {
        error_reporting(0);
        $orders             = OrderItems::find()->where('order_id =:order_id',[':order_id'=>$this->id])->all();
        $qty                = "";
        foreach($orders as $item){
            $qty   .= $item['qty']."<br>";
        }
        return $qty;
    }

    /* Getter for Unit Price */
    public function getUnitPrice() {
        error_reporting(0);
        $orders             = OrderItems::find()->where('order_id =:order_id',[':order_id'=>$this->id])->all();
        $unit_price         = "";
        foreach($orders as $item){
            $unit_price   .= Yii::$app->func->formatPrice($item['unit_price'])."<br>";
        }
        return $unit_price;
    }

    public function getTotalAmount() {
        return Yii::$app->func->formatPrice($this->amount);
    }

    public function GetNameStatus() {
        $status = OrderStatus::findOne($this->status_id);
        return $status->name;
    }

    public function GetNameStatusBest($id) {
        $status = OrderStatus::findOne($id);
        if ( !$status )
            $sta = Yii::t('app','NOT PURCHASE');
        else
            $sta = $status->name;
        return $sta;
    }

    public function getRead()
    {
        $str = Yii::t('app',"Unread");
        if( $this->id_read )
            $str = Yii::t('app',"Read");
        return $str;
    }
    
}
