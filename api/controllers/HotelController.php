<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\rest\Serializer;
use frontend\models\Hotel;

class HotelController extends Controller
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
    
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        return true;
    }
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Hotel::find()->select(['id', 'name', 'address', 'hotel_room_type_id']),
            'pagination' => [   
                'pageSize' => 20,
            ],
        ]);

        foreach( $dataProvider->models as $model){
            $images = \frontend\models\HotelImage::find()->where(['hotel_id' => $model->id])->all();
            $inc = 0;
            foreach ($images as $image) {
                $paths[] = $image['path'];
                $inc++;
            }
            $paths = (isset($paths)) ? $paths : NULL ;

            $items[] = [
                'id' => $model->id,
                'name' => $model->name,
                'address' => $model->address,
                'room_type' => $model->hotelRoomType->type,
                'price' => $model->hotelRoomType->price,
                'images' => $paths
            ];
        }

        $serializer = new Serializer();
        $serializer->collectionEnvelope = '_links';
        $data = [
            'items' => $items,
        ];
        $result = \yii\helpers\ArrayHelper::merge($data, $serializer->serialize($dataProvider));

        return $result;
    }
}