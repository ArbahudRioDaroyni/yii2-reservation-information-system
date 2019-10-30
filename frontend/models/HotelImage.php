<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "hotel_image".
 *
 * @property int $id
 * @property string $path
 * @property int $hotel_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Hotel $hotel
 */
class HotelImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotel_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_id'], 'required'],
            [['hotel_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotel::className(), 'targetAttribute' => ['hotel_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'hotel_id' => 'Hotel ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotel()
    {
        return $this->hasOne(Hotel::className(), ['id' => 'hotel_id']);
    }

    // $paths[]
    static public function upload($paths, $id)
    {
        if (is_array($paths) || is_object($paths)) {
            foreach ($paths as $path) {
                $model = new HotelImage();
                $model->path = $path;
                $model->hotel_id = $id;
                $model->save();
            }
        }
    }
}
