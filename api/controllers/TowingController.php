<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\rest\Serializer;
use frontend\models\Towing;
use frontend\models\TowingOrder;
use yii\filters\VerbFilter;

class TowingController extends Controller
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
    
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
        return true;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'index' => ['GET', 'POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        if (Yii::$app->request->isPost) {
            $model = new TowingOrder;
            $model->towing_id = Yii::$app->request->post('towing_id');
            $model->name = Yii::$app->request->post('name');
            $model->phone_number = Yii::$app->request->post('phone_number');
            $model->pickup = Yii::$app->request->post('pickup');
            $model->destination = Yii::$app->request->post('destination');
            $model->note = Yii::$app->request->post('note');
            $model->start_at = Yii::$app->request->post('start_at');
            $model->customer_profile_id = Yii::$app->request->post('customer_profile_id');

            return $model->apiOrder($model);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Towing::find()->select(['id', 'list_vehicle_type_id', 'price']),
            'pagination' => [   
                'pageSize' => 20,
            ],
        ]);

        foreach( $dataProvider->models as $model){
            $items[] = [
                'id' => $model->id,
                'type' => $model->listVehicleType->name,
                'price' => $model->price,
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