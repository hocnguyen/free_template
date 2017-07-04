<?php
/**
 * Created by VinhTQ.
 * User: Designwebvn
 * Date: 1/21/17
 * Time: 8:16 PM
 */
namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "manufacturers".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_display
 * @property string $image 
 * @property string $description 
 * @property string $created
 * @property string $updated
 */
class Manufacturers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manufacturers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'], 
            [['is_display'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['image'], 'string', 'max' => 255],
            ['name', 'unique', 'message' => Yii::t('app', 'That name is already manufacturers.')],
            [['image'], 'file', 'extensions' => 'gif, jpg, png, gif, jpeg, jfif, tiff, bmp, ppm']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'), 
            'description' => Yii::t('app', 'Description'), 
            'is_display' => Yii::t('app', 'Is Display'),
            'created' => Yii::t('app', 'Created'),
            'updated' => Yii::t('app', 'Updated'),
        ];
    }

    public function getDisplay()
    {
        $str = "Disable";
        if( $this->is_display )
            $str = "Enable";
        return $str;
    }

    public function getImageurl()
    {
        if ($this->image) {
            return Html::a( Html::img('/uploads/manufacturers/'.$this->image, ['width'=>'65', 'class'=>'imageresource'] ), [''], ['class'=>'img_src_modal'] );
        }
    }

}
