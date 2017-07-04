<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `app\models\Orders`.
 */
class OrdersSearch extends Orders
{
    
    public $customerName, $productName, $quantity, $unitPrice;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'status_id', 'is_download', 'type', 'id_read'], 'integer'],
            [['transaction_id', 'data_orders', 'sesssion_customer', 'created', 'updated', 'customerName', 'productName', 'quantity', 'unitPrice'], 'safe'],
            [['amount'], 'number'],
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
        $query = Orders::find();
        $query->joinWith(['orderItems.product','user']);
        $query->groupBy('orders.id');
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

        $dataProvider->sort->attributes['customerName'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['quantity'] = [
            'asc'  => ['order_items.qty' => SORT_ASC],
            'desc' => ['order_items.qty' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['unitPrice'] = [
            'asc'  => ['order_items.unit_price' => SORT_ASC],
            'desc' => ['order_items.unit_price' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'orders.id' => $this->id,
            'user_id' => $this->user_id,
            'amount' => $this->amount,
            'status_id' => $this->status_id,
            'is_download' => $this->is_download,
            'type' => $this->type,
            'orders.id_read' => $this->id_read
        ]);

        $query->andFilterWhere(['like', 'transaction_id', $this->transaction_id])
            ->andFilterWhere(['like', 'data_orders', $this->data_orders])
            ->andFilterWhere(['like', 'user.username', $this->customerName])
            ->andFilterWhere(['like', 'products.name', $this->productName])
            ->andFilterWhere(['like', 'order_items.qty', $this->quantity])
            ->andFilterWhere(['like', 'order_items.unit_price', $this->unitPrice])
            ->andFilterWhere(['like', 'sesssion_customer', $this->sesssion_customer]);
             if( $this->created ){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
