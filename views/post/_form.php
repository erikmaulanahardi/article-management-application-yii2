
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */

$isNewRecord = $model->isNewRecord;
?>

<div class="post-form-card">

    <div class="post-form-heading">
        <h3><?= $isNewRecord ? 'Informasi Artikel' : 'Edit Artikel' ?></h3>
        <p>Lengkapi informasi artikel pada kolom berikut.</p>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'modern-post-form',
        ],
    ]); ?>

    <?= $form->field($model, 'title', [
        'options' => ['class' => 'form-group modern-form-group'],
        'template' => "{label}\n{input}\n{error}",
    ])->textInput([
        'maxlength' => true,
        'placeholder' => 'Masukkan judul artikel...',
        'class' => 'form-control modern-input',
    ])->label('Judul Artikel') ?>

    <?= $form->field($model, 'content', [
        'options' => ['class' => 'form-group modern-form-group'],
        'template' => "{label}\n{input}\n{error}",
    ])->widget(CKEditor::className(), [
        'preset' => 'full',
        'options' => [
            'rows' => 12,
        ],
        'clientOptions' => [
            'height' => 350,
        ],
    ])->label('Isi Artikel') ?>

    <div class="form-info">
        <span class="glyphicon glyphicon-info-sign"></span>
        <?= $isNewRecord
            ? 'Artikel baru akan disimpan dengan status Draft. Anda dapat mengajukan artikel untuk direview oleh Admin setelah menyimpannya.'
            : 'Pastikan perubahan artikel sudah sesuai sebelum disimpan.' ?>
    </div>

    <div class="form-actions">

        <?= Html::submitButton(
            $isNewRecord ? 'Simpan sebagai Draft' : 'Simpan Perubahan',
            ['class' => 'btn btn-save-post']
        ) ?>

        <?= Html::a(
            'Batal',
            ['index'],
            ['class' => 'btn btn-cancel-post']
        ) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
