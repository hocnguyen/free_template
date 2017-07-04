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
 * This is the model class for table "countries".
 *
 * @property integer $id
 * @property string $countryCode
 * @property string $countryName
 * @property string $currencyCode
 * @property string $population
 * @property string $isoNumeric
 * @property string $languages
 * @property string $isoAlpha3
 * @property string $created
 * @property string $updated
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryCode', 'countryName'], 'required'],
            [['created', 'updated'], 'safe'],
            [['countryCode'], 'string', 'max' => 2],
            [['countryName'], 'string', 'max' => 45],
            [['currencyCode', 'isoAlpha3'], 'string', 'max' => 3],
            [['population'], 'string', 'max' => 20],
            [['isoNumeric'], 'string', 'max' => 4],
            [['languages'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'countryCode' => Yii::t('app', 'Country Code'),
            'countryName' => Yii::t('app', 'Country Name'),
            'currencyCode' => Yii::t('app', 'Currency Code'),
            'population' => Yii::t('app', 'Population'),
            'isoNumeric' => Yii::t('app', 'Iso Numeric'),
            'languages' => Yii::t('app', 'Languages'),
            'isoAlpha3' => Yii::t('app', 'Iso Alpha3'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }
}
