<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use PHPUnit\Framework\MockObject\Builder\Identity;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $navItems=[
            ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
        //['label' => Yii::t('app','Status'), 'url' => ['/status/index']],
        //['label' => Yii::t('app','About'), 'url' => ['/site/about']],
        //['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']]
        ];

        if (Yii::$app->user->isGuest) {
            array_push(
                $navItems,
                ['label' => 'Login', 'url' => ['/user/login']],
                ['label' => 'Sign Up', 'url' => ['/user/register']]
            );
        } else {
            if(Yii::$app->user->identity->role == 0){
                array_push(
                $navItems,
                ['label' => 'Status', 'url' => ['/status/index']],
                ['label' => 'Logout (' . Yii::$app->user->identity->username . ', ROLE: ' . Yii::$app->user->Identity->role . ')',
                'url' => ['/user/logout'],
                'linkOptions' => ['data-method' => 'post']]
                );
            }elseif(Yii::$app->user->identity->role == 1){
                array_push(
                $navItems,
                ['label' => 'Status', 'url' => ['/status/index']],
                ['label' => 'Status Log', 'url' => ['/status-log/index']],
                ['label' => 'Logout (' . Yii::$app->user->identity->username . ', ROLE: ' . Yii::$app->user->Identity->role . ')',
                'url' => ['/user/logout'],
                'linkOptions' => ['data-method' => 'post']]
                );
            }
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $navItems,
        ]);
        NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
