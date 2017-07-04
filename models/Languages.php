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
 * This is the model class for table "languages".
 *
 * @property integer $id
 * @property string $name
 * @property string $flag
 * @property string $languageculture
 * @property integer $is_display
 * @property integer $is_active
 * @property string $created
 * @property string $updated
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['is_display', 'is_active'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'flag', 'languageculture'], 'string', 'max' => 100],
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
            'flag' => Yii::t('app', 'Flag'),
            'languageculture' => Yii::t('app', 'Languageculture'),
            'is_display' => Yii::t('app', 'Is Display'),
            'is_active' => Yii::t('app', 'Is Active'), 
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getDisplay()
    {
        $str = "Disable";
        if ($this->is_display)
            $str = "Enable";
        return $str;
    }

    public function getStatus()
    {
        $str = "UnActive";
        if ($this->is_active)
            $str = "Active";
        return $str;
    }

    public function getIconFlag()
    {
        $str = "";
        if ($this->flag)
            $str = "<span class='flag-icon ".$this->flag."'> </span>";
        return $str;
    }

    public function getStatusLanguageAjax( ){
        $ajax       = "<div id='ajax-status-new'> <a onclick='ajaxUpdateStatus(".$this->id.")' class='update-status-ajax-".$this->id."'> <img src='".Yii::getAlias('@back')."/img/uncheck-icon.png' alt='".Yii::t('app','Disabled')."' title='".Yii::t('app','Disabled')."' > </a> </div>";
        if( $this->is_active == Yii::$app->params['status_active'] )
            $ajax   = "<div id='ajax-status-new'> <a onclick='ajaxUpdateStatus(".$this->id.")' class='update-status-ajax-".$this->id."' > <img src='".Yii::getAlias('@back')."/img/check-icon.png' alt='".Yii::t('app','Enabled')."' title='".Yii::t('app','Enabled')."'> </a> </div>";
        return $ajax;
    }

}
