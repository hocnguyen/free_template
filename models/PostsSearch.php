<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Posts;

/**
 * PostsSearch represents the model behind the search form about `app\models\Posts`.
 */
class PostsSearch extends Posts
{
    
    public $categoryName, $tagName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_comment', 'is_status', 'user_id'], 'integer'],
            [['title', 'image', 'description', 'content', 'web_url', 'created', 'updated', 'categoryName', 'tagName'], 'safe'],
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
        $query = Posts::find();
        $query->joinWith(['postCates.catePost', 'postTags.tagPost']);
        $query->groupBy('posts.id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC,]
            ],
        ]);

        $dataProvider->sort->attributes['categoryName'] = [
            'asc' => ['category_post.name' => SORT_ASC],
            'desc' => ['category_post.name' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['tagName'] = [
            'asc' => ['tags_post.name' => SORT_ASC],
            'desc' => ['tags_post.name' => SORT_DESC],
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
            'is_comment' => $this->is_comment,
            'is_status' => $this->is_status,
            'user_id' => $this->user_id,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'web_url', $this->web_url])
            ->andFilterWhere(['like', 'category_post.name', $this->categoryName])
            ->andFilterWhere(['like', 'tags_post.name', $this->tagName]);
             if( $this->created ){
                $query->andWhere('DATE(created) = "'.date('Y-m-d', strtotime($this->created)).'"' );
            }

        return $dataProvider;
    }
}
