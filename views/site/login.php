
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>

<div class="login-wrapper">

    <div class="login-card">

        <div class="login-header">
            <div class="login-icon">
                <span class="glyphicon glyphicon-user"></span>
            </div>

            <h2>Halaman Login</h2>
            <p>Login dulu yaaa!</p>
        </div>

        <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'options' => ['class' => 'login-form'],
        ]); ?>

        <?= $form->field($model, 'username')->textInput([
            'autofocus' => true,
            'placeholder' => 'Masukkan username',
            'class' => 'form-control login-input',
        ])->label('Username') ?>

        <?= $form->field($model, 'password')->passwordInput([
            'placeholder' => 'Masukkan password',
            'class' => 'form-control login-input',
        ])->label('Password') ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "{input} {label}",
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Login', [
                'class' => 'btn btn-login',
                'name' => 'login-button',
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>

        <div class="login-footer">
            <p>My Application &copy; <?= date('Y') ?></p>
        </div>

    </div>

</div>
