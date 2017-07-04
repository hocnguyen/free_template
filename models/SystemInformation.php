<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "system_information".
 *
 * @property integer $id
 * @property string $author
 * @property string $version
 * @property string $technical
 * @property string $modules
 * @property string $next_upgrade
 * @property string $created
 * @property string $updated
 */
class SystemInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'system_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['author'], 'required'],
            [['technical', 'modules', 'next_upgrade'], 'string'],
            [['created', 'updated'], 'safe'],
            [['author', 'version'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author' => Yii::t('app', 'Author'),
            'version' => Yii::t('app', 'Version'),
            'technical' => Yii::t('app', 'Technical'),
            'modules' => Yii::t('app', 'Modules'),
            'next_upgrade' => Yii::t('app', 'Next Upgrade'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
