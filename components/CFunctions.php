<?php
namespace app\components;

use Yii;
use yii\base\Component;
use Yii\db\Command;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\Html;

class CFunctions extends Component{
    public function init()
    {

    }
    /**
     * Make an SEO title for use in the URL
     *
     * @access	public
     * @param	string		Raw SEO title or text
     * @return	string		Cleaned up SEO title
     */
    public static function makeAlias( $text )
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
      // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        {
            return 'n-a';
        }
        return $text;
    }

    public static function limitStr($string, $limit=50, $ext =''){
        if(strlen($string) > $limit)
            $string = substr($string, 0, $limit).$ext;
        return $string;

    }

    public static function addClassMenuCatalog( $menu ){
        if ($menu == 'products' || $menu == 'categories' || $menu == 'productreviews' || $menu == 'manufacturers' || $menu == 'tags' || $menu == 'wishlist' || $menu == 'compares')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuCustomers( $menu, $str = "" ){
        if ($str == "index" && $menu == 'user' || $menu == "bestcustomers" || $menu == "bestcustomerspending")
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuProfile( $menu, $str = "" ){
        if ($str == "admin" && $menu == 'user' || $str == "changepass" && $menu == 'user')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuOrders( $menu ){
        if ($menu == 'orders' || $menu == 'orderstatus')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuStatistics( $menu ){
        if ($menu == 'statsproducts' || $menu == 'bestcustomer' || $menu == 'statsbydate')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuPosts( $menu ){
        if ($menu == 'posts' || $menu == 'categorypost' || $menu == 'tagspost' || $menu == 'htmlpages')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuPromotions( $menu ){
        if ($menu == 'affiliates' || $menu == 'campaigns')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuConfiguration( $menu ){
        if ($menu == 'paymentmethods' || $menu == 'slidershow'|| $menu == 'newsletter' || $menu == 'countries' || $menu == 'languages' || $menu == 'mail' || $menu == 'socials' || $menu == 'banners' || $menu == 'widgets' || $menu == 'bannerscategory')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function addClassMenuSystem( $menu ){
        if ($menu == 'track' || $menu == 'systeminformation')
            echo Yii::$app->params['open_side_menu'];
    }

    public static function getLanguagesWeb(){
        $data = new SqlDataProvider([
            'sql'=> "SELECT languages.languageculture FROM languages WHERE is_active = ".Yii::$app->params['status_active']
        ]);
        $languages= $data->getModels();
        return isset($languages[0]['languageculture'])?$languages[0]['languageculture']:'en';
    }

    public static function getLanguagesAll(){
        return \app\models\Languages::find()->where('is_display =:is_dispaly ORDER BY id',[':is_dispaly'=>Yii::$app->params['status_active']])->all();
    }

    public static function getLanguagesActive($lc){
        return \app\models\Languages::find()->where('is_display =:is_display AND languageculture =:languageculture ORDER BY id',[':is_display'=>Yii::$app->params['status_active'], ':languageculture' =>$lc ])->one();
    }

    public static function getSliderShow(){
        return \app\models\Slidershow::find()->where('1 ORDER BY rank')->all();
    }

    public static function getSocials(){
        return \app\models\Socials::find()->where('is_display =:is_display ORDER BY id ASC',[':is_display'=>Yii::$app->params['status_active']])->all();
    }

    public static function isValidEmail($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function getMenuCateogry() {
        return \app\models\Categories::find()->where('parent_id =:parent_id AND is_display =:is_display ORDER BY is_order ASC', [':parent_id' => 0,':is_display'=>Yii::$app->params['status_active']])->all();
    }

    public static function getMenuSubCategory($cate_id) {
        return \app\models\Categories::find()->where('parent_id =:parent_id AND is_display =:is_display ORDER BY is_order DESC', [':parent_id' => $cate_id,':is_display'=>Yii::$app->params['status_active']])->all();
    }

    public static function formatPrice($price, $str = "$") {
        return $str.number_format((float)$price, 2, '.', ',');
    } 

    public static function getProductsByBrand($id, $option = 0){
        $data = new SqlDataProvider([
            'sql'=> "SELECT products.* FROM products 
                    INNER JOIN product_manufacturers 
                    ON products.`id` = product_manufacturers.`product_id` 
                    INNER JOIN manufacturers 
                    ON product_manufacturers.`manufacturers_id` = manufacturers.`id`
                    WHERE products.`is_status` = ".Yii::$app->params['status_active']." AND manufacturers.`id` =".$id
                    ]);
        if( $option == 0 )
            return $data->getModels();
        else
            return $data->getCount();
    }

    public static function getSubCategory($id){
        return \app\models\Categories::find()->where('is_display =:is_display AND parent_id =:parent_id ORDER BY id DESC LIMIT 4',[':is_display'=>Yii::$app->params['status_active'], ':parent_id' => $id])->all();
    }

    public static function getProductCategories($id){
        $cat = \app\models\ProductCategories::find()->where('product_id =:product_id',[':product_id'=>intval($id)])->all();
        $listCat ="";
        $ext     =", ";
        foreach($cat as $key=>$catNews){
            $categoryn_data = \app\models\Categories::findOne($catNews['category_id']);
            $listCat        .= Html::a( $categoryn_data->name, '/category/'.$categoryn_data->id.'-'.Yii::$app->func->makeAlias($categoryn_data->name) );
            if ($key != (count($cat) -1))
                $listCat .= $ext;
        }
        return $listCat;
    }

    public static function getProductsByBrandIndex($id){
        $data = new SqlDataProvider([
            'sql'=> "SELECT products.* FROM products 
                    INNER JOIN product_manufacturers 
                    ON products.`id` = product_manufacturers.`product_id` 
                    INNER JOIN manufacturers 
                    ON product_manufacturers.`manufacturers_id` = manufacturers.`id`
                    WHERE products.`is_status` = ".Yii::$app->params['status_active']." AND manufacturers.`id` =".$id." ORDER BY products.id DESC LIMIT 4", 
             'pagination' => false      
                    ]);    
            return $data->getModels();
    }

    public static function getProductBrand($id){
        $cat = \app\models\ProductManufacturers::find()->where('product_id =:product_id',[':product_id'=>intval($id)])->all();
        $listCat ="";
        $ext     =", ";
        foreach($cat as $key=>$catNews){
            $categoryn_data = \app\models\Manufacturers::findOne($catNews['manufacturers_id']);
            $listCat        .= Html::a( $categoryn_data->name, '/brand/'.$categoryn_data->id.'-'.Yii::$app->func->makeAlias($categoryn_data->name) );
            if ($key != (count($cat) -1))
                $listCat .= $ext;
        }
        return $listCat;
    }

    public static function getProductTags($id){
        $cat = \app\models\ProductTags::find()->where('product_id =:product_id',[':product_id'=>intval($id)])->all();
        $listCat ="";
        $ext     =", ";
        foreach($cat as $key=>$catNews){
            $categoryn_data = \app\models\Tags::findOne($catNews['tag_id']);
            $listCat        .= Html::a( $categoryn_data->name, '/tags/'.$categoryn_data->id.'-'.Yii::$app->func->makeAlias($categoryn_data->name) );
            if ($key != (count($cat) -1))
                $listCat .= $ext;
        }
        return $listCat;
    }

    public static function getTags(){
        $data = new SqlDataProvider([
                'sql'=> "SELECT tags.* FROM products
                              INNER JOIN product_tags
                              ON products.`id` = product_tags.`product_id`
                              INNER JOIN tags
                              ON product_tags.`tag_id` = tags.`id`
                              WHERE products.`is_status` = ".Yii::$app->params['status_active']." 
                              GROUP BY tags.`id`"
                    ]);
        return $data->getModels();
    }

    public static function getRelateProducts($id) {
        $cat        = \app\models\ProductCategories::find()->where('product_id =:product_id',[':product_id'=>intval($id)])->all();
        $listCat ="";
        $ext     =",";
        foreach($cat as $key=>$catNews){
            $listCat     .= $catNews['category_id'];
            if ($key != (count($cat) -1))
                $listCat .= $ext;    
        } 
        if ($listCat == "")
            $listCat = 0;

        $data = new SqlDataProvider([
                'sql'=> "SELECT products.* FROM products
                              INNER JOIN product_categories
                              ON products.`id` = product_categories.`product_id`
                              WHERE products.`is_status` = ".Yii::$app->params['status_active']." AND products.id != ".intval($id)." AND product_categories.category_id IN (".$listCat.")   
                              GROUP BY products.`id` ORDER BY products.id DESC" 
        ]);
        return $data->getModels();
    }

     public static function getAlsoLikeProducts($id) {
        $ext     =",";
        //Wishlist
        $cat        = \app\models\Wishlist::find()->where('user_id =:user_id',[':user_id'=>intval(Yii::$app->user->id)])->all();
        $listCat ="";
        foreach($cat as $key=>$catNews){
            $listCat     .= $catNews['product_id'];
            if ($key != (count($cat) -1))
                $listCat .= $ext;    
        } 
        if ($listCat == "")
            $listCat = 0;
        //Brand
        $brand        = \app\models\ProductManufacturers::find()->where('product_id =:product_id',[':product_id'=>intval($id)])->all();
        $listBrand ="";
        foreach($brand as $key=>$catBrand){
            $listBrand     .= $catBrand['manufacturers_id'];
            if ($key != (count($brand) -1))
                $listBrand .= $ext;    
        } 
        if ($listBrand == "")
            $listBrand = 0;
        //Tags
        $tags        = \app\models\ProductTags::find()->where('product_id =:product_id',[':product_id'=>intval($id)])->all();
        $listTags ="";
        foreach($tags as $key=>$catTag){
            $listTags     .= $catTag['tag_id'];
            if ($key != (count($tags) -1))
                $listTags .= $ext;    
        } 
        if ($listTags == "")
            $listTags = 0;


        $data = new SqlDataProvider([
                'sql'=> "SELECT products.* FROM products
                              INNER JOIN product_manufacturers
                              ON products.`id` = product_manufacturers.`product_id`
                              INNER JOIN product_tags
                              ON products.`id` = product_tags.`product_id`
                              WHERE products.`is_status` = ".Yii::$app->params['status_active']." AND products.id != ".intval($id)." AND (products.id IN (".$listCat.") OR product_manufacturers.manufacturers_id IN (".$listBrand.") OR product_tags.tag_id IN (".$listTags.") ) 
                              GROUP BY products.`id` ORDER BY products.id DESC" 
        ]);
        return $data->getModels();
    }

    public static function getBrands() {
        $data = new SqlDataProvider([
                'sql'=> "SELECT manufacturers.* FROM products
                              INNER JOIN product_manufacturers
                              ON products.`id` = product_manufacturers.`product_id`
                              INNER JOIN manufacturers
                              ON product_manufacturers.`manufacturers_id` = manufacturers.`id`
                              WHERE products.`is_status` = ".Yii::$app->params['status_active']." 
                              GROUP BY manufacturers.`id`"
                    ]);
        return $data->getModels();
    }

    public static function totalProductsByCategory($id) {
        return yii::$app->db->createCommand('SELECT COUNT(*) FROM (SELECT products.id FROM products
                              INNER JOIN product_categories
                              ON products.`id` = product_categories.`product_id`
                              INNER JOIN categories
                              ON product_categories.`category_id` = categories.`id`
                              WHERE (categories.`id` = '.intval($id).' OR categories.`parent_id` ='.intval($id).') GROUP BY products.`id`) AS product')->queryScalar();
    }

    public static function getBanners() {
        return \app\models\Banners::find()->where('position =:position AND is_active =:is_active  ORDER BY is_order ASC LIMIT 2', [':position' => 2, ':is_active'=>Yii::$app->params['status_active']])->all();
    }

    public static function getPaymentMethod() {
        return \app\models\PaymentMethods::find()->where('is_active =:is_active', [':is_active'=>Yii::$app->params['status_active']])->all();
    }

    public static function getWidgets($title) {
        return \app\models\Widgets::find()->where('title =:title AND is_active =:is_active', [':is_active'=>Yii::$app->params['status_active'], ':title' => $title])->one();
    }

    public static function getTagPost(){
        $data = new SqlDataProvider([
                'sql'=> "SELECT tags_post.* FROM posts
                              INNER JOIN post_tag
                              ON posts.`id` = post_tag.`post_id`
                              INNER JOIN tags_post
                              ON post_tag.`tag_post_id` = tags_post.`id`
                              WHERE posts.`is_status` = ".Yii::$app->params['status_active']." 
                              GROUP BY tags_post.`id`"
                    ]);
        return $data->getModels();
    }

    public static function getUser($id){
        return \app\models\User::findOne($id);
    }

    public static function getCategories($id){
        $cat = \app\models\PostCate::find()->where('post_id =:post_id',[':post_id'=>$id])->all();
        $listCat ="";
        $ext     =", ";
        foreach($cat as $key=>$catNews){
            $categoryn_data = \app\models\CategoryPost::findOne($catNews['cate_post_id']);
            $listCat        .= Html::a( $categoryn_data->name, '/cate/'.$categoryn_data->id.'-'.Yii::$app->func->makeAlias($categoryn_data->name) );
            if ($key != (count($cat) -1))
                $listCat .= $ext;
        }
        return $listCat;
    }

    public static function getAllCategories() {
        return \app\models\CategoryPost::find()->where('is_status=:is_status', [':is_status' => Yii::$app->params['status_active']])->all();
    }

    public static function getPopularPost() {
        return \app\models\Posts::find()->where('is_status =:is_status ORDER BY `id` DESC LIMIT 5', [':is_status'=>Yii::$app->params['status_active']])->all();
    }

    public function getTagsByPost($id){
        error_reporting(0);
        $cat                = \app\models\PostTag::find()->where('post_id =:post_id',[':post_id'=>$id])->all();
        $listTagsPost       = "";
        $ext                =", ";
        foreach($cat as $key => $catNews){
            $categoryn_data = \app\models\TagsPost::findOne($catNews['tag_post_id']);
            $listTagsPost   .= Html::a( $categoryn_data->name, '/news/tags/'.$categoryn_data->id.'-'.\Yii::$app->func->makeAlias($categoryn_data->name) );
            if ($key != (count($cat) -1))
                $listTagsPost .= $ext;
        }
        return $listTagsPost;
    }

    public static function getPostRelateByCategories($id){
        $cat = \app\models\PostCate::find()->where('post_id =:post_id',[':post_id'=>$id])->all();
        $listCat    = "";
        $ext        = ", ";
        foreach($cat as $key=>$catNews){
            $listCat        .= $catNews['cate_post_id'];
            if ($key != (count($cat) -1))
                $listCat .= $ext;
        }
        $listCate   = $listCat != ""?$listCat:0;

        $cats_id    = \app\models\PostCate::find()->where('cate_post_id IN ('.$listCate.') GROUP BY post_id')->all();
        $listPostId = "";
        foreach($cats_id as $k=>$v){
            $listPostId  .= $v['post_id'];
            if ($k != (count($cats_id) -1))
                $listPostId .= $ext;
        }
        return $listPostId != ""?$listPostId:0;
    }

    public static function setActiveMainMenu($key, $str ='')
    {
        if ($key=='' && $str == 'index')
            $key = 'index';
        else if ($key == 'bestselling' && $str == 'index')
            $key = 'bestselling';
        else if ($key == 'products' && $key == 'product')
            $key = 'products';
        else if ($key == 'contact.html' && $str == 'contact')
            $key = 'contact';
        else if ($key=='blog' && $str == 'index')
            $key = 'blog';
        return $key;
    }

    public static function getHtmlPage ($alias) {
        $html_page = \app\models\HtmlPages::find()->where('pagecode =:pagecode AND is_status =:is_status',[':pagecode'=>$alias, ':is_status' => Yii::$app->params['status_active']])->one();
        if ($html_page) {
            return $html_page->page_text;
        }
    }

    public static function getStatsRate ($id) {
        $stats_rate = new SqlDataProvider([
                'sql'=> "SELECT SUM(rate) AS sum_rate, COUNT(id) AS count_rate FROM product_reviews WHERE product_id = ".intval($id)
                    ]);
        $st         = $stats_rate->getModels();
        $stat       = ($st[0]['sum_rate'] != 0)?$st[0]['sum_rate']/$st[0]['count_rate']:0;
        return  $stat;
    }

    public static function getCountRate ($id) {
        return \app\models\ProductReviews::find()->where('product_id =:product_id AND is_display =:is_display  ORDER BY id DESC',[':product_id'=>intval($id), ':is_display' => Yii::$app->params['status_active']])->count();
    }

    public static function checkIncludeScript($str, $sub) {
        $check = true;
        if (($str == 'orders' && $sub == "index") || ($str == 'feedback' && $sub == "index")) {
            $check = false;
        }
        return $check;
    }

    public static function listProductIdByCustomer($id) {
        return yii::$app->db->createCommand('SELECT order_items.`product_id` FROM `user` 
                                        INNER JOIN orders ON `user`.id = orders.`user_id` 
                                        INNER JOIN order_items ON orders.id = order_items.`order_id` 
                                        WHERE `user`.id = '.intval($id).' AND orders.`status_id` = 2')->queryColumn();
    }

    public static function getTotalMoneyOrders() {
        return Yii::$app->db->createCommand("SELECT SUM(amount) FROM orders")->queryScalar();     
    }

    public static function getTotalMoneyApproved() {
        return Yii::$app->db->createCommand("SELECT SUM(amount) FROM orders WHERE orders.`status_id` = 2")->queryScalar();     
    }

    public static function getTotalMoneyPending() {
        return Yii::$app->db->createCommand("SELECT SUM(amount) FROM orders WHERE orders.`status_id` != 2")->queryScalar();     
    }

    public static function getBestSellingProducts() {
       $data = new ActiveDataProvider(
            [
                'query' => \app\models\Products::find()->where('is_status =:is_status ORDER BY `id` DESC LIMIT 10', [':is_status'=>Yii::$app->params['status_active']]),
                'pagination' => false,
            ]);
        return $data->getModels();
    }

    public static function getSubCategoriesHaveProducts($id) {
        $data =  new SqlDataProvider([
                'sql'=> "SELECT categories.id, categories.name, COUNT(product_categories.`product_id`) AS qty 
                            FROM categories 
                            INNER JOIN product_categories ON categories.id = product_categories.`category_id` 
                            WHERE parent_id = ".$id." 
                            GROUP BY categories.id
                            ORDER BY qty DESC LIMIT 4",
                'pagination' => false  
            ]);
        return $data->getModels();
    }

    public static function getProductsbyCategoryIndex($id) {
        $products   = new SqlDataProvider([
                    'sql' => 'SELECT products.* FROM products
                              INNER JOIN product_categories
                              ON products.`id` = product_categories.`product_id`
                              INNER JOIN categories
                              ON product_categories.`category_id` = categories.`id`
                              WHERE categories.`id` = '.intval($id).' OR categories.`parent_id` = '.intval($id).' GROUP BY products.`id` ORDER BY products.id DESC',
                    'pagination' => false
        ]); 
        return $products->getModels();
    }

    public static function getBannersCategory($id, $position) {
        return \app\models\BannersCategory::find()->where('category_id =:category_id AND is_active =:is_active AND position =:position',[':category_id'=>intval($id), ':is_active' => Yii::$app->params['status_active'], ':position' => intval($position)])->all();

    }

}