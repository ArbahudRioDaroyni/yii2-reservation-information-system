<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "massage_image".
 *
 * @property int $id
 * @property string $path
 * @property int $massage_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Massage $massage
 */
class MassageImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'massage_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'massage_id'], 'required'],
            [['massage_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['path'], 'string', 'max' => 255],
            [['massage_id'], 'exist', 'skipOnError' => true, 'targetClass' => Massage::className(), 'targetAttribute' => ['massage_id' => 'id']],
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
            'massage_id' => 'Massage ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMassage()
    {
        return $this->hasOne(Massage::className(), ['id' => 'massage_id']);
    }

    // $paths[]
    static public function upload($paths, $id)
    {
        if (is_array($paths) || is_object($paths)) {
            foreach ($paths as $path) {
                $model = new MassageImage();
                $model->path = $path;
                $model->massage_id = $id;
                $model->save();
            }
        }
    }
}
