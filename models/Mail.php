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
 * This is the model class for table "mail".
 *
 * @property integer $id
 * @property string $type
 * @property string $subject
 * @property string $mail_body
 * @property string $mail_keys
 * @property integer $is_status
 * @property integer $is_order
 * @property string $created
 * @property string $updated
 */
class Mail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type', 'subject', 'mail_body', 'mail_keys'], 'string'],
            [['is_status', 'is_order'], 'integer'],
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
            'type' => Yii::t('app', 'Type'),
            'subject' => Yii::t('app', 'Subject'),
            'mail_body' => Yii::t('app', 'Mail Body'),
            'mail_keys' => Yii::t('app', 'Mail Keys'),
            'is_status' => Yii::t('app', 'Is Status'),
            'is_order' => Yii::t('app', 'Is Order'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getStatus()
    {
        $str = "Disable";
        if( $this->is_status )
            $str = "Enable";
        return $str;
    }
}
