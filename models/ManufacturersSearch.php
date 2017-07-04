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
use app\models\Manufacturers;

/**
 * ManufacturersSearch represents the model behind the search form about `app\models\Manufacturers`.
 */
class ManufacturersSearch extends Manufacturers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_display'], 'integer'],
            [['name', 'image', 'description', 'created', 'updated'], 'safe'],
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
        $query = Manufacturers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,]
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
            'id' => $this->id,
            'is_display' => $this->is_display
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
              ->andFilterWhere(['like', 'products.image', $this->image]);
        if( $this->created ){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
