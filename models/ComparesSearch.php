<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Compares;

/**
 * ComparesSearch represents the model behind the search form about `app\models\Compares`.
 */
class ComparesSearch extends Compares
{
    public $productName, $memberName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'product_id'], 'integer'],
            [['created', 'updated', 'productName', 'memberName'], 'safe'],
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
        $query = Compares::find();
        $query->joinWith(['product','user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ],
        ]);

        $dataProvider->sort->attributes['productName'] = [
            'asc' => ['products.name' => SORT_ASC],
            'desc' => ['products.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['memberName'] = [
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
            'wishlist.id' => $this->id,
            'user_id' => $this->user_id,
            'product_id' => $this->product_id
        ]);

        $query->andFilterWhere(['like', 'products.name', $this->productName])
                ->andFilterWhere(['like', 'user.username', $this->memberName]);
            if( $this->created ){
                $query->andWhere('DATE(wishlist.created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
