<?php
namespace frontend\controllers;

use Yii;
use frontend\models\GoodSearch;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions(): array
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex(): string
    {
        $goodSearch = new GoodSearch();
        $goodsDataProvider = $goodSearch->search(Yii::$app->request->getQueryParams());

        return $this->render('index', [
            'goodsDataProvider' => $goodsDataProvider,
            'goodSearch' => $goodSearch,
        ]);
    }
}
