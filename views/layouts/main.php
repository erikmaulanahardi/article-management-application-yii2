<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);


$isGuest = Yii::$app->user->isGuest;
$isAdmin = !$isGuest && Yii::$app->user->can('Admin');

$navItems = [
    [
        'label' => 'Home',
        'url' => ['/site/index'],
    ],
];

if (!$isGuest) {
    $navItems[] = [
        'label' => 'Postingan',
        'url' => ['/post/index'],
    ];
}

if ($isAdmin) {
    $navItems[] = [
        'label' => 'Akun',
        'url' => ['/account/index'],
    ];
}

// Login atau Logout
if ($isGuest) {
    $navItems[] = [
        'label' => 'Login',
        'url' => ['/site/login'],
    ];
} else {
    $navItems[] = [
        'label' => 'Logout (' .
            Yii::$app->user->identity->username . ')',
        'url' => ['/site/logout'],
        'linkOptions' => [
            'data-method' => 'post',
        ],
    ];
}

?>

<?php $this->beginPage() ?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">

    <?= Html::csrfMetaTags() ?>

    <title>
        <?= Html::encode($this->title) ?>
    </title>

    <?php $this->head() ?>
</head>

<body>

    <?php $this->beginBody() ?>

    <div class="wrap">

        <?php
        NavBar::begin([
            'brandLabel' => 'Perpustakaan Artikel Terbaik Sedunia :)',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top app-navbar',
            ],
        ]);

        echo Nav::widget([
            'options' => [
                'class' => 'navbar-nav navbar-right',
            ],
            'items' => $navItems,
        ]);

        NavBar::end();
        ?>

        <main class="container app-container">

            <?php if (!empty($this->params['breadcrumbs'])): ?>

                <?= Breadcrumbs::widget([
                    'links' => $this->params['breadcrumbs'],
                    'options' => [
                        'class' => 'breadcrumb app-breadcrumb',
                    ],
                ]) ?>

            <?php endif; ?>

            <?= Alert::widget() ?>

            <?= $content ?>

        </main>

    </div>

    <footer class="footer app-footer">

        <div class="container">

            <p>
                &copy; <?= date('Y') ?> My Application.
                All rights reserved.
            </p>

        </div>

    </footer>

    <?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>