<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Countries;

/**
 * CountriesSearch represents the model behind the search form about `app\models\Countries`.
 */
class CountriesSearch extends Countries
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['countryCode', 'countryName', 'currencyCode', 'population', 'isoNumeric', 'languages', 'isoAlpha3', 'created', 'updated'], 'safe'],
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
        $query = Countries::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'countryCode', $this->countryCode])
            ->andFilterWhere(['like', 'countryName', $this->countryName])
            ->andFilterWhere(['like', 'currencyCode', $this->currencyCode])
            ->andFilterWhere(['like', 'population', $this->population])
            ->andFilterWhere(['like', 'isoNumeric', $this->isoNumeric])
            ->andFilterWhere(['like', 'languages', $this->languages])
            ->andFilterWhere(['like', 'isoAlpha3', $this->isoAlpha3]);
            if( $this->created ){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
