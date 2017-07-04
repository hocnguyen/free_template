<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "track".
 *
 * @property integer $id
 * @property string $ip
 * @property integer $user_id
 * @property string $country_code
 * @property string $country_name
 * @property string $region_code
 * @property string $region_name
 * @property string $city
 * @property string $zip_code
 * @property string $time_zone
 * @property double $latitude
 * @property double $longitude
 * @property integer $metro_code
 * @property string $agent
 * @property string $created
 * @property string $updated
 *
 * @property User $user
 */
class Track extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'track';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip'], 'required'],
            [['user_id', 'metro_code'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['created', 'updated'], 'safe'],
            [['ip', 'country_code'], 'string', 'max' => 100],
            [['country_name', 'region_code', 'region_name', 'city', 'zip_code', 'time_zone', 'agent'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'ip' => Yii::t('app', 'Ip'),
            'user_id' => Yii::t('app', 'User ID'),
            'country_code' => Yii::t('app', 'Country Code'),
            'country_name' => Yii::t('app', 'Country Name'),
            'region_code' => Yii::t('app', 'Region Code'),
            'region_name' => Yii::t('app', 'Region Name'),
            'city' => Yii::t('app', 'City'),
            'zip_code' => Yii::t('app', 'Zip Code'),
            'time_zone' => Yii::t('app', 'Time Zone'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'metro_code' => Yii::t('app', 'Metro Code'),
            'agent' => Yii::t('app', 'Agent'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /* Getter for username */
    public function getMemberName() {
        return Html::a( $this->user->username, Yii::$app->params['url_admin'].'/user/view?id='.$this->user->id );
    }

    public function getMapLatitude() {
        return Html::a( $this->latitude, 'https://www.google.com.au/maps/preview/@'.$this->latitude.','.$this->longitude.',8z', ['target' => '_blank'] );
    }

    public function getMapLongitude() {
        return Html::a( $this->longitude, 'https://www.google.com.au/maps/preview/@'.$this->latitude.','.$this->longitude.',8z', ['target' => '_blank'] );
    }

    public function getWikiTimeZone() {
        return Html::a( $this->time_zone, 'https://en.wikipedia.org/wiki/'.$this->time_zone, ['target' => '_blank'] );
    }

}
