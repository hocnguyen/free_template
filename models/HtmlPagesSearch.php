<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\HtmlPages;

/**
 * HtmlPagesSearch represents the model behind the search form about `app\models\HtmlPages`.
 */
class HtmlPagesSearch extends HtmlPages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_status'], 'integer'],
            [['pagecode', 'page_title', 'page_text', 'created', 'updated'], 'safe'],
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
        $query = HtmlPages::find();

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
            'is_status' => $this->is_status,
        ]);

        $query->andFilterWhere(['like', 'pagecode', $this->pagecode])
            ->andFilterWhere(['like', 'page_title', $this->page_title])
            ->andFilterWhere(['like', 'page_text', $this->page_text]);
             if ($this->created){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
