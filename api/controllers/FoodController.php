<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\rest\Serializer;
use frontend\models\Food;
use frontend\models\FoodOrder;

class FoodController extends Controller
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
        if (Yii::$app->request->isPost) {
            $model = new FoodOrder;
            $model->food_id = Yii::$app->request->post('food_id');
            $model->total_calculation = Yii::$app->request->post('total_calculation');
            $model->name = Yii::$app->request->post('name');
            $model->delivery_address = Yii::$app->request->post('delivery_address');
            $model->phone_number = Yii::$app->request->post('phone_number');
            $model->customer_profile_id = Yii::$app->request->post('customer_profile_id');
            
            return $model->apiOrder($model);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Food::find()->select(['id', 'name', 'price']),
            'pagination' => [   
                'pageSize' => 20,
            ],
        ]);

        foreach( $dataProvider->models as $model){
            $images = \frontend\models\FoodImage::find()->where(['food_id' => $model->id])->all();
            $inc = 0;
            foreach ($images as $image) {
                $paths[] = $image['path'];
                $inc++;
            }
            $paths = (isset($paths)) ? $paths : NULL ;

            $items[] = [
                'id' => $model->id,
                'name' => $model->name,
                'price' => $model->price,
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