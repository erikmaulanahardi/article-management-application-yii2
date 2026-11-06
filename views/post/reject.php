<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

$this->title = 'Tolak Artikel: ' . $model->title;
?>
<div class="post-reject">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rejection_reason')->textarea(['rows' => 4, 'placeholder' => 'Tuliskan alasan penolakan artikel ini...'])->label('Alasan Penolakan') ?>

    <div class="form-group">
        <?= Html::submitButton('Simpan Penolakan', ['class' => 'btn btn-danger']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>