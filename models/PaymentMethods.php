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

/**
 * This is the model class for table "payment_methods".
 *
 * @property integer $id
 * @property string $name
 * @property string $image 
 * @property string $configuration
 * @property integer $is_active
 * @property string $description
 * @property string $created
 * @property string $updated
 */
class PaymentMethods extends \yii\db\ActiveRecord
{
    const PAYPAL = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payment_methods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['configuration', 'description'], 'string'],
            [['is_active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image'], 'string', 'max' => 128],
            [['image'], 'file', 'extensions' => 'gif, jpg, png, gif, jpeg, jfif, tiff, bmp, ppm']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'), 
            'configuration' => Yii::t('app', 'Configuration'),
            'is_active' => Yii::t('app', 'Is Active'),
            'description' => Yii::t('app', 'Description'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
    public function getActive()
    {
        $str = "Disable";
        if( $this->is_active )
            $str = "Enable";
        return $str;
    }

    public function getImageurl()
    {
        if ($this->image) {
            return Html::img('/uploads/payment-method/'.$this->image, ['width'=>'65', 'class'=>'imageresource']);
        }
    }

    public static function getSettings($method){
        $result = array();
        $method = PaymentMethods::findOne($method);
        $tmp    = explode("\n", $method->configuration);
        foreach ($tmp as $t){
            $tmp1 = explode('=', $t);
            $result[trim($tmp1[0])] = trim($tmp1[1]);
        }
        return $result;
    }

}
