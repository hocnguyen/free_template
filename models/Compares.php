<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "compares".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $product_id
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 * @property Products $product
 */
class Compares extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'compares';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id'], 'required'],
            [['user_id', 'product_id'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
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
            'product_id' => Yii::t('app', 'Product ID'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /* Getter for product name */
    public function getProductName() {
        return Html::a( $this->product->name, Yii::$app->params['url_admin'].'/products/view?id='.$this->product->id ); 
    }

     /* Getter for username */
    public function getMemberName() {
        return Html::a( $this->user->username, Yii::$app->params['url_admin'].'/user/view?id='.$this->user->id );
    }
}
