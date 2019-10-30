<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "food".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $list_calculation_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property FoodImage[] $foodImages
 * @property FoodOrder[] $foodOrders
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'list_calculation_id'], 'required'],
            [['price', 'list_calculation_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'list_calculation_id' => 'List Calculation ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoodImages()
    {
        return $this->hasMany(FoodImage::className(), ['food_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFoodOrders()
    {
        return $this->hasMany(FoodOrder::className(), ['food_id' => 'id']);
    }

    static public function getListName()
    {
        return ArrayHelper::map(Food::find()->all(), 'id', 'name');
    }
}
