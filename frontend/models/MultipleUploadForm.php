<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class MultipleUploadForm extends Model
{
    /**
     * @var UploadedFiles[]
     */
    public $imageFiles;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }
    
    public function upload($name, $folder = 'default')
    {
        if ($this->validate()) {
            $inc = 1;
            $baseDir = '../uploads/image/' . $folder;
            $baseUrl = \yii\helpers\Url::base('http') . '/../uploads/image/' . $folder;
            FileHelper::createDirectory($baseDir);
            if (is_array($this->imageFiles) || is_object($this->imageFiles)) {
                foreach ($this->imageFiles as $file) {
                    $file->saveAs($baseDir . '/' . $name . '-' . $inc . '.' . $file->extension);
                    $path[] = $baseUrl . '/' . $name . '-' . $inc . '.' . $file->extension;
                    $inc++;
                }
            } else {
                $path[0] = $this->imageFiles;
            }
            
            return $path;
        } else {
            return false;
        }
    }
}