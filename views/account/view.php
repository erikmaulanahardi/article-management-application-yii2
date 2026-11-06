
<?php

use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="account-page">
    <div class="account-heading">
        <div>
            <span class="account-eyebrow">DETAIL AKUN</span>
            <h1>Detail Akun</h1>
            <p>Informasi akun pengguna aplikasi.</p>
        </div>

        <?= Html::a('← Kembali', ['index'], [
            'class' => 'account-back-button'
        ]) ?>
    </div>

    <div class="account-detail-card">
        <div class="account-avatar">
            <?= Html::encode(strtoupper(substr($model->name, 0, 1))) ?>
        </div>

        <h2><?= Html::encode($model->name) ?></h2>
        <p class="account-detail-username">
            @<?= Html::encode($model->username) ?>
        </p>

        <div class="account-detail-role">
            <span class="account-role <?= strtolower($model->role) === 'admin' ? 'role-admin' : 'role-author' ?>">
                <?= Html::encode(ucfirst($model->role)) ?>
            </span>
        </div>

        <div class="account-detail-divider"></div>

        <div class="account-detail-row">
            <span>Username</span>
            <strong><?= Html::encode($model->username) ?></strong>
        </div>

        <div class="account-detail-row">
            <span>Nama</span>
            <strong><?= Html::encode($model->name) ?></strong>
        </div>

        <div class="account-detail-row">
            <span>Role</span>
            <strong><?= Html::encode(ucfirst($model->role)) ?></strong>
        </div>

        <div class="account-detail-actions">
            <?= Html::a('Edit Akun', ['update', 'id' => $model->username], [
                'class' => 'account-create-button'
            ]) ?>

            <?= Html::a('Hapus Akun', ['delete', 'id' => $model->username], [
                'class' => 'account-delete-button',
                'data' => [
                    'confirm' => 'Yakin ingin menghapus akun ini?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>
</div>
