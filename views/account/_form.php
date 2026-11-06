
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="account-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput([
        'maxlength' => true,
        'disabled' => !$model->isNewRecord,
        'class' => 'form-control account-input',
        'placeholder' => 'Masukkan username',
    ]) ?>

    <?= $form->field($model, 'password')->passwordInput([
        'maxlength' => true,
        'class' => 'form-control account-input',
        'placeholder' => $model->isNewRecord
            ? 'Masukkan password'
            : 'Masukkan password baru',
    ])->hint($model->isNewRecord
        ? 'Gunakan password untuk akun baru.'
        : 'Isi password baru jika ingin menggantinya.'
    ) ?>

    <?= $form->field($model, 'name')->textInput([
        'maxlength' => true,
        'class' => 'form-control account-input',
        'placeholder' => 'Masukkan nama lengkap',
    ]) ?>

    <?= $form->field($model, 'role')->dropDownList([
        'admin' => 'Admin',
        'author' => 'Author',
    ], [
        'class' => 'form-control account-input',
        'prompt' => 'Pilih role akun',
    ]) ?>

    <div class="account-form-actions">
        <?= Html::submitButton('Simpan Akun', [
            'class' => 'account-create-button',
        ]) ?>

        <?= Html::a('Batal', ['index'], [
            'class' => 'account-cancel-button',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
