<?php
/**
 * @var $this yii\web\View
 * @var $goodsDataProvider \yii\data\ActiveDataProvider
 * @var $goodSearch \frontend\models\GoodSearch
 */

use yii\helpers\Html;

$this->title = 'Ylab test';
?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $goodsDataProvider,
    'filterModel' => $goodSearch,
    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'label' => 'Товар',
            'value' => function ($model) {
                return Html::a($model->name, ['good/update', 'id' => $model->id]);
            },
        ],
        'price:currency',
        [
            'class' => \common\components\GroupedColumn::class,
            'attribute' => 'category.name',
            'format' => 'raw',
            'label' => 'Категория',
            'grouping' => $goodSearch->isGroupCategory(),
            'filter' => Html::activeDropDownList($goodSearch, 'group', [
                $goodSearch::GROUP_PROVIDER => 'По поставщикам',
                $goodSearch::GROUP_CATEGORY => 'По категориям',
            ], [ 'class' => 'form-control' ]),
            'filterOptions' => [
                'colspan' => 2,
            ],
            'value' => function ($model) {
                return Html::a($model->category->name, ['category/update', 'id' => $model->category->id]);
            },
        ],
        [
            'class' => \common\components\GroupedColumn::class,
            'attribute' => 'provider.name',
            'format' => 'raw',
            'label' => 'Поставщик',
            'grouping' => $goodSearch->isGroupProvider(),
            'filterRender' => false,
            'value' => function ($model) {
                return Html::a($model->provider->name, ['provider/update', 'id' => $model->provider->id]);
            },
        ],
    ],
]);
