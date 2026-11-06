
<?php

use yii\helpers\Html;

$this->title = 'Create Account';
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="account-page">
    <div class="account-heading">
        <div>
            <span class="account-eyebrow">BUAT AKUN BARU</span>
            <h1>Buat Akun Baru</h1>
            <p>Tambahkan pengguna baru ke aplikasi.</p>
        </div>
    </div>

    <div class="account-form-card">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>
