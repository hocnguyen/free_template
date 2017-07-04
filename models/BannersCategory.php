<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "banners_category".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $position
 * @property integer $is_active
 * @property string $image
 * @property string $link
 * @property string $created
 * @property string $updated
 *
 * @property Categories $category
 */
class BannersCategory extends \yii\db\ActiveRecord
{
    const POSITION_TOP    = 1;
    const POSITION_BOTTOM = 2;
    const POSITION_RIGHT  = 3;
    const POSITION_LEFT   = 4;

    const STATUS_ACTIVE   = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name'], 'required'],
            [['category_id', 'is_active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'image', 'link'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 100],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'position' => Yii::t('app', 'Position'),
            'is_active' => Yii::t('app', 'Is Active'),
            'image' => Yii::t('app', 'Image'),
            'link' => Yii::t('app', 'Link'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    public function getCategoryName() {
        return Html::a( $this->category->name, Yii::$app->params['url_admin'].'/categories/view?id='.$this->category->id );
    }

    public function getImageurl()
    {
            return Html::img('/uploads/advertising/'.$this->image, ['width'=>'90'] );
    }

    public function getImageView()
    {
            return Html::img('/uploads/advertising/'.$this->image);
    }

    public function getNamePosition(  ){
        if( $this->position == Banners::POSITION_TOP )
            $nametype = Yii::t('app','Top');
        else if ( $this->position == Banners::POSITION_BOTTOM )
            $nametype = Yii::t('app','Bottom');
        else if ( $this->position == Banners::POSITION_RIGHT )
            $nametype = Yii::t('app','Right');
        else if ( $this->position == Banners::POSITION_LEFT )
            $nametype = Yii::t('app','Left');

        return $nametype;
    }

    public function getStatusBannersAjax( ){
        $ajax       = "<div id='ajax-status-new'> <a onclick='ajaxUpdateStatus(".$this->id.")' class='update-status-ajax-".$this->id."'> <img src='".Yii::getAlias('@back')."/img/uncheck-icon.png' alt='".Yii::t('app','Disabled')."' title='".Yii::t('app','Disabled')."' > </a> </div>";
        if( $this->is_active == Banners::STATUS_ACTIVE )
            $ajax   = "<div id='ajax-status-new'> <a onclick='ajaxUpdateStatus(".$this->id.")' class='update-status-ajax-".$this->id."' > <img src='".Yii::getAlias('@back')."/img/check-icon.png' alt='".Yii::t('app','Enabled')."' title='".Yii::t('app','Enabled')."'> </a> </div>";
        return $ajax;
    }

}
