<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "slidershow".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $description
 * @property string $link
 * @property integer $position
 * @property integer $rank
 * @property string $created
 * @property string $updated
 */
class Slidershow extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slidershow';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'image'], 'required'],
            [['description'], 'string'],
            [['position', 'rank'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image', 'link'], 'string', 'max' => 255],
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
            'description' => Yii::t('app', 'Description'),
            'link' => Yii::t('app', 'Link'),
            'position' => Yii::t('app', 'Position'),
            'rank' => Yii::t('app', 'Rank'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getImageurl()
    {
        return Html::img(Yii::getAlias('@uploads').'/slidershow/'.$this->image, ['width'=>'90'] );
    }
}
