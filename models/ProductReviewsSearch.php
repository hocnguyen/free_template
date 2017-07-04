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
use app\models\ProductReviews;

/**
 * ProductReviewsSearch represents the model behind the search form about `app\models\ProductReviews`.
 */
class ProductReviewsSearch extends ProductReviews
{
    
    public $productName, $memberName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'member_id', 'product_id', 'rate', 'is_display'], 'integer'],
            [['comment', 'created', 'updated', 'productName', 'memberName'], 'safe'],
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
        $query = ProductReviews::find();
        $query->joinWith(['product','user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,]
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
            'product_reviews.id' => $this->id,
            'member_id' => $this->member_id,
            'product_id' => $this->product_id,
            'rate' => $this->rate,
            'product_reviews.is_display' => $this->is_display
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment])
        ->andFilterWhere(['like', 'products.name', $this->productName])
        ->andFilterWhere(['like', 'user.username', $this->memberName]);
        if( $this->created ){
                $query->andWhere('DATE(product_reviews.created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
        }
        return $dataProvider;
    }
}
