<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;

/**
 * This is the model class for table "product_pics".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $image_path
 */
class ProductPics extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_pics';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['image_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'image_path' => Yii::t('app', 'Image Path'),
        ];
    }

    public static function getAllImgModelById( $id ){
        $data = Yii::$app->db->createCommand("SELECT * FROM product_pics WHERE product_id =".intval($id)." ORDER BY id DESC")->queryAll();
        return $data;
    }
}
