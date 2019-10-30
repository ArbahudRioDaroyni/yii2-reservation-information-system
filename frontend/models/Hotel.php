<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "hotel".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $hotel_room_type_id
 * @property string $facility
 * @property int $list_calculation_id
 * @property string $term_of_service
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ListCalculation $listCalculation
 * @property HotelRoomType $hotelRoomType
 * @property HotelOrder[] $hotelOrders
 */
class Hotel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'hotel_room_type_id', 'facility', 'list_calculation_id', 'term_of_service'], 'required'],
            [['address', 'facility', 'term_of_service'], 'string'],
            [['hotel_room_type_id', 'list_calculation_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['list_calculation_id'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\models\ListCalculation::className(), 'targetAttribute' => ['list_calculation_id' => 'id']],
            [['hotel_room_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => HotelRoomType::className(), 'targetAttribute' => ['hotel_room_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama',
            'address' => 'Alamat',
            'hotel_room_type_id' => 'Tipe Kamar',
            'facility' => 'Fasilitas',
            'list_calculation_id' => 'Perhitungan',
            'term_of_service' => 'Term Of Service',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getListCalculation()
    {
        return $this->hasOne(ListCalculation::className(), ['id' => 'list_calculation_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelRoomType()
    {
        return $this->hasOne(HotelRoomType::className(), ['id' => 'hotel_room_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelOrders()
    {
        return $this->hasMany(HotelOrder::className(), ['hotel_id' => 'id']);
    }

    static public function getListName()
    {
        return ArrayHelper::map(Hotel::find()->all(), 'id', 'name');
    }
}
