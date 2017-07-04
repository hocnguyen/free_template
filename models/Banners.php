<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "banners".
 *
 * @property integer $id
 * @property string $name
 * @property string $position
 * @property double $type
 * @property integer $is_active
 * @property string $filename
 * @property string $content
 * @property string $link
 * @property integer $is_order
 * @property string $created
 * @property string $updated
 */
class Banners extends \yii\db\ActiveRecord
{
    const POSITION_TOP    = 1;
    const POSITION_BOTTOM = 2;
    const POSITION_RIGHT  = 3;
    const POSITION_LEFT   = 4;

    const TYPE_IMAGE = 1;
    const TYPE_FLASH = 2;
    const TYPE_CONTENT = 3;
    const STATUS_ACTIVE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'number'],
            [['is_active', 'is_order'], 'integer'],
            [['name'], 'required'],
            [['content'], 'string'],
            [['created', 'updated'], 'safe'],
            [['name', 'filename', 'link'], 'string', 'max' => 255],
            [['position'], 'string', 'max' => 100],
            [['filename'], 'file', 'extensions' => 'gif, jpg, png, gif, jpeg, jfif, tiff, bmp, ppm']
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
            'position' => Yii::t('app', 'Position'),
            'type' => Yii::t('app', 'Type'),
            'is_active' => Yii::t('app', 'Is Active'),
            'filename' => Yii::t('app', 'Filename'),
            'content' => Yii::t('app', 'Content'),
            'link' => Yii::t('app', 'Link'),
            'is_order' => Yii::t('app', 'Is Order'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getNameType(  ){
        if( $this->type == Banners::TYPE_IMAGE )
            $nametype = 'Image';
        else if ( $this->type == Banners::TYPE_FLASH )
            $nametype = 'Flash';
        else if ( $this->type == Banners::TYPE_CONTENT )
            $nametype = 'HTML code';
        return $nametype;
    }

    public function getImageurl()
    {
        if( $this->type == 1 )
            return Html::img('/uploads/banners/'.$this->filename, ['width'=>'90'] );
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
