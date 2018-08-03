<?php
/**
 * @var $this \yii\web\View
 * @var $content string
 */

use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>
    <header class="navbar navbar-default">
        <div class="container">
            <?= Html::a('Главная', '/', ['class' => 'navbar-brand']); ?>

            <?= \yii\widgets\Menu::widget([
                'options' => [
                    'class' => 'nav navbar-nav navbar-right',
                ],
                'items' => [
                    [
                        'label' => 'Категории',
                        'url' => [ 'category/index' ],
                    ],
                    [
                        'label' => 'Поставщики',
                        'url' => [ 'provider/index' ],
                    ],
                    [
                        'label' => 'Товары',
                        'url' => [ 'good/index' ],
                    ],
                ],
            ]); ?>
        </div>
    </header>
    <main class="container">
        <?= $content; ?>
    </main>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
