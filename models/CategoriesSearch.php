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
use app\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form about `app\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_display', 'is_hot', 'is_order', 'parent_id'], 'integer'],
            [['name', 'image', 'image_hot', 'created', 'updated'], 'safe'],
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
        $query = Categories::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['is_order' => SORT_ASC, 'parent_id' => SORT_ASC]
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
            'id'            => $this->id,
            'is_display'    => $this->is_display,
            'is_hot'        => $this->is_hot,
            'is_order'      => $this->is_order,
            'parent_id'     => $this->parent_id,
            'updated'       => $this->updated
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image_hot', $this->image_hot])
            ->andFilterWhere(['like', 'image', $this->image]);
            if ($this->created){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }
        return $dataProvider;
    }
}
