<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Good */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelsProvider common\models\Category[] */
/* @var $modelsCategory common\models\Provider[] */
?>

<div class="good-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map($modelsCategory, 'id', 'name')); ?>

    <?= $form->field($model, 'provider_id')->dropDownList(ArrayHelper::map($modelsProvider, 'id', 'name')); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'imageTemp')->fileInput() ?>
    <?php if ($model->getImageUrl()) : ?>
        <?php echo Html::img($model->getImageUrl()); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
