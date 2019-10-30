<?php
namespace common\helpers;

use Yii;
use yii\helpers\Url;

class MyHelper
{
    public function getDateInterval($start_date, $finish_date)
    {
        $d1 = new \DateTime($start_date);
        $d2 = new \DateTime($finish_date);
        $diff = $d2->diff($d1);
        return $diff->d;
    }
    static public function generateLinksDataProvider($dataProvider, $perpage, $page)
    {
        $data = [
            'self' => Url::base() . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id . '?page=' . $page,
            'prev' => Url::base() . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id . '?page=' . (string)($page-1),
            'next' => Url::base() . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id . '?page=' . (string)($page+1),
            'last' => Url::base() . '/' . Yii::$app->controller->id . '/' . Yii::$app->controller->action->id . '?page=' . (string)(ceil($dataProvider->getTotalCount()/$perpage)),
        ];
        return $data;
    }
    static public function generateMetaDataProvider($dataProvider, $perpage)
    {
        $data = [
            'totalCount' => $dataProvider->getTotalCount(),
            'countPerPage' => $dataProvider->getCount(),
            'currentPage' => $dataProvider->pagination->page+1,
            'perPage' => (int)$perpage,
        ];
        return $data;
    }
}
