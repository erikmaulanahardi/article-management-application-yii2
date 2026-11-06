
<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $data app\models\Post[] */

$this->title = 'Home';
?>

<div class="site-index">

    <div class="home-header">
        <span class="home-label">KUMPULAN ARTIKEL</span>
        <h1>Artikel Terbaru</h1>
        <p>Temukan artikel terbaru dari kami.</p>
    </div>

    <div class="article-list">

        <?php if (!empty($data)): ?>

            <?php foreach ($data as $row): ?>

                <article class="article-card">

                    <h2>
                        <?= Html::encode($row->title) ?>
                    </h2>

                    <div class="article-meta">
                        <?= Html::encode($row->username) ?>
                        <span class="meta-dot">•</span>
                        <?= Html::encode($row->date) ?>
                    </div>

                    <div class="article-excerpt">
                        <?= Html::encode(
                            StringHelper::truncate(
                                trim(strip_tags($row->content)),
                                280
                            )
                        ) ?>
                    </div>

                    <?= Html::a(
                        'Baca Selengkapnya →',
                        ['/post/view', 'id' => $row->idpost],
                        ['class' => 'btn-read-more']
                    ) ?>

                </article>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="empty-articles">
                <h3>Belum Ada Artikel</h3>
                <p>Artikel terbaru akan ditampilkan di sini.</p>
            </div>

        <?php endif; ?>

    </div>

</div>
