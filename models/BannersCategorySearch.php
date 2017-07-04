<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BannersCategory;

/**
 * BannersCategorySearch represents the model behind the search form about `app\models\BannersCategory`.
 */
class BannersCategorySearch extends BannersCategory
{
    public $categoryName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'category_id', 'is_active'], 'integer'],
            [['name', 'position', 'image', 'link', 'created', 'updated', 'categoryName'], 'safe'],
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
        $query = BannersCategory::find();
        $query->joinWith(['category']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,]
            ],
        ]);

        $dataProvider->sort->attributes['categoryName'] = [
            'asc' => ['category.name' => SORT_ASC],
            'desc' => ['category.name' => SORT_DESC],
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
            'category_id' => $this->category_id,
            'is_active' => $this->is_active
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'categories.name', $this->categoryName])
            ->andFilterWhere(['like', 'link', $this->link]);
            if( $this->created ){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
