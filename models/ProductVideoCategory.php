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
 * This is the model class for table "product_video_category".
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $video_id
 * @property integer $category_id
 * @property integer $is_display
 * @property string $created
 * @property string $updated
 */
class ProductVideoCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_video_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'video_id', 'category_id', 'is_display'], 'integer'],
            [['created', 'updated'], 'safe'],
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
            'video_id' => Yii::t('app', 'Video ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'is_display' => Yii::t('app', 'Is Display'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
