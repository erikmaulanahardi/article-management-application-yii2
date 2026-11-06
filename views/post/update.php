
<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Update Post';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="post-update">

    <div class="form-page-header">
        <div>
            <span class="home-label">KUMPULAN ARTIKEL</span>
            <h1>Edit Artikel</h1>
            <p>Perbarui informasi dan isi artikel Anda.</p>
        </div>

        <?= Html::a(
            '← Kembali ke Posts',
            ['index'],
            ['class' => 'btn btn-back-post']
        ) ?>
    </div>

    <div class="editing-article-info">
        <span class="glyphicon glyphicon-pencil"></span>
        Sedang mengedit:
        <strong><?= Html::encode($model->title) ?></strong>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
