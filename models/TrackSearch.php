<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Track;

/**
 * TrackSearch represents the model behind the search form about `app\models\Track`.
 */
class TrackSearch extends Track
{
    
    public $customerName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'metro_code'], 'integer'],
            [['ip', 'country_code', 'country_name', 'region_code', 'region_name', 'city', 'zip_code', 'time_zone', 'agent', 'customerName', 'created', 'updated'], 'safe'],
            [['latitude', 'longitude'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Track::find();
        $query->joinWith(['user']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $dataProvider->sort->attributes['customerName'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'metro_code' => $this->metro_code
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'user.username', $this->customerName])
            ->andFilterWhere(['like', 'country_code', $this->country_code])
            ->andFilterWhere(['like', 'country_name', $this->country_name])
            ->andFilterWhere(['like', 'region_code', $this->region_code])
            ->andFilterWhere(['like', 'region_name', $this->region_name])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip_code', $this->zip_code])
            ->andFilterWhere(['like', 'time_zone', $this->time_zone])
            ->andFilterWhere(['like', 'agent', $this->agent]);
            if( $this->created ){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}