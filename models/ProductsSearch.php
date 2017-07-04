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
use app\models\Products;

/**
 * ProductsSearch represents the model behind the search form about `app\models\Products`.
 */
class ProductsSearch extends Products
{
    
    public $categoryName, $tagName, $manufacturerName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_status', 'is_wishlist', 'created_by', 'updated_by'], 'integer'],
            [['name', 'sku', 'image', 'short_description', 'full_dsscription', 'created', 'updated', 'categoryName', 'tagName', 'manufacturerName'], 'safe'],
            [['price', 'special_price'], 'number'],
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
        $query = Products::find();
        $query->joinWith(['productCategories.category', 'productTags.tag', 'productManufacturers.manufacturer']);
        $query->groupBy('products.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,]
            ],
        ]);

        $dataProvider->sort->attributes['categoryName'] = [
            'asc' => ['categories.name' => SORT_ASC],
            'desc' => ['categories.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tagName'] = [
            'asc' => ['tags.name' => SORT_ASC],
            'desc' => ['tags.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['manufacturerName'] = [
            'asc' => ['manufacturers.name' => SORT_ASC],
            'desc' => ['manufacturers.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'products.id' => $this->id,
            'price' => $this->price,
            'special_price' => $this->special_price,
            'products.is_status' => $this->is_status,
            'is_wishlist' => $this->is_wishlist,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'products.name', $this->name])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'products.image', $this->image])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'full_dsscription', $this->full_dsscription])
            ->andFilterWhere(['like', 'categories.name', $this->categoryName])
            ->andFilterWhere(['like', 'manufacturers.name', $this->manufacturerName])
            ->andFilterWhere(['like', 'tags.name', $this->tagName]);
            if( $this->created ){
                $query->andWhere('DATE(products.created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }
            
        return $dataProvider;
    }
}
