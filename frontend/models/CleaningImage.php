<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "cleaning_image".
 *
 * @property int $id
 * @property string $path
 * @property int $cleaning_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cleaning $cleaning
 */
class CleaningImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cleaning_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'cleaning_id'], 'required'],
            [['cleaning_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['cleaning_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cleaning::className(), 'targetAttribute' => ['cleaning_id' => 'id']],
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
            'cleaning_id' => 'Cleaning ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCleaning()
    {
        return $this->hasOne(Cleaning::className(), ['id' => 'cleaning_id']);
    }

    // $paths[]
    static public function upload($paths, $id)
    {
        if (is_array($paths) || is_object($paths)) {
            foreach ($paths as $path) {
                $model = new CleaningImage();
                $model->path = $path;
                $model->cleaning_id = $id;
                $model->save();
            }
        }
    }
}
