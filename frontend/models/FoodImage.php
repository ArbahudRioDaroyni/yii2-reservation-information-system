<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "food_image".
 *
 * @property int $id
 * @property string $path
 * @property int $food_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Food $food
 */
class FoodImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'food_id'], 'required'],
            [['food_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
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
            'food_id' => 'Food ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    // $paths[]
    static public function upload($paths, $id)
    {
        if (is_array($paths) || is_object($paths)) {
            foreach ($paths as $path) {
                $model = new FoodImage();
                $model->path = $path;
                $model->food_id = $id;
                $model->save();
            }
        }
    }
}
