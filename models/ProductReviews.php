<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;
use yii\helpers\Html;
use kartik\rating\StarRating;

/**
 * This is the model class for table "product_reviews".
 *
 * @property integer $id
 * @property integer $member_id
 * @property integer $product_id
 * @property double $rate
 * @property string $comment
 * @property integer $is_display
 * @property string $created
 * @property string $updated
 *
 * @property Products $product
 * @property User $user
 */
class ProductReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'product_id'], 'required'],
            [['member_id', 'product_id', 'is_display'], 'integer'],
            [['rate'], 'number'],
            [['comment'], 'string'],
            [['created', 'updated'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'product_id' => Yii::t('app', 'Product'),
            'rate' => Yii::t('app', 'Rate'),
            'comment' => Yii::t('app', 'Comment'),
            'is_display' => Yii::t('app', 'Is Display'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
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

    public function getProductNameFE() {
        return Html::a( $this->product->name, '/detail/'.$this->product->id.'-'.Yii::$app->func->makeAlias($this->product->name)); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'member_id']);
    }

     /* Getter for username */
    public function getMemberName() {
        return Html::a( $this->user->username, Yii::$app->params['url_admin'].'/user/view?id='.$this->user->id );
    }

    public function getDisplay()
    {
        $str = "Disable";
        if( $this->is_display )
            $str = "Enable";
        return $str;
    }

    public function getRateStar()
    {
       return StarRating::widget([
                                    'name' => 'rate',
                                    'value' => $this->rate,
                                    'disabled' => true
                                ]);
    }
}
