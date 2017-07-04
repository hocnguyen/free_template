<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_sessions".
 *
 * @property integer $id
 * @property integer $session_id
 * @property integer $product_id
 * @property double $amount
 * @property integer $is_download
 * @property string $sesssion_customer
 * @property integer $user_id
 * @property string $created
 * @property string $updated
 */
class OrderSessions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_sessions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['session_id', 'product_id', 'is_download', 'user_id'], 'integer'],
            [['product_id'], 'required'],
            [['amount'], 'number'],
            [['created', 'updated'], 'safe'],
            [['sesssion_customer'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'session_id' => Yii::t('app', 'Session ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'amount' => Yii::t('app', 'Amount'),
            'is_download' => Yii::t('app', 'Is Download'),
            'sesssion_customer' => Yii::t('app', 'Sesssion Customer'),
            'user_id' => Yii::t('app', 'User ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
