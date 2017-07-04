<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "html_pages".
 *
 * @property integer $id
 * @property string $pagecode
 * @property string $page_title
 * @property string $page_text
 * @property integer $is_status
 * @property string $created
 * @property string $updated
 */
class HtmlPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'html_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pagecode', 'page_title', 'page_text'], 'required'],
            [['page_text'], 'string'],
            [['is_status'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['pagecode', 'page_title'], 'string', 'max' => 250],
            [['pagecode'], 'unique', 'message' => Yii::t('app', 'That Page code is already Html Pages.')],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'pagecode' => Yii::t('app', 'Pagecode'),
            'page_title' => Yii::t('app', 'Page Title'),
            'page_text' => Yii::t('app', 'Page Text'),
            'is_status' => Yii::t('app', 'Is Status'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getDisplay()
    {
        $str = "Disable";
        if( $this->is_status )
            $str = "Enable";
        return $str;
    }
}
