<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "hotel_room_type".
 *
 * @property int $id
 * @property string $type
 * @property int $price
 *
 * @property Hotel[] $hotels
 */
class HotelRoomType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_room_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'price'], 'required'],
            [['price'], 'integer'],
            [['type'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Tipe',
            'price' => 'Harga',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotels()
    {
        return $this->hasMany(Hotel::className(), ['room_type_id' => 'id']);
    }

    static public function getListType()
    {
        return ArrayHelper::map(HotelRoomType::find()->all(), 'id', 'type');
    }
}
