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
 * This is the model class for table "socials".
 *
 * @property integer $id
 * @property string $type
 * @property string $icon 
 * @property string $social_link
 * @property integer $is_display
 * @property string $created
 * @property string $updated
 */
class Socials extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'socials';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'social_link'], 'required'],
            [['is_display'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['type'], 'string', 'max' => 20],
            [['icon', 'social_link'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'icon' => Yii::t('app', 'Icon'), 
            'social_link' => Yii::t('app', 'Social Link'),
            'is_display' => Yii::t('app', 'Is Display'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getDisplay()
    {
        $str = "Disable";
        if( $this->is_display )
            $str = "Enable";
        return $str;
    }

    public function getIcons()
    {
        if( $this->icon )
            $str = '<span class="fa '.$this->icon.'"></span>';
        return $str;
    }

}
