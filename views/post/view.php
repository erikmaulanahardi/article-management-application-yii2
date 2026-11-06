
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="article-detail-page">

    <div class="article-detail-top">
        <?= Html::a(
            '← Kembali ke Postingan',
            ['index'],
            ['class' => 'article-back-link']
        ) ?>
    </div>

    <article class="article-detail-card">

        <div class="article-detail-category">
            ARTIKEL
        </div>

        <h1 class="article-detail-title">
            <?= Html::encode($model->title) ?>
        </h1>

        <div class="article-detail-meta">
            <span>
                <strong>Penulis</strong>
                <?= Html::encode($model->username) ?>
            </span>

            <span class="meta-divider">•</span>

            <span>
                <strong>Tanggal</strong>
                <?= Yii::$app->formatter->asDatetime($model->date, 'php:d M Y, H:i') ?>
            </span>
        </div>

        <div class="article-detail-divider"></div>

        <div class="article-detail-content">
            <?= $model->content ?>
        </div>

        <div class="article-detail-footer">
            <div class="article-footer-label">
                Terima kasih sudah membaca! Semoga ilmunya dapet yaaaa.
            </div>

            <div class="article-footer-actions">

                <?php if (Yii::$app->user->can('Author') || Yii::$app->user->can('Admin')): ?>
                    <?= Html::a(
                        'Update Artikel',
                        ['update', 'id' => $model->idpost],
                        ['class' => 'btn-article-update']
                    ) ?>
                <?php endif; ?>

                <?php if (Yii::$app->user->can('Admin')): ?>
                    <?= Html::a(
                        'Delete',
                        ['delete', 'id' => $model->idpost],
                        [
                            'class' => 'btn-article-delete',
                            'data' => [
                                'confirm' => 'Yakin ingin menghapus artikel ini?',
                                'method' => 'post',
                            ],
                        ]
                    ) ?>
                <?php endif; ?>

            </div>
        </div>

    </article>

</div>
