<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Accounts';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="account-page">
    <div class="account-heading">
        <div>
            <span class="account-eyebrow">ADMIN</span>
            <h1>Pengelolaan Akun</h1>
            <p>Kelola akun Admin dan Author di sini (Khusus Admin!).</p>
        </div>

        <?= Html::a(
            '+ Buat Akun Baru',
            ['create'],
            ['class' => 'account-create-button']
        ) ?>
    </div>

    <div class="account-table-card">
        <div class="account-table-heading">
            <h3>Daftar Akun</h3>
            <span>Data pengguna aplikasi</span>
        </div>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'table account-table'],
            'layout' => "{items}\n<div class='account-pagination'>{summary}{pager}</div>",
            'summary' => 'Menampilkan <strong>{begin}-{end}</strong> dari <strong>{totalCount}</strong> akun.',
            'emptyText' => 'Belum ada akun yang tersedia.',
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => '#',
                    'contentOptions' => ['class' => 'account-number'],
                ],
                [
                    'attribute' => 'username',
                    'label' => 'Username',
                    'contentOptions' => ['class' => 'account-username'],
                ],
                [
                    'attribute' => 'name',
                    'label' => 'Nama Lengkap',
                ],
                [
                    'attribute' => 'role',
                    'label' => 'Role',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $role = strtolower($model->role);
                        $class = $role === 'admin' ? 'role-admin' : 'role-author';

                        return '<span class="account-role ' . $class . '">' .
                            Html::encode(ucfirst($model->role)) .
                            '</span>';
                    },
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Aksi',
                    'template' => '{view} {update} {delete}',
                    'headerOptions' => ['class' => 'account-action-header'],
                    'contentOptions' => ['class' => 'account-actions'],
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('View', $url, [
                                'class' => 'account-action-view',
                                'title' => 'Lihat akun',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('Edit', $url, [
                                'class' => 'account-action-edit',
                                'title' => 'Edit akun',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('Hapus', $url, [
                                'class' => 'account-action-delete',
                                'title' => 'Hapus akun',
                                'data' => [
                                    'confirm' => 'Yakin ingin menghapus akun ini?',
                                    'method' => 'post',
                                ],
                            ]);
                        },
                    ],
                ],
            ],
        ]); ?>
    </div>
</div>