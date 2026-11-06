
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Create Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-create">

    <div class="form-page-header">
        <div>
            <span class="home-label">MENU TAMBAH ARTIKEL</span>
            <h1>Buat Artikel Baru</h1>
            <p>Tulis dan simpan artikel baru kamu di sini.</p>
        </div>

        <?= Html::a(
            '← Kembali ke Posts',
            ['index'],
            ['class' => 'btn btn-back-post']
        ) ?>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
