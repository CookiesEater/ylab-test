<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Good */
/* @var $modelsProvider common\models\Category[] */
/* @var $modelsCategory common\models\Provider[] */

$this->title = 'Обновить товар: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="good-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsProvider' => $modelsProvider,
        'modelsCategory' => $modelsCategory,
    ]) ?>

</div>
