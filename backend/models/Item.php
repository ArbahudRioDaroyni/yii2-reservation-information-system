<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "item".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $width
 * @property string $min_tilt
 * @property string $max_tilt
 * @property string $note
 * @property int $status 0=no, 1=yes
 * @property int $item_category_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property ItemCategory $itemCategory
 * @property ItemColor[] $itemColors
 * @property ItemImage[] $itemImages
 * @property ItemReview[] $itemReviews
 */
class Item extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'width', 'min_tilt', 'max_tilt', 'note', 'status', 'item_category_id'], 'required'],
            [['description', 'note'], 'string'],
            [['width', 'status', 'item_category_id'], 'integer'],
            [['min_tilt', 'max_tilt'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategory::className(), 'targetAttribute' => ['item_category_id' => 'id']],
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
            'description' => 'Description',
            'width' => 'Width',
            'min_tilt' => 'Min Tilt',
            'max_tilt' => 'Max Tilt',
            'note' => 'Note',
            'status' => 'Status',
            'item_category_id' => 'Item Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategory::className(), ['id' => 'item_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemColors()
    {
        return $this->hasMany(ItemColor::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemImages()
    {
        return $this->hasMany(ItemImage::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemReviews()
    {
        return $this->hasMany(ItemReview::className(), ['item_id' => 'id']);
    }
}
