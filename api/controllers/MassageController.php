<?php

namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\rest\Serializer;
use frontend\models\Massage;
use frontend\models\MassageOrder;
use yii\filters\VerbFilter;

class MassageController extends Controller
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
            $model = new MassageOrder;
            $model->massage_id = Yii::$app->request->post('massage_id');
            $model->name = Yii::$app->request->post('name');
            $model->address = Yii::$app->request->post('address');
            $model->phone_number = Yii::$app->request->post('phone_number');
            $model->email = Yii::$app->request->post('email');
            $model->start_at = Yii::$app->request->post('start_at');
            $model->customer_profile_id = Yii::$app->request->post('customer_profile_id');
            
            return $model->apiOrder($model);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Massage::find()->select(['id', 'name', 'price', 'description']),
            'pagination' => [   
                'pageSize' => 20,
            ],
        ]);

        foreach( $dataProvider->models as $model){
            $images = \frontend\models\MassageImage::find()->where(['massage_id' => $model->id])->all();
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
                'description' => $model->description,
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