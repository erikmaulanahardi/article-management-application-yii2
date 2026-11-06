
<?php

use yii\helpers\Html;

$this->title = 'Update Account: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="account-page">
    <div class="account-heading">
        <div>
            <span class="account-eyebrow">EDIT USER</span>
            <h1>Edit Akun</h1>
            <p>Perbarui informasi akun pengguna.</p>
        </div>
    </div>

    <div class="account-form-card">
        <?= $this->render('_form', ['model' => $model]) ?>
    </div>
</div>
