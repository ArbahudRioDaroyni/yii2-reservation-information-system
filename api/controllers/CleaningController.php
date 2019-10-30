<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\rest\Serializer;
use frontend\models\Cleaning;
use frontend\models\CleaningOrder;
use yii\filters\VerbFilter;

class CleaningController extends Controller
{
    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
    
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    
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
            $model = new CleaningOrder;
            $model->cleaning_id = Yii::$app->request->post('cleaning_id');
            $model->name = Yii::$app->request->post('name');
            $model->address = Yii::$app->request->post('address');
            $model->phone_number = Yii::$app->request->post('phone_number');
            $model->note = Yii::$app->request->post('note');
            $model->start_at = Yii::$app->request->post('start_at');
            $model->customer_profile_id = Yii::$app->request->post('customer_profile_id');

            return $model->apiOrder($model);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => Cleaning::find()->select(['id', 'type', 'price']),
            'pagination' => [   
                'pageSize' => 20,
            ],
        ]);

        foreach( $dataProvider->models as $model){
            $images = \frontend\models\CleaningImage::find()->where(['cleaning_id' => $model->id])->all();
            $inc = 0;
            foreach ($images as $image) {
                $paths[] = $image['path'];
                $inc++;
            }
            $paths = (isset($paths)) ? $paths : NULL ;

            $items[] = [
                'id' => $model->id,
                'type' => $model->type,
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